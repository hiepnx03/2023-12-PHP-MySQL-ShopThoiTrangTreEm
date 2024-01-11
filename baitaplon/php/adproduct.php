<?php
require_once("connect.php");
?>
<table width="1000" height="300" border="2">
    <tr>
        <td colspan="30">quản lý danh sách sản phẩm</td>
    </tr>
    <tr>
        <td colspan="30"><a href="sell.php?action=themsp" style="color:blue" >Thêm Mới</a></td>
    </tr>
    <tr>
        <td>Mã Loại sản phẩm</td>
        <td>Mã sản phẩm</td>
        <td>Tên sản phẩm</td>
        <td>Hình ảnh</td>
        <td>Giá Nhập</td>
        <td>Giá xuất</td>
        <td>Khuyến mại</td>
        <td>Số lượng</td>
        <td>Môt tả sản phẩm</td>
        <td>Ngày tạo</td>
        <td>Xóa</td>
        <td>cập nhập</td>
  	</tr>
    <tr>
    <?php
		$sql="SELECT * FROM adproduct";
		$rel=mysqli_query($conn,$sql);
		while($r=mysqli_fetch_assoc($rel)){
	?>
    <tr>
        <td><?php echo $r['ma_loaisp']?></td>
        <td><?php echo $r['ma_sp']?></td>
        <td><?php echo $r['tensp']?></td>
        <td><img src="images/<?php echo $r['hinhanh']?>" width="80"></td>
        <td><?php echo $r['gianhap']?></td>
        <td><?php echo $r['giaxuat']?></td>
        <td><?php echo $r['khuyenmai']?></td>
        <td><?php echo $r['soluong']?></td>
        <td><?php echo $r['mota_sp']?></td>
        <td><?php echo $r['create_date']?></td>
        <td><a href="delete_sp.php?id=<?php echo $r['ma_sp']?>"style="color:blue">xóa</td>
        <td><a href="updatesp.php?id=<?php echo $r['ma_sp']?>"style="color:blue">cập nhập</td>
  	</tr>
  <?php }?>
    </tr>
</table>


<style>
    table {
        width: 100%;
        height: 300px;
        border: 2px solid black;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table td,
    table th {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
    }

    table td img {
        max-width: 80px;
        max-height: 80px;
    }

    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table tr:hover {
        background-color: #ddd;
    }

    table tr:first-child {
        font-weight: bold;
        background-color: #333;
        color: white;
    }

    a {
        text-decoration: none;
        color: blue;
    }

    a:hover {
        text-decoration: underline;
        color: red;
    }
</style>