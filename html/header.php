<?php
  //-----------------------------------------------------------------------
  // Author: Choosine
  //-----------------------------------------------------------------------
if(array_key_exists('type', $_GET)){
  $type = $_GET['type'];
} else if(array_key_exists('type', $_POST)){
  $type = $_POST['type'];
}
if(array_key_exists('userkey', $_GET)){
  $userkey = $_GET['userkey'];
} else if(array_key_exists('userkey', $_POST)) {
  $userkey = $_POST['userkey'];
}

?>
<!DOCTYLE html>
<html lang="en" xml:lang="en">
<head>
<meta charset="utf-8">
<title>Choosine</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.0.6-development-only.js"></script>
<script type="text/javascript" src="./js/scripts.js"></script>
<link href='http://fonts.googleapis.com/css?family=Coustard:400|Rokkitt:400' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="./css/reset.css" type="text/css" />
<link rel="stylesheet" href="./css/style.css" type="text/css" />