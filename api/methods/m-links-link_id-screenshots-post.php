<?php
$route = '/links/:link_id/screenshots/';
$app->post($route, function ($link_id)  use ($app){

	$ReturnObject = array();

 	$request = $app->request();
 	$param = $request->params();
	echo "in";
	if(isset($param['type']) && isset($param['path']) && isset($param['name']))
		{
			echo "in";
		$type = trim(mysql_real_escape_string($param['type']));
		$path = trim(mysql_real_escape_string($param['path']));
		$name = trim(mysql_real_escape_string($param['name']));

		$query = "INSERT INTO link_screenshot(link_id,type,image_name,image_url)";
		$query .= " VALUES(" . $link_id . ",'" . $type . "','" . $name . "','" . $path . "')";
		//echo $query;
		mysql_query($query) or die('Query failed: ' . mysql_error());
		$screenshot_id = mysql_insert_id();

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
