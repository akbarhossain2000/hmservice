<?php
include_once("ini.php");




$sql="SELECT * FROM tbl_flat";
$rec= mysql_query($sql);

$floor = array();
while($row =mysql_fetch_array($rec)){
		$floo_id  = $row['floor'];
		$floor[$floo_id]= $floo_id;
}
	foreach($floor as $k=>$v);
	
	
	