<?php
$route = '/links/:link_id/screenshots/';
$app->get($route, function ($link_id)  use ($app){

	$ReturnObject = array();

	$Query = "SELECT * FROM link_screenshot ls";
	$Query .= " WHERE ls.link_id = " . $link_id;

	$DatabaseResult = mysql_query($Query) or die('Query failed: ' . mysql_error());

	while ($Database = mysql_fetch_assoc($DatabaseResult))
		{

		$link_screenshot_id = $Database['link_screenshot_id'];
		$path = $Database['image_url'];
		$name = $Database['image_name'];
		$type = $Database['type'];
		$width = $Database['width'];

		$F = array();
		$F['link_screenshot_id'] = $link_screenshot_id;
		$F['name'] = $name;
		$F['path'] = $path;
		$F['type'] = $type;
		$F['width'] = $width;

		array_push($ReturnObject, $F);
		}

		$app->response()->header("Content-Type", "application/json");
		echo stripslashes(format_json(json_encode($ReturnObject)));
	});	
 ?>
