<?php
session_start();
if(isset($_SESSION["userid"])){
$userid = $_SESSION["userid"];
}else{
$userid = "아이디값 세션에서 안받아짐";
}if(isset($_SESSION["username"])){
$username = $_SESSION["username"];

}else{
    $username = "이름 세션에서 안받아짐";
};
?>