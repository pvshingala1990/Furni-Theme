<?php
// JSON string in PHP Array
$jsonString = 'https://www.ourrelationship.com/wp-json/wp/v2/posts';
$phpArray = json_decode($jsonString, true);

// display the converted PHP array
var_dump($phpArray);
?>