

<?php
include('Dbconfig.php');
if($_POST['name'])
{
	$id=$_POST['name'];
	
	$stmt = $DB_con->prepare("SELECT * FROM cities WHERE city_state='$id'");
	$stmt->execute(array(':name' => $name));
	?><option selected="selected">--Select City--</option>
	<?php while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		?>
		<option value="<?php echo $row['city_id']; ?>"><?php echo $row['city_name']; ?></option>
		<?php
	}
}
?>
