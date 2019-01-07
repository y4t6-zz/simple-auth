<?php
require 'Connection.php';
require 'Auth.php';   

$db    = new Connection();
$post  = $_POST;
$email = $post['email'];
$password  = $post['password'];
$auth = new Auth();

$sql = '
    SELECT * FROM user 
    WHERE email="' . $email . '" 
    AND password="' . md5($password) . '"
    LIMIT 1
';
$res = $db->query($sql);

if ($res == null) {
    echo 'Email или password неверны!';
} else {
    $user = $res[0];

    if ($user->role == 'admin') {
        $hash = md5($user->id . $user->email . $user->password . $auth->salt());
        $auth->authorize($hash);
        header('Location: /index.php');
    }
}




