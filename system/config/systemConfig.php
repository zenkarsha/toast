<?php

$config = array
(
  'site' => array(
    'parent' => '../../',
    'path' => 'http://'.$_SERVER['HTTP_HOST'].str_replace('index.php','',$_SERVER['PHP_SELF']),
    'url' => 'https://toast.unlink.men/',
    'name'  => '記憶吐司產生器',
    'title' => '記憶吐司產生器',
    'description' => '',
    'copyright' => 'just for fun',
    'shortcut-icon' => 'https://toast.unlink.men/images/favicon.png'
  ),
  'setting' => array(
    'enable-database' => false,
    'enable-navbar-search' => false,
    'enable-member-system' => false
  ),
  'member' => array(
    'default-page' => 'member'
  ),
  'database' => array(
    'host'  => '',
    'user'  => '',
    'pass'  => '',
    'db'  => ''
  ),
  'admin' => array(
    '000000000000000'
  ),
  'google' => array(
    'analytics-id'  => 'UA-00000000-00'
  ),
  'facebook' => array(
    'fanpage' => '',
    'app-id' => '',
    'app-secret' => '',
    'privacy-policy' => ''
  ),
  'og' => array(
    'title' => '記憶吐司產生器',
    'type'  => 'website',
    'url' => 'https://toast.unlink.men/',
    'image' => 'https://toast.unlink.men/images/fb.png?689',
    'sitename'  => '記憶吐司產生器',
    'description' => ''
  ),
  'application'  => array(
    'image-width' => 400,
    'image-height' => 400,
    'download-filename' => '記憶吐司.png'
  )
);

?>
