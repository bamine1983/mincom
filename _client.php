<?php
// Pull in the NuSOAP code
include('lib/nusoap.php');
// Create the client instance
$client = new soapclient('http://localhost/free/mincom/ws/serveur.php?wsdl');
// Check for an error
/*
$err = $client->getError();
if ($err) {
    // Display the error
    echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
    // At this point, you know the call that follows will fail
}*/
// Call the SOAP method
//$result = $client->hello('bouchama');
$result = $client->getarticles(1);

        // Display the result
        echo '<h2>Result</h2><pre>';
        print_r($result);

?>