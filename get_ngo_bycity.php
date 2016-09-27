<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbcountries";
$str=$_GET["city"];
$str2=$_GET["name"];
$str3=$_GET["id"];
$str4=$_GET["sector"];
$sql="";
$result="";
//echo $str." ".$str2." ".$str3."<-str3 ".$str4;
//echo "<br>";

$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}	
	if(isset($str) && $str!='--Select City--' )
	{
		//echo "ds";
		if(empty($str2)&& empty($str3) && $str4=='--Select Sector--'){
			$sql = "SELECT * FROM ngo natural join cities where cities.city_name=ngo.city and cities.city_id=".$str."";
		}
		else if(empty($str2) && isset($str3) && $str4=='--Select Sector--'){
			$sql =  "SELECT * FROM ngo natural join cities where cities.city_name=ngo.city and cities.city_id=".$str." and ngo.id='".$str3."'";
		}  
		else if(isset($str2) && empty($str3) && $str4=='--Select Sector--'){
			$sql =  "SELECT * FROM ngo natural join cities where cities.city_name=ngo.city and cities.city_id=".$str." and ngo.name='".$str2."'";
		}  
		else if(isset($str2) && isset($str3) && $str4=='--Select Sector--'){
			$sql =  "SELECT * FROM ngo natural join cities where cities.city_name=ngo.city and cities.city_id=".$str." and ngo.name='".$str2."' and ngo.id='".$str3."' ";
		}	  
		else if(empty($str2) && empty($str3) && isset($str4)){
			$sql =  "SELECT * FROM ngo natural join cities where cities.city_name=ngo.city and cities.city_id=".$str." and ngo.sector like '%$str4%'";
		}  
		else if(isset($str2) && empty($str3) && isset($str4)){
			$sql =  "SELECT * FROM ngo natural join cities where cities.city_name=ngo.city and cities.city_id=".$str." and ngo.name='".$str2."'   and ngo.sector like '%$str4%' ";
		}  
		else if(isset($str2) && isset($str3) && isset($str4)){
			$sql =  "SELECT * FROM ngo natural join cities where cities.city_name=ngo.city and cities.city_id=".$str." and ngo.name='".$str2."' and ngo.id='".$str3."' and ngo.sector like '%$str4%' ";
		}  
		else if(empty($str2) && isset($str3) && isset($str4)){
			$sql =  "SELECT * FROM ngo natural join cities where cities.city_name=ngo.city and cities.city_id=".$str." and ngo.id='".$str3."' and ngo.sector like '%$str4%' ";
		}
	}

if(( $str=='--Select City--' || empty($str)) && ($str4!='--Select Sector--' && isset($str4)))

{	
 
    if(isset($str2) && isset($str3) ){
		$sql = "SELECT * FROM ngo where name='".$str2."' and id='".$str3."' and sector like '%$str4%'";	
	}
   if(isset($str2) && empty($str3))
            {
    
		$sql = "SELECT * FROM ngo where name='".$str2."' and sector like '%$str4%'";	
	}
    if(empty($str2) && isset($str3) ){
		$sql = "SELECT * FROM ngo where  id='".$str3."' and sector like '%$str4%'";	
	}
    if(empty($str2) && empty($str3)){
        
		$sql = "SELECT * FROM ngo where sector like '%$str4%'";	
	}
}


if(( $str=='--Select City--' || empty($str)) && ($str4=='--Select Sector--' || empty($str4)))

{	
 
    if(isset($str2) && isset($str3) ){
		$sql = "SELECT * FROM ngo where name='".$str2."' and id='".$str3."' ";	
	}
   if(isset($str2) && empty($str3))
            {
     
		$sql = "SELECT * FROM ngo where name='".$str2."'";	
	}
    if(empty($str2) && isset($str3) ){
		$sql = "SELECT * FROM ngo where  id='".$str3."'";	
	}
    if(empty($str2) && empty($str3)){
       
		$sql = "SELECT * FROM ngo where sector like '%$str4%'";	
	}
}
	if($sql)
		$result = mysqli_query($conn, $sql);
	//echo $sql;
	if (!$result || mysqli_num_rows($result)==0)
	{
		echo '<p style="color:red; font-size:50px;margin-top:20%;"><i>No NGO Found!! <br> Please Check The Information Entered</i></p>' ;
	}
	else{	
		echo'<table border="1" style="border-collapse:collapse; text-align:center; border:3px solid #558C89; width: 100%;" class="table-bordered">';
		echo'<tr>';
	    echo'<th style=" background-color: #558C89;color: white; text-align:center; padding: 10px;">ID</th>';
		echo'<th style=" background-color: #558C89;color: white; text-align:center;padding: 10px;">Name</th>';
		echo'<th style=" background-color: #558C89;color: white; text-align:center;padding: 10px;">Address</th>';
        echo'<th style=" background-color: #558C89;color: white; text-align:center;padding: 10px;">Sector</th>';
        echo'<th style=" background-color: #558C89;color: white; text-align:center;padding: 10px;">city/State</th>';
		
	 echo'</tr>';
while($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
			echo'<td style="border-bottom: 1px solid #ddd;border-bottom: 1px solid #558C89 ; padding: 10px;">'.$row['id'].'</td>';
			echo'<td style="border-bottom: 1px solid #ddd;border-bottom: 1px solid #558C89 ; padding: 10px;">'.$row['name'].'</td>';
			echo'<td style="border-bottom: 1px solid #ddd;border-bottom: 1px solid #558C89 ; padding: 10px;">'.$row['address'].'</td>';
			echo'<td style="border-bottom: 1px solid #ddd;border-bottom: 1px solid #558C89 ; padding: 10px;">'.$row['sector'].'</td>';
            echo'<td style="border-bottom: 1px solid #ddd;border-bottom: 1px solid #558C89 ; padding: 10px;">'.$row['city'].'</td>';
		echo '</tr>';
}
}  
mysqli_close($conn); 
?>  
