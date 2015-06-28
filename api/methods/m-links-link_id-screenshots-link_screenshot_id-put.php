<?php
$route = '/links/:link_id/screenshots/:link_screenshot_id';
$app->put($route, function ($link_id,$link_screenshot_id)  use ($app){


	$ReturnObject = array();

 	$request = $app->request();
 	$param = $request->params();

	if(isset($param['path']))
		{
		$type = trim(mysql_real_escape_string($param['type']));
		$path = trim(mysql_real_escape_string($param['path']));
		$name = trim(mysql_real_escape_string($param['name']));

		$query = "UPDATE link_screenshot SET type = '" . $type . "', image_url = '" . $path . "', image_name = '" . $name . "' WHERE link_screenshot_id = " . $link_screenshot_id;
		mysql_query($query) or die('Query failed: ' . mysql_error());
		$screenshot_ID = mysql_insert_id();

		$F = array();
		$F['screenshot_id'] = $screenshot_id;
		$F['name'] = $name;
		$F['path'] = $path;
		$F['type'] = $type;

		array_push($ReturnObject, $F);

		}

		$app->response()->header("Content-Type", "application/json");
		echo stripslashes(format_json(json_encode($ReturnObject)));
	});	
 ?>
