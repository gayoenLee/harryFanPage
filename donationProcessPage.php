<?php
include 'dbConnect.php';
include 'config.php';

$userId=$userid;
$donationName = $_POST['userName'];
$message = $_POST['message'];
$donationCost = $_POST['donationCost'];
$donationDate = date('Y-m-d H:i:s');
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

database(
"INSERT INTO donation
(userId, message, donationCost, donationDate, donationName, email, phone, address)
VALUES ('$userId', '$message', '$donationCost', '$donationDate', '$donationName', '$email', '$phone', '$address')"
);

echo"
<script>
alert('결제 창으로 이동합니다.');
location.href='payPage.php';
</script>
";
?>
