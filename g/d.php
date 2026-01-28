<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>66010914013 พัชยา ศรีมุกดา (โฟม)</title>
</head>

<body>
<h1>66010914013 พัชยา ศรีมุกดา (โฟม)</h1>

<table border="1">
<tr>
    <th>ประเทศ</th>
    <th>ยอดขาย</th>
</tr>
<?php
include_once("connectdb.php");
$sql = "SELECT (`p_country`) , SUM(`p_amount`) AS total FROM `popsupermarket`GROUP BY `p_country`;";
$rs = mysqli_query($conn,$sql);
while ($date = mysqli_fetch_array($rs)){
?>
<tr>
    <td><?php echo $date['p_country'];?></td>
    <td align="right"><?php echo number_format($date['total'],0);?></td>

</tr>
<?php
}
mysqli_close($conn);
?>
</table>

</body>
</html>