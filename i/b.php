<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>66010914013พัชยา ศรีมุกดา (โฟม)</title>
</head>

<body>

<h1>งาน i -- พัชยา ศรีมุกดา (โฟม)</h1>

<form method="post" action="" enctype="multipart/form-data">
	ชื่อจังหวัด <input type="text" name="pname" autofocus required><br>
    รูปภาพ<input type="file" name="pimages" required> <br>
    <button type="submit" name="Submit">บันทึก</button>
</form><br><br>

<?php
if(isset($_POST['Submit'])) {
	include_once("connectdb.php");
	$rname = $_POST['rname'];
	$sql = "INSERT INTO `regions` (`r_id`, `r_name`) VALUES (NULL, '{$_POST['rname']}') ";
	mysqli_query($conn, $sql2) or die ("เพิ่มข้อมูลไม่ได้");
}
?>


<table border="1">
	<tr>
    	<th>รหัสจังหวัด</th>
        <th>ชื่อจังหวัด</th>
        <th>รูป</th>
        <th>ลบ</th>
	</tr>
<?php
include_once("connectdb.php");
$sql = "SELECT * FROM `provinces`";
$rs = mysqli_query($conn, $sql3);

while ($data = mysqli_fetch_array($rs3)){
?>
	<option value="<?php echo $data['r_name'] ; ?>"
    	<tr>
    	<td>
?>
	</td>
        <td><?php echo $data['r_name'] ; ?></td>
        <td><img src="images/<?php echo $data['r_id'] ; ?>.<?php echo $data['p_ext'] ; ?>" width="180"</td></td>
		<td width="80" align="center"><a href="delete_regions.php?id=<?php echo $data['r_id'] ; ?>" onClick="return confirm('ยืนยันการลบ?');"><img src="images/delete.jpg" width="20"></a></td>
    </tr>
<?php } ?>
</table> 

<?php
mysqli_close($conn)
?>

</body>
</html>