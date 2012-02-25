<?php
if (array_key_exists('userkey', $_GET)) {
  $headerstring = "Location: initiate.php?userkey=".$userkey."&nominate=true";
  if (array_key_exists('type', $_GET)) {
    $headerstring = $headerstring . "&type=" . $_GET['type'];
  }
  header($headerstring);
}
else {
  include("header.php");
}
// TODO: process user key info in a get request to skip to the poll page
?>
</head><body id="home">
    <div id="banner"><a href="./index.php"><img src="./images/choosine.png"/></a></div>
<div id="wrapper">
<div id="container">
 <div id="restaurants">
 <div class="badge"><a class="badge" href="./initiate.php?type=restaurants">Restaurants</a></div>
    <div class="text">
      <ul>
	<li><img class="bullet" src="./images/bullet1.png" />Create a poll.</li>
	<li><img class="bullet" src="./images/bullet2.png" />Nominate your favorite restaurants.</li>
	<li><img class="bullet" src="./images/bullet3.png" />Invite your friends to vote.</li>
      </ul>
    </div>
 </div>
  
  <div id="cuisine">
  <div class="badge"><a class="badge" href="./initiate.php?type=cuisine">Cuisine</a></div>
   <div class="text">
      <ul>
	<li><img class="bullet" src="./images/bullet1.png" />Create a poll.</li>
	<li><img class="bullet" src="./images/bullet2.png" />Rank cuisines by preference.</li>
	<li><img class="bullet" src="./images/bullet3.png" />Invite your friends to vote.</li>
      </ul>
    </div>
 </div>
    <?php include("footer.php"); ?>