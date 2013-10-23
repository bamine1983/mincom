<?php
include('lib/nusoap.php');
$serveur = new nusoap_server;
$serveur->register('getContent');

function getContent($prenom){
	$conn = mysql_connect('localhost','root','');
	mysql_select_db('mincom', $conn);
	
	$sql = "SELECT * FROM pzt_k2_items WHERE catid=1";
	$q	= mysql_query($sql);
	while($r = mysql_fetch_array($q)){
		$items[] = array('id'=>$r['id'],
				'title'=>$r['title'],
				'intro'=>$r['introtext'],
				'created'=>$r['created']
			); 
	}
	return $items;
}
$serveur->service($HTTP_RAW_POST_DATA);
exit();
?>