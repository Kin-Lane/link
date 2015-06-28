<?php
$route = '/links/:link_id/';
$app->get($route, function ($link_id)  use ($app){

	$ReturnObject = array();

	$Query = "SELECT * FROM links WHERE link_id = " . $link_id;

	$DatabaseResult = mysql_query($Query) or die('Query failed: ' . mysql_error());

	while ($Database = mysql_fetch_assoc($DatabaseResult))
		{

		$link_id = $Database['link_id'];
		$name = $Database['name'];
		$description = $Database['description'];
		$url = $Database['url'];

		// manipulation zone

		$F = array();
		$F['link_id'] = $link_id;
		$F['name'] = $name;
		$F['description'] = $description;
		$F['url'] = $url;

		$ReturnObject = $F;
		}

		$app->response()->header("Content-Type", "application/json");
		echo format_json(json_encode($ReturnObject));
	});
 ?>
