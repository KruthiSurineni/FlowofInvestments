<?php
$username = "root";
$password = "Shwi2uuUuu!";
$host = "localhost";
$database = "test";

$server = mysql_connect($host,$username,$password);
$connection = mysql_select_db($database, $server);

$myquery = "SELECT A.Year, SUM(A.Amount) OUTGOING, SUM(B.Amount) INCOMING 
FROM `investmentsus` AS A inner join `investmentsus` AS B 
on A.Year = B.Year
 WHERE (A.SourceState= 'CA' AND A.DestinationState != 'CA') 
 AND (B.DestinationState = 'CA' AND B.SourceState != 'CA') 
GROUP by A.Year HAVING A.Year between (2010 -2) and (2010 + 2)" ;

$query = mysql_query($myquery);

if(!$query){
echo mysql_error();
die;
}

$data = array();

for ($x=0; $x <mysql_num_rows($query); $x++){
$data[] = mysql_fetch_array($query);
}


echo json_encode($data);

//mysql_close($server);

?>
