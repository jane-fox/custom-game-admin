<?php
/**
 * Template Name: Export (Export Page Only!)
 */


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>

<p>Getting started...</p>


<?php

$search_args = array(
	'post_type' => 'scene',
	'posts_per_page' => -1,
);

$types = [ "scene", "character", "place", "item" ];
$data = [];

echo "<pre>";

//Go through each type of content we want
foreach ($types as $type) {

	//Get all posts for that type
	$posts = get_posts(["post_type" => $type, 'posts_per_page' => -1]);

	$data[$type] = array();

	//For each individual post,
	foreach ($posts as $post) {

		//print_r($post);


		//Get all custom fields for post
		$custom = get_fields($post->ID);
		$pretty = rename_fields($post);

		$post_array = (array) $pretty;
		$custom_array = (array) $custom;

		//Add custom data into original post data
		$combined = array_merge($post_array, $custom_array);

		//Add finished item to data
		array_push($data[$type], $combined);



	}


	//After loop is done, print the results out to files
	$output = setup_content($type, $data[$type]);
	//echo $output;
	print_r($output);


	file_put_contents("/var/www/data/" . $type . "s.js", $output );
	file_put_contents("/var/www/wordpress/data/" . $type . "s.js", $output );


}



echo "</pre>";


function setup_content($type, $data) {

	$json = json_encode($data, JSON_PRETTY_PRINT);

	$start = "var " . $type . "_data = ";

	$end = ";";

	return $start . $json . $end;

}


function rename_fields($data) {

	$new_post = array();
	//print_r($post);

	$new_post["name"] = $data->post_name;
	$new_post["text"] = $data->post_content;
	$new_post["title"] = $data->post_title;

	//If item has a parent, look it up and get its name
	if ($data->post_parent > 0) {
		$parent = get_post($data->post_parent);
		$new_post["parent"] = $parent->post_name;
	}

	//TODO lookup author and parent




	return $new_post;


}



echo "<p>... Done !</p>";
