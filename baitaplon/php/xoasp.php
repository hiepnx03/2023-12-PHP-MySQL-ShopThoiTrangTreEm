<?php
require_once("connect.php");
if(isset($_GET["id"])){
	$id=isset($_GET["id"])?$_GET["id"]:"";
	$sql="DELETE FROM adproducttype WHERE ma_loaisp ='$id'";
	mysqli_query($conn,$sql);
	header('location: sell.php?action=adproducttype');
}
?>