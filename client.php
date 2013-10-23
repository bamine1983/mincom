<?php
include('lib/nusoap.php');
$serverpath ='http://www.nusoap.dev/serveur.php';
$client = new nusoap_client($serverpath);
$items = $client->call('getContent');

if($client->fault){
   echo "Error: <p>Code: (".$client->faultcode.")</p>";
   echo "String: ".$client->faultstring;
}else{
	$r = $items;
	$count = count($r);
	?>
    <table border="1">
    <tr>
    	<th>ID</th>
    	<th>Titre</th>        
    	<th>Texte</th>        
    	<th>Date</th>        
    </tr>
    <?php for($i=0;$i<=$count-1;$i++){ ?>
    <tr>
    	<td><?php echo $r[$i]['id']; ?></td>
    	<td><?php echo $r[$i]['title']?></td>
    	<td><?php echo $r[$i]['intro']?></td>                
    	<td><?php echo $r[$i]['created']?></td>        
    </tr>
    <?php } ?>
    </table>
<?php } ?>