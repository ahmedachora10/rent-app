<?php
require_once 'includes'. DIRECTORY_SEPARATOR .'config.php';

require_once ROOT . 'utils' . DS . 'functions.php';

$errors = null;
$success = null;

if(isset($_POST['contact'])):

    $username = request('username', 'post', 'string');
    $email = request('email', 'post', 'email');
    $subject = request('subject', 'post', 'string');
    $message = request('message', 'post', 'string');

    if(!$username || !$email || !$subject || !$message):
        $errors = 'الحقول مطلوبة';
    else:

        insert_record('tblmessage', [
            'username' => $username,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
        ]);

        $success = 'تم ارسال المعلومات بنجاح';
        
    endif;
endif;

$back = preg_replace("/\?.*/", '', $_SERVER['HTTP_REFERER']);

$params = $success !== null ? "success=". $success : null;
$params .= $errors !== null ? "errors=". $errors : null;
header("Location: $back?$params"); exit;