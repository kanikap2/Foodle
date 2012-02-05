<?php

//var_dump($_POST);

include_once("foodledbinfo.php");

$db = new PDO("mysql:host=localhost;dbname={$database}", $username, $password);


$_POST = array();
$_POST['userkey'] = 'B15F4E6F-29AF-F20C-D2A8-454D941C7230';
$_POST['0'] = '';
$_POST['1'] = 'bread';
$_POST['2'] = 'cheese';
$_POST['3'] = 'apple';


$userkey = $_POST['userkey'];

$stmt = $db->prepare("SELECT * FROM users WHERE urlkey = '$userkey'");
//echo "SELECT * FROM users WHERE urlkey = $userkey" . "\n";
$stmt->execute();
$row = $stmt->fetch();

echo "pollid={$row['pollid']}, and ";

if ( !array_key_exists('pollid', $row)) {
  echo "User not found.";
  die();
}

echo $pollid = $row['pollid'];
echo $voterid = $row['userid'];

// Delete all old votes by this user
$stmt = $db->prepare("DELETE FROM votes WHERE pollid = $pollid AND voterid = $voterid");
//echo "DELETE FROM votes WHERE pollid = $pollid AND voterid = $voterid" . "\n";
$stmt->execute();

$rank = 1;
foreach ($_POST as $index => $yelpid) {
  if ($yelpid !== "" and $index !== "userkey") {
    // Get the choiceid for the yelpid
    $query = "SELECT choiceid FROM choices{$pollid} WHERE yelpid = ?";
    echo "\n{$query}\n";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $yelpid);
    $stmt->execute();
    $row = $stmt->fetch();
    if ($row and array_key_exists('choiceid', $row)) {
      $choiceid = $row['choiceid'];
      $voteid = "$pollid".".".$voterid.".".$choiceid;

      $stmt = $db->prepare("INSERT INTO votes VALUES (?, $pollid, $voterid, $choiceid, $rank)");
      $stmt->bindParam(1, $voteid);

      $stmt->execute();
      $rank += 1;
    }
    else {
      echo "Bad yelp id: {$yelpid}";
      // error handle? bad yelp id
    }
  }
}

?>