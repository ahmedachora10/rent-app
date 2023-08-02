<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'config.php';

if(!function_exists('connect')):
    function connect() {
        static $conn = null;

        if($conn === null):
            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        endif;

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }
endif;

if(!function_exists('insert_record')):
    function insert_record($table_name, $data) {
        $keys = [];
        $values = [];

        foreach ($data as $key => $value) {
            if(is_numeric($value)):
                $values[] = (int) $value;
            else:
                $values[] = "'".$value."'";
            endif;
            $keys[] = "`{$key}`";
        }

        $sql = "INSERT INTO `$table_name` (" . implode(",", $keys) . ") VALUES (" . trim(implode(',', $values), ',') . ")";
        // var_dump($sql); exit;
        if (mysqli_query(connect(), $sql)) {
            return mysqli_insert_id(connect());
        }
        
        return false;
    }
endif;

if(!function_exists('update_record')):
    function update_record($table_name, $data, $where) {
        $set = array();
        foreach ($data as $key => $value) {
            if(is_numeric($value)):
                $set[] = "`$key` = $value";
            else:
                $set[] = "`$key` = '$value'";
            endif;
        }
        $sql = "UPDATE `$table_name` SET " . implode(", ", $set) . " WHERE $where";
        // return $sql;
        if (mysqli_query(connect(), $sql)) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error(connect());
            return false;
        }
    }
endif;

if(!function_exists('delete_record')):
    function delete_record($table_name, $where) {
        $sql = "DELETE FROM $table_name WHERE $where";
        if (mysqli_query(connect(), $sql)) {
            return true;
        } else {
            // echo "Error: " . $sql . "<br>" . mysqli_error(connect());
            return false;
        }
    }
endif;

if(!function_exists('select_records')):
    function select_records($table_name, $where = '', $order_by = '', $limit = '') {
        $sql = "SELECT * FROM `$table_name`";
        if ($where != '') {
            $sql .= " WHERE $where";
        }
        if ($order_by != '') {
            $sql .= " ORDER BY $order_by";
        }
        if ($limit != '') {
            $sql .= " LIMIT $limit";
        }
        
        $result = mysqli_query(connect(), $sql);
        if (!$result) {
            // echo "Error: " . $sql . "<br>" . mysqli_error(connect());
            return false;
        }
        $records = array();
        while ($row = mysqli_fetch_object($result)) {
            $records[] = $row;
        }
        return $records;
    }
endif;

if(!function_exists('findOne')):

    function findOne($table_name, $where) {

        $find = select_records($table_name, $where);

        if(count($find) > 0) {
            return $find[0];
        }

        return false;
    }

endif;

if(!function_exists('auth')):
    function auth()
    {
        static $user = null;
        
        if(!isset($_SESSION['user_id'])):
            return false;
        endif;

        if ($user === null):
            $user = findOne('tblusers', "id={$_SESSION['user_id']}");
        endif;
        
        if(!$user):
            return false;
        endif;
        
        return $user;
    }
endif;

if(!function_exists('request')):

    function request($key, $method = 'get', $type = 'int') {

        $typePatterns = [
            'int'    => "/^-?\d+$/",
            'string' => "/^[\p{Arabic}\p{L}\s]+$/u", //"/^[a-zA-Z0-9_\s]+$/",
            'mixed' => "/^.*$/",
            'email' => "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",
            'date' => "/^\d{4}-\d{2}-\d{2}$/"
        ];

        $pattern = $typePatterns[$type] ?? null;

        if (!$pattern) {
            throw new Exception("Invalid data type: {$type}");
        }

        $requestData = ($method == 'post') ? $_POST : $_GET;

        $value = $requestData[$key] ?? null;

        if ($value !== null && preg_match($pattern, $value)) {
            return $value;
        }

        return false;
    }

endif;

if(!function_exists('user_login')):
    function user_login($userID) {
        $_SESSION['user_id'] = $userID;
        header('Location: /');
        return true;
    }
endif;

if(!function_exists('user_logout')):
    function user_logout($userID) {
        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $userID):
            unset($_SESSION['user_id']);
        endif;

        return true;
    }
endif;

if(!function_exists('url')):
    function url($path) {
        $slash = FOLDER == '' ? '' : '/';
        return $slash .trim(FOLDER, '/') . '/' . ltrim($path, '/');
    }
endif;

if(!function_exists('current_uri')):
    function current_uri($value, $key = 'category_id') {
        return request($key, 'get', 'string') == $value ? 'text-primary fw-bold' : 'text-dark';
    }
endif;

if(!function_exists('translate')):
    function translate($key) {
        $translate_categoriess = [
            'games' => 'ألعاب',
            'electronics' => 'أجهزة كهربائية',
            'computer' => 'هواتف وأجهزة الحاسوب',
            'tools' => 'أدوات منزلية',
        ];

        return $translate_categoriess[$key] ?? $key;
    }
endif;