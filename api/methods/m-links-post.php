<?php
$route = '/links/';
$app->post($route, function () use ($app){

	$Add = 1;
	$ReturnObject = array();

 	$request = $app->request();
 	$params = $request->params();

	if(isset($params['name'])){ $name = mysql_real_escape_string($params['name']); } else { $name = ''; }
	if(isset($params['description'])){ $description = mysql_real_escape_string($params['description']); } else { $description = ''; }
	if(isset($params['url'])){ $url = mysql_real_escape_string($params['url']); } else { $url = ''; }

  	$Query = "SELECT * FROM links WHERE url = '" . $url . "'";
	//echo $Query . "<br />";
	$Database = mysql_query($Query) or die('Query failed: ' . mysql_error());

	if($Database && mysql_num_rows($Database))
		{
		$ThisLink = mysql_fetch_assoc($Database);
		$link_id = $ThisLink['link_id'];
		}
	else
		{
		$Query = "INSERT INTO links(name,description,url)";
		$Query .= " VALUES(";
		$Query .= "'" . mysql_real_escape_string($name) . "',";
		$Query .= "'" . mysql_real_escape_string($description) . "',";
		$Query .= "'" . mysql_real_escape_string($url) . "'";
		$Query .= ")";
		//echo $Query . "<br />";
		mysql_query($Query) or die('Query failed: ' . mysql_error());
		$link_id = mysql_insert_id();
		}

	$ReturnObject['link_id'] = $link_id;

	$app->response()->header("Content-Type", "application/json");
	echo format_json(json_encode($ReturnObject));

	});	
 ?>
