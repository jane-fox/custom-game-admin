<?php
/**
 * Template Name: Export (Export Page Only!)
 */

echo "<p>Getting stuff...</p>";




$scenes = get_posts(array('post_type' => 'scene'));
$characters = get_posts(array('post_type' => 'character'));
$places = get_posts(array('post_type' => 'place'));
$items = get_posts(array('post_type' => 'item'));

var_dump(json_encode($scenes));

//wp_json_encode

