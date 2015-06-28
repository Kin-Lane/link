<?php
$route = '/links/:link_id/';
$app->put($route, function ($link_id) use ($app){

	$ReturnObject = array();

 	$request = $app->request();
 	$params = $request->params();

	if(isset($params['name'])){ $name = mysql_real_escape_string($params['name']); } else { $name = ''; }
	if(isset($params['description'])){ $description = mysql_real_escape_string($params['description']); } else { $description = ''; }
	if(isset($params['url'])){ $url = mysql_real_escape_string($params['url']); } else { $url = ''; }

  	$Query = "SELECT * FROM links WHERE link_id = " . $link_id;
	//echo $Query . "<br />";
	$Database = mysql_query($Query) or die('Query failed: ' . mysql_error());

	if($Database && mysql_num_rows($Database))
		{
		$query = "UPDATE links SET";

		$query .= " name = '" . mysql_real_escape_string($title) . "'";

		if($description!='') { $query .= ", description = '" . $description . "'"; }
		if($url!='') { $query .= ", url = '" . $url . "'"; }

		$query .= " WHERE link_id = '" . $link_id . "'";

		//echo $query . "<br />";
		mysql_query($query) or die('Query failed: ' . mysql_error());
		}

	$F = array();
	$F['link_id'] = $link_id;
	$F['name'] = $name;
	$F['description'] = $description;
	$F['url'] = $url;

	array_push($ReturnObject, $F);

	$app->response()->header("Content-Type", "application/json");
	echo stripslashes(format_json(json_encode($ReturnObject)));

	});
 ?>
