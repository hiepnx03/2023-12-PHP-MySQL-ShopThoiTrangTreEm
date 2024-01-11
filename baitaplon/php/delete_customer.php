<?php
require_once("connect.php");
if(isset($_GET["id"]))
{
	$id = isset($_GET["id"])?trim($_GET["id"]):"";
	$sql = "DELETE FROM customer WHERE ma_khachhang = '$id'";
	$sql1 = "DELETE FROM dathang WHERE mahd = '$id'";
	$sql2 = "DELETE FROM orderdetail WHERE ma_hoadon = '$mahd'";
	mysqli_query($conn,$sql);
    header('location: sell.php?action=customer');
	//header('Location: dathang.php');
	//header('Location: orderdetail.php');
}
/*if(isset($_GET["id"]))
{
	$id = isset($_GET["id"])?trim($_GET["id"]):"";
	$sql = "DELETE FROM dathang WHERE mahd = '$id'";
	mysqli_query($conn,$sql);
	header('Location: dathang.php');
}
if(isset($_GET["id"]))
{
	$id = isset($_GET["id"])?trim($_GET["id"]):"";
	$sql = "DELETE FROM orderdetail WHERE mahd = '$mahd'";
	mysqli_query($conn,$sql);
	header('Location: orderdetail.php');
}
*/

?>