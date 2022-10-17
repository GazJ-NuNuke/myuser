<?php


require_once'class.user.php';
if(isset($user)){
$user = cookiedecode($user);
$u = new myUser( $user[0], $user[1], $user[2]);
}else{
$user = '';
$u = new myUser( '', '', '');	
}
echo 'Outputs last visit date of user: '.$u->getLastVisit();
?>