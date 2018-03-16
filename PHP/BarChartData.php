<?php
$username = "root";
$password = "Shwi2uuUuu!";
$host = "localhost";
$database = "test";

$server = mysql_connect($host,$username,$password);
$connection = mysql_select_db($database, $server);

$myquery = "SELECT A.FundingYear, SUM(A.FundedAmount) OUTGOING, SUM(B.FundedAmount) INCOMING 
FROM `investments` AS A inner join `investments` AS B 
on A.FundingYear = B.FundingYear
 WHERE (A.SourceCountry= 'CAN' AND A.DestCountry != 'CAN') 
 AND (B.DestCountry = 'CAN' AND B.SourceCountry != 'CAN') 
GROUP by A.FundingYear HAVING A.FundingYear between (2009 -2) and (2009 + 2)" ;

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
