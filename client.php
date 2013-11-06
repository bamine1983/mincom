<?php
require_once('lib/nusoap.php');
$client = new soapclient(
		null,		
		array(
			'uri' 			=> 'http://nusoap.mincom.mobile/serveur.php?wsdl',
			'location' 		=> 'http://nusoap.mincom.mobile/serveur.php?wsdl',
			'wsdl_cache' 	=> 0,
			'trace' 		=> 1,
			'exceptions' 	=> 0,
		)
	);

$result = $client->__call('hello', array(1, 10));
echo "<pre>";print_r($result);

/* echo "<pre>\n"; mihmi
// Retourne la requete envoyée au serveur
echo "Request :\n".htmlspecialchars($client ->__getLastRequest()) ."\n";
// Retourne la vraie réponse construite sur le serveur 
//(souvent le message d'erreur produit dans le script du serveur 
//que tu ne voies pas)
echo "Response:\n".htmlspecialchars($client ->__getLastResponse())."\n";
echo "</pre>";  */

?>