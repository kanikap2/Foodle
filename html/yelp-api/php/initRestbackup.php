<?php
/***************************************
Meant for the following jquery/html code

HTML:
Search for name of restaurant: <input type="text" name="search" /> <br/>
 <input type="submit" value="Submit" /><br/>
 
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
function search() {
    searchTxt = form.elements["search"];
    $.get("searchRest.php");
    return false;
}
</script>

<a href="#" onclick="doSomething();">Click Me!</a>


mouse up or click???

$(‘.searchbutton’).mouseup(function() {
    var searchTxt = $('.form.name?');
    var data = $.get("searchRest.php", searchTxt);
    $('somewhereMakeThisDisplayVisible').toggle(); 
    $('#placetoputYelpData').html(data);
    $('PlusSignButtonVisible').toggle(); 
    $('MakeXButtonVisible').toggle(); 
});

$('PlusSignButtonVisible').click(function() {
    // add new list item
}); 

$('MakeXButtonVisible').click(function() {
    $('somewhereMakeThisDisplayInVisible').toggle(); 
    $('PlusSignButtonInVisible').toggle(); 
    $('MakeXButtonInVisible').toggle(); 
    $('MakeSearchButtonVisible').toggle();  
}); 


need to be able to add new item to the list


***************************************/


require_once ('lib/OAuth.php');
include("access.php");
include("parse.php");
include("formmatch.php");
$loc = $_POST['sendValue'];
$num = 10; // number of restaurants to return

$unsigned_url = "http://api.yelp.com/v2/search?&location=".$loc."&limit=".$num."&category_filter=food,restaurants";
$data = access($unsigned_url);
$response = json_decode($data);
$arr = array("num"=>$num);
for ($i = 0; $i < 10; $i++) {
    $arrRest = array("name"=>name($response, $i), "id"=>id($response, $i), "rating"=>rating($response, $i), "ratingimg"=>ratingimg($response, $i), "snippet"=>snippet($response, $i), "categories"=>($response, $i));
    $arr[$i] = $arrRest;
}
echo json_encode($arr);






?>
