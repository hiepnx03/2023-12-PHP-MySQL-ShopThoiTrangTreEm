<?php
require_once("connect.php");
if(isset($_GET["id"])){
	$id=isset($_GET["id"])?$_GET["id"]:"";
	$sql ="DELETE FROM adproduct WHERE ma_sp='$id'";
	$rel = mysqli_query($conn,$sql);
	echo "bạn đã xóa thành công";
	header('location: sell.php?action=adproduct');
}
?>