<?php
//Include Db connection script
include 'dbconn.php';
$sql="SELECT id, dod, substring( full_text, instr( full_text, 'July ') , (instr( full_text, ', 201' ) +6 - instr( full_text, 'July ' ))) AS date_of 
FROM tbl_obits
WHERE instr( full_text, 'July ' ) AND instr( full_text, ', 201' ) and dod='0000-00-00'
ORDER BY id";

$result = @mysql_query($sql);
if (!$result) {
   echo("<p>Error performing query: " . mysql_error() . "</p>");
   exit();
   }
$month=array('January','February','March','April','May','June','July','August','September','October','Novemeber','December');
while ($row = @mysql_fetch_array($result)) {
	if ($row[date_of]){
		$dod_yr=substr($row[date_of],strlen($row[date_of])-4);
		$dod_da=substr($row[date_of],stripos($row[date_of]," ")+1,2);
		if (substr($dod_da,1,1)==","){
			$dod_da="0".substr($dod_da,0,1);
			}
		$dod_mo="12";
		//print "id: ".$row[id]." ".$dod_yr."-".$dod_mo."-".$dod_da."<br />";

		$sql_update="UPDATE tbl_obits SET dod='".$dod_yr."-".$dod_mo."-".$dod_da."' WHERE id =".$row[id].";";
		print $sql_update."<br />";
	}
}

?>