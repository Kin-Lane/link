<?php
$route = '/links/tags/:tag/links/';
$app->get($route, function ($tag)  use ($app){

	$ReturnObject = array();

 	$request = $app->request();
 	$params = $request->params();

	if(isset($_REQUEST['week'])){ $week = $params['week']; } else { $week = date('W'); }
	if(isset($_REQUEST['year'])){ $year = $params['year']; } else { $year = date('Y'); }

	$Query = "SELECT b.* from tags t";
	$Query .= " JOIN link_tag_pivot btp ON t.Tag_ID = btp.Tag_ID";
	$Query .= " JOIN links b ON btp.Link_ID = b.ID";
	$Query .= " WHERE WEEK(b.Post_Date) = " . $week . " AND YEAR(b.Post_Date) = " . $year . " AND Tag = '" . $tag . "'";

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

		array_push($ReturnObject, $F);
		}

		$app->response()->header("Content-Type", "application/json");
		echo format_json(json_encode($ReturnObject));
	});	
 ?>
