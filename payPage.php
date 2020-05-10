<?php
include 'config.php';
include 'dbConnect.php';
$sql = database(
    "SELECT * FROM donation ORDER BY donationDate limit 1"
);
$donationInfo = mysqli_fetch_array($sql);
$email = $donationInfo['email'];
$address = $donationInfo['address'];
$phone = $donationInfo['phone'];
$donationCost = $donationInfo['donationCost'];
$donationName = $donationInfo['donationName'];
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>기부 결제 창</title>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
<script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
</head>
<body>
<script>
var IMP = window.IMP;
 IMP.init('imp35441007');

IMP.request_pay({
    pg : 'inicis',
    pay_method : 'card',
    merchant_uid : 'merchant_' + new Date().getTime(),
    name : '주문명:결제테스트',
    amount : <?=$donationCost?>,
    buyer_email : '<?=$email?>',
    buyer_name : '<?=$donationName?>',
    buyer_tel : '<?=$phone?>',
    buyer_addr : '<?=$address?>',
    buyer_postcode : '123-456'
}, function(rsp) {
    if ( rsp.success ) {
        var msg = '결제가 완료되었습니다.';
        msg += '고유ID : ' + rsp.imp_uid;
        msg += '상점 거래ID : ' + rsp.merchant_uid;
        msg += '결제 금액 : ' + rsp.paid_amount;
        msg += '카드 승인번호 : ' + rsp.apply_num;
       
        location.replace("mainPage.php");    
    } else {
        var msg = '결제에 실패하였습니다.';
        msg += '에러내용 : ' + rsp.error_msg; 
        location.replace("mainPage.php");
    
    }
    alert(msg);
});

</script>
  </body>
</html>