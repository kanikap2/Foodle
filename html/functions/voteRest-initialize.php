<?php
    require_once ('lib/OAuth.php');
    include("access.php");
    include("parse.php");
    include("formmatch.php");
    include("foodledbinfo.php");
    include("newpoll.php");
    include("newuser.php");
    /*
    $userkey = "B3EF2465-24E8-AC67-5076-0D3C22571FD0";
    
    $userinfo = getUserInfo($userkey);
    $pollid = $userinfo['pollid'];
    
    $arrOfIds = getPollChoices($pollid);
    */
    $arrOfIds = array("the-bent-spoon-princeton", "witherspoon-grill-princeton", "nassau-sushi-princeton");
    $num = count($arrOfIds);
    //echo("<br/><br/>");
    function addItems($arrOfIds) {
        for ($i = 0 ; $i < $num; $i++) {
            $response=getData($arrOfIds[$i]);
            $name = $response[name];
            echo("<li class='restaurant'>".$name."<li>");
        }
    }
    
    function getData($business) {
        
        // create URL and get Yelp response
        $unsigned_url = "http://api.yelp.com/v2/business/".$business;
        $data = access($unsigned_url);
        $response = json_decode($data);
        
        //print_r($response);
        
        $name = $response->name;
        $rating = $response->rating;
        $ratingimg = $response->rating_img_url;
        $url = $response->url;
        $location = ($response->location->city) . "," . ($response->location->state_code);
        $category = "";  
        for ($i = 0; $i < count($response->categories); $i++) {
            $category = $category.$response->categories[$i];
        }    
        //name, rating, rating_img_url, url, categories, city, state
        $arr = array("name"=>$name, "rating"=>$rating, "ratingimg"=>$ratingimg, "location"=>$location, "categories"=>$category, "url"=>$url);
        return ($arr);
        
    }    
    
?>
<html>
    <head>
        <title>Test</title>
    </head>

<body>
    lalalala
    <p><?php echo("userkey ".$userkey." pollid ".$pollid."<br/><br/>");?></p>
    <p><?php print_r($arrOfIds);?></p>
    <ul id='restlist'>
        <?php addItems($arrOfIds); ?>
    </ul>
</body>
</html>

