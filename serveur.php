<?php
require_once('lib/nusoap.php');
$conn = mysql_connect('localhost','root','');
mysql_select_db('mincom', $conn);
	
$server = new soap_server();
$server->configureWSDL('hellowsdl', 'urn:hellowsdl');
$server->register('hello',
    array('name' => 'xsd:string'),
    array('return' => 'SOAP-ENC:Array'),    
    'urn:hellowsdl',                
    'urn:hellowsdl#hello',          
    'rpc',                          
    'encoded',                      
    'Says hello to the caller'
);

function hello($catid, $limit=100) {
    $sql = "SELECT id, title FROM pzt_k2_items WHERE catid=".$catid." LIMIT 0,".$limit;
	$result	= mysql_query($sql);
	$items = array();
	while($r = mysql_fetch_object($result)){				
		$items[] = array('id'=> $r->id, 'title'=>$r->title); 		
	}
	return $items;
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>