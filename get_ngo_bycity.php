<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbcountries";
$str=$_GET["city"];
$str2=$_GET["name"];
$str3=$_GET["id"];


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if($str!=NULL && $str2==NULL && $str3==null)
{
$sql = "SELECT * FROM ngo natural join cities where cities.city_name=ngo.city and city_id=$str";
}
 
else if($str==NULL && $str2!=NULL && $str3==null)
{
$sql = "SELECT * FROM ngo name=AAN AAB WELFARE SOCIETY";
}
 


$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0)
{
echo "NO NGO'S" ;
}

else{
echo'<table border="1" style="border-collapse:collapse; text-align:center;" class="table-bordered">';
	    echo'<tr>';
	    echo'<th>ID</th>';
		echo'<th>Name</th>';
		echo'<th>Address</th>';
		
	 echo'</tr>';
while($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
			echo'<td>'.$row['id'].'</td>';
			echo'<td>'.$row['name'].'</td>';
			echo'<td>'.$row['address'].'</td>';
			
		echo '</tr>';
}
}

    

mysqli_close($conn);
    
?>  

	
