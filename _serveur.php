<?php
// Pull in the NuSOAP code
include('lib/nusoap.php');
// Create the server instance
$server = new soap_server();
// Initialize WSDL support
$server->configureWSDL('hellowsdl', 'urn:hellowsdl');
// Register the method to expose
$server->register('hello',                // method name
    array('name' => 'xsd:string'),        // input parameters
    array('return' => 'xsd:string'),      // output parameters
    'urn:hellowsdl',                      // namespace
    'urn:hellowsdl#hello',                // soapaction
    'rpc',                                // style
    'encoded',                            // use
    'Says hello to the caller'            // documentation
);
// Register the method to expose
$server->register('getarticles',                // method name
    array('cat' => 'xsd:integer'),        // input parameters
    array('return' => 'SOAP-ENC:Array'),      // output parameters
    'urn:hellowsdl',                      // namespace
    'urn:hellowsdl#getarticles',                // soapaction
    'rpc',                                // style
    'encoded',                            // use
    'Says hello to the caller articles'            // documentation
);
// Define the method as a PHP function
function hello($name) {
        return 'Hello, ' . $name;
}
function getarticles($cat=NULL){
	
	$conn = mysql_connect('localhost','root','');
	mysql_select_db('mincommu_ma_ntc', $conn);
	
	$limit="";
	$wheres=array();
	$where="";
	$items=array();
	if($cat)
		$wheres[]="catid='$cat'";
		
	if(count($wheres))	
		$where=" WHERE ".implode($wheres," AND ");	
		
	$sql = "SELECT * FROM pzt_k2_items ".$where.$limit;
	$q	= mysql_query($sql);
	//$t=array("hmidddda","midddhmi","soso");$i=0;
	while ($t = mysql_fetch_array($q)){
	$items[]=$t;
	
	}
	return $items;	
	
}

// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>