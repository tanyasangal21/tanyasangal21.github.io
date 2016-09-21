<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbcountries";
$str=$_GET["city"];
$str2=$_GET["name"];
$str3=$_GET["id"];
$sql="";
$result="";
//echo $str." ".$str2." ".$str3."<-str3";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($str))
{
	if(empty($str2)&& empty($str3)){
	$sql = "SELECT * FROM ngo natural join cities where cities.city_name=ngo.city and cities.city_id=".$str."";
}
}
else if($str=='--Select City--')
{	
	if(isset($str2) && empty($str3) )
	{
		$sql = "SELECT * FROM ngo where name='".$str2."'";
	}
	else if(empty($str2) && isset($str3)){
		$sql = "SELECT * FROM ngo where id='".$str3."'";
	}
	else if(isset($str2) && isset($str3)){
		$sql = "SELECT * FROM ngo where name='".$str2."' and id='".$str3."'";	
	}
}
	if($sql)
		$result = mysqli_query($conn, $sql);
	
	if (!$result || mysqli_num_rows($result)==0)
	{
		echo "NO NGO'S" ;
	}
	else{	
		echo'<table border="1" style="border-collapse:collapse; text-align:center; border:3px solid #558C89; width: 100%;" class="table-bordered">';
		echo'<tr>';
	    echo'<th style=" background-color: #558C89;color: white; text-align:center; padding: 10px;">ID</th>';
		echo'<th style=" background-color: #558C89;color: white; text-align:center;padding: 10px;">Name</th>';
		echo'<th style=" background-color: #558C89;color: white; text-align:center;padding: 10px;">Address</th>';
		
	 echo'</tr>';
while($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
			echo'<td style="border-bottom: 1px solid #ddd;border-bottom: 1px solid #558C89 ; padding: 10px;">'.$row['id'].'</td>';
			echo'<td style="border-bottom: 1px solid #ddd;border-bottom: 1px solid #558C89 ; padding: 10px;">'.$row['name'].'</td>';
			echo'<td style="border-bottom: 1px solid #ddd;border-bottom: 1px solid #558C89 ; padding: 10px;">'.$row['address'].'</td>';
			
		echo '</tr>';
}
}  
mysqli_close($conn); 
?>  
