<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css"
</head>

<body>
<div class="admin">
	<div class="admin_col1">
    	<div class="admin_col1_left">
        	<a href="sell.php?action=adproducttype">quản lý danh mục loại sản phẩm</a>
        </div>
        <div class="admin_col1_left">
        	<a href="sell.php?action=adproduct">quản lý danh mục sản phẩm</a>
        </div>
    </div>
    <div class="admin_col2">
    <!--Nội dung-->
<?php
require_once("connect.php");
$id = $_GET["id"];
$sql = "SELECT * FROM adproducttype WHERE ma_loaisp = '$id'";
$rel = mysqli_query($conn,$sql);
$sanpham = mysqli_fetch_assoc($rel);
if(!$sanpham)
{
	echo "Không tìm thấy sản phẩm";
	exit();
}
$txt_maloaisp=isset($_POST["txt_maloaisp"])?$_POST["txt_maloaisp"]:"";
$txt_tenloaisp=isset($_POST["txt_tenloaisp"])?$_POST["txt_tenloaisp"]:"";
$txt_motaloaisp=isset($_POST["txt_motaloaisp"])?$_POST["txt_motaloaisp"]:"";
if(isset($_POST["btn_update"]))
{
	$sql1 = "UPDATE adproducttype SET ma_loaisp = '$txt_maloaisp', ten_loaisp = '$txt_tenloaisp', mota_loaisp = '$txt_motaloaisp' WHERE ma_loaisp = '$id'";
	$rel1 = mysqli_query($conn,$sql1);
	echo "Bạn đã cập nhật thành công";
}
?>
<form action="" method="post">
	<table width="200" border="1">
  <tr>
    <td colspan="2">Danh sách loại sản phẩm</td>
  </tr>
  <tr>
    <td>Mã loại sản phẩm</td>
    <td><input name="txt_maloaisp" type="text" value="<?php echo $txt_maloaisp;?>"></td>
  </tr>
  <tr>
    <td>Tên loại sản phẩm</td>
    <td><input name="txt_tenloaisp" type="text" value="<?php echo $txt_tenloaisp;?>"></td>
  </tr>
  <tr>
    <td>Mô tả loại sản phẩm</td>
    <td><textarea name="txt_motaloaisp" cols="20" rows="5" value="<?php echo $txt_motaloaisp;?>">
		<?php echo $txt_motaloaisp;?></textarea>
    </td>
  </tr>
  <tr>
  	<td colspan="2">
    	<input name="btn_update" type="submit" value="sửa">
    </td>
  </tr>
</table>

</form>