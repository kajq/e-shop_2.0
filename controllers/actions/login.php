<?php
session_start();
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
if ($username === 'barroyo' && $password === '122') {
  $_SESSION['firstname'] = 'Bladimir';
  $_SESSION['user_id'] = 1;
  $_SESSION['avatar'] = 'https://sguru.org/wp-content/uploads/2017/06/cool-anonymous-profile-pictures-1699946_orig.jpg';
  echo json_encode($_SESSION);
}
?>