<?php
require_once 'includes'. DIRECTORY_SEPARATOR .'config.php';

require_once ROOT . 'utils' . DS . 'functions.php';

if($user = auth()) {
    user_logout($user->id);
}

header('Location: ' . url('/index.php'));

?>