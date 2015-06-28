<?php
$route = '/links/:link_id/screenshots/:link_screenshot_id';
$app->delete($route, function ($link_id,$link_screenshot_id)  use ($app){

	$ReturnObject = array();

 	$request = $app->request();
 	$param = $request->params();

	$DeleteQuery = "DELETE FROM link_screenshot WHERE link_screenshot_id = " . $link_screenshot_id;
	$DeleteResult = mysql_query($DeleteQuery) or die('Query failed: ' . mysql_error());

	$F = array();
	$F['link_screenshot_id'] = $link_screenshot_id;

	array_push($ReturnObject, $F);

	$app->response()->header("Content-Type", "application/json");
	echo stripslashes(format_json(json_encode($ReturnObject)));

	});	
 ?>
