<?php
/**
 * Template Name: Export (Export Page Only!)
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<p>Getting stuff...</p>";


$search_args = array(
	'post_type' => 'scene',
	'posts_per_page' => -1,


);

$types = [ "scene", "character", "place", "item" ];
$data = [];

//echo "<pre>";

//Go through each type of content we want
foreach ($types as $type) {

	//Get all posts for that type
	$posts = get_posts(["post_type" => $type, 'posts_per_page' => -1]);
	
	$data[$type] = array();

	//For each individual post, 
	foreach ($posts as $post) {

		//Get all custom fields for post
		$custom = get_fields($post->ID);

		$post_array = (array) $post;
		$custom_array = (array) $custom;

		//Add custom data into original post data
		$combined = array_merge($post_array, $custom_array);

		//Add finished item to data
		array_push($data[$type], $combined);



	}

	//After loop is done, print the results out to files
	$output = setup_content($type, $data[$type]);
	file_put_contents("/var/www/data/" . $type . "s.js", $output );


}

//echo "</pre>";


function setup_content($type, $data) {

	$json = json_encode($data, JSON_PRETTY_PRINT);

	$start = "var " . $type . "_data = ";

	$end = ";";

	return $start . $json . $end;

}



echo "<p>... Done !</p>";



