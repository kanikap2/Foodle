<?php

//
// From http://non-diligent.com/articles/yelp-apiv2-php-example/
//


// Enter the path that the oauth library is in relation to the php file
require_once ('lib/OAuth.php');

// For example, request business with id 'the-waterboy-sacramento'
//$unsigned_url = "http://api.yelp.com/v2/business/the-waterboy-sacramento/name";

// For examaple, search for 'tacos' in 'sf'
//$unsigned_url = "http://api.yelp.com/v2/search?term=tacos&location=sf";

$unsigned_url = "http://api.yelp.com/v2/search?term=food&location=08544&limit=1&sort=2";

// Set your keys here

$consumer_key = "r_LK8yxWWjZLv-FmyGO3Vw";
$consumer_secret = "2l3wSMGLsYA0cQCgqnMSVUZpSus";
$token = "i5m-nLRW3o-18T2NTisIgGrzRPRpCWfZ";
$token_secret = "8YnLHst61xmdcAnIIXo3KYEtWBE";

// Token object built using the OAuth library
$token = new OAuthToken($token, $token_secret);

// Consumer object built using the OAuth library
$consumer = new OAuthConsumer($consumer_key, $consumer_secret);

// Yelp uses HMAC SHA1 encoding
$signature_method = new OAuthSignatureMethod_HMAC_SHA1();

// Build OAuth Request using the OAuth PHP library. Uses the consumer and token object created above.
$oauthrequest = OAuthRequest::from_consumer_and_token($consumer, $token, 'GET', $unsigned_url);

// Sign the request
$oauthrequest->sign_request($signature_method, $consumer, $token);

// Get the signed URL
$signed_url = $oauthrequest->to_url();

// Send Yelp API Call
$ch = curl_init($signed_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$data = curl_exec($ch); // Yelp response
curl_close($ch);

// Handle Yelp response data
$response = json_decode($data);

// Print it for debugging
print_r($response);
echo "<br><br><br>";
print "Search API";
echo "<br>";
//$start = strpos($response, "[name]", 0);
print $response->businesses[0]->name;
echo "<br>";
print $response->businesses[0]->rating;
echo "<br>";
$imageurl = $response->businesses[0]->image_url;
print $imageurl;
echo "<br>";
$htmlstr = "<img src='" . $imageurl . "'/>";
print $htmlstr;

//Yo. return businesses[0] and json_encode it? so Alice will parse it

// int strpos ( string $haystack , mixed $needle [, int $offset = 0 ] )
// string substr ( string $string , int $start [, int $length ] )
//print(substr($response, $start, 15); 



?>
