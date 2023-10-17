<?php 

session_start();
require_once('DBConnection.php');

$sql = "SELECT * FROM `visitor_list` WHERE `id_number` =". $_POST['number'] ;
$query = $conn->query($sql);
$data = $query->fetchArray();
$sql = "SELECT `currentstatus` FROM `visitor_list` where `id_number` = {$_POST['number']} 
               and DATE(date_created) = DATE('now')"; 
               $qry = $conn->query($sql);
               $dataout=""; 
                while($row = $qry->fetchArray() ) {
                    $dataout =$row['currentstatus'];
                    $a2=array('checktodayin'=>$dataout);
                }
     if($dataout == "in"){
               $data = array_merge($data,$a2);     
     }
 
if(!empty($data)){
 echo json_encode($data);
}
else{
	echo "1";
}
?>