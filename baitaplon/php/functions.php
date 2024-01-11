<?php
// functions.php

function addToCart($product_id, $product_name, $product_price, $product_discount, $product_image) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (!isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = [
            'ma_sp' => $product_id,
            'Ten_loaisp' => $product_name,
            'giaxuat' => $product_price,
            'khuyenmai' => $product_discount,
            'hinhanh' => $product_image,
            'qty' => 0,
        ];
    }

    $_SESSION['cart'][$product_id]['qty']++;
}
