<html>

<head>
    <title>Nominate Restaurant Test Page</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<body>

<h1>Search Parameters</h1>

<form method="post" action="<?php echo $PHP_SELF;?>">
 Search for name of restaurant: <input type="text" name="name" /> <br/>
 Location: <input type="text" name="loc" /> <br/>
 <!--Number of Busnesses to Retun: <input type="text" name="numBus" /><br/> -->
 <input type="submit" value="Submit" /><br/>
</form>

<?php
require_once ('lib/OAuth.php');
include("access.php");
include("parse.php");
include("formmatch.php");

$numBus=0;
$location=$_POST["loc"];
$name = $_POST["name"];

echo "<p> You searched for " . $name. "</p></br>";;
$name = str_replace(" ", "+", $name);
$location=str_replace(" ", "", $location);
if (!mlocation($location)) {
  $location = "";
}

echo "<br/>";
//cut paste = ctrl+space ctrl+w ctrl+y
// copy = esc w 
//$unsigned_url = "http://api.yelp.com/v2/business/the-waterboy-sacramento/name";
//$unsigned_url = "http://api.yelp.com/v2/search?term=tacos&location=sf";
//$unsigned_url = "http://api.yelp.com/v2/search?term=food,".$tag."&location=".$location."&limit=".$numBus."&sort=2&name=".$name."";
//$unsigned_url = "http://api.yelp.com/v2/search?term=food&location=08544&name=witherspoon_grill&category=food,restaurant";
$unsigned_url = "http://api.yelp.com/v2/search?term=".$name."&location=08544&limit=2&category_filter=food,restaurants";

echo "This is the search url : " . $unsigned_url . "</br>";

$data = access($unsigned_url);
// Handle Yelp response data
$response = json_decode($data);
//print_r($response);
echo "<br><br><br>";
?>
    <h1>Search Results</h1>
    <p> Put the (parsed) search results here:</p>
<?php
//print businesses(0)->name;
echo "<br> Printing out various info here: <br> ";

echo name($response, 0);
echo "<br> Rating:  ";
echo rating($response, 0);
echo "<br> City:  ";
echo location($response, 0);
echo "<br> Snippet Review:  ";
echo snippet($response, 0);
echo "<br><img src='" . ratingimg($response, 0)  . "'>Rating Img normal</img><br>";
echo "<img src='" . snippetimg($response, 0)  . "'>Snippet</img><br>";
echo "<img src='" . ratingimgsm($response, 0)  . "'>Small Rating</img><br>";
echo tags($response, 0);
echo "<br><br><br><br>";
print_r($response);
?>

<p><br/>Now, we can add more html type things down here.</p>

</body>
</html>