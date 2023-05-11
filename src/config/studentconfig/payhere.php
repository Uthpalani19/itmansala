<?php 
session_start();

$total = count($_SESSION['cart'])*1000;

$amount = $total;
$merchant_id = "1223133";
$order_id = uniqid();
$merchant_secret = "MjY2MTkzNzE5NzU5NjQwNzgxMTMwNjQ5MTY4Mjg4MjI2OTg1OQ==";
$currency = "LKR";
$hash = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        number_format($amount, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchant_secret)) 
    ) 
);

$array = [];
$array["amount"] = $amount;
$array["merchant_id"] = $merchant_id;
$array["order_id"] = $order_id;
$array["currency"] = $currency;
$array["hash"] = $hash;
$array["items"] = $_SESSION["prod_name"];
$array["phone"] = $_SESSION["studentphone"];
$array["name"] = $_SESSION["studentname"];
$array["email"] = $_SESSION["studentemail"];

$jsonObj = json_encode($array);

echo $jsonObj;
?>