<?php
session_start();
include 'config.php';
include 'dbConnect.php';

//세션에 저장된 아이디값을 name에 저장.
$uid = $userid;
$utime = date('Y-m-d');
$upassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
//앞에서 포스트로 받은 값들 저장.
$utitle = $_POST['title'];
$ucontent = $_POST['content'];
//삭제 시 번호가 비워지지 않게 하기 위해 작성.
database("alter table talkBoard auto_increment = 1");

database(
    "INSERT INTO talkBoard
    (id, password, title, content, time, view) VALUES ('$uid',
    '$upassword',
    '$utitle',
    '$ucontent',
    '$utime', 0)
    ");

   if(isset($_POST['submit'])){ 
    // Include the database configuration file 
    
    // 서버에 저장될 디렉토리 이름
    $targetDir = "/usr/local/apache2.4/htdocs/uploads/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
        foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 

                // Upload file to server 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
                    $insertValuesSQL .= "('".$fileName."', NOW(), '".$utitle."'),"; 
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        } 
         
        if(!empty($insertValuesSQL)){ 
            $insertValuesSQL = trim($insertValuesSQL, ','); 
            // Insert image file name into database 
            $insert = $db->query("INSERT INTO images (file_name, uploaded_on, contentTitle) VALUES $insertValuesSQL"); 
            if($insert){ 
                $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                $statusMsg = "Files are uploaded successfully.".$errorMsg; 
                echo "
<script>
alert('파일 업로드가 완료 되었습니다.');
location.href='imageBoardPage.php';
</script>
";
            }else{ 
                $statusMsg = "파일 업로드에 오류가 발생했습니다.."; 
            } 
        } 
    }else{ 
        $statusMsg = '업로드할 파일을 선택하세요.'; 
    } 
     
    // Display status message 
    echo $statusMsg; 
} 


    echo"
    <script>
    alert('글쓰기가 완료되었습니다.');
    location.href = 'imageBoardPage.php';
</script>  
";
?>
 


<!doctype html>

<body>

</body>

</html>