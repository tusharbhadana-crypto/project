<?php
    session_start();
    require '../../db/db.php';
    if($_SESSION['login']!==true){
        header("location:../login.php");
    }
    if($_SESSION['role']!=="Applicant"){
        header("location:../login.php");
    }

    if($_SERVER['REQUEST_METHOD']==='GET'){
        $job_id=$_GET['job_id'];

    } 
//     if($_SERVER['REQUEST_METHOD']==='POST'){
//         $job_id=$_POST['job_id'];
//         $applicant_id=$_SESSION['user_id'];
//         $pdf_name=$_FILES["cv"]["name"];
//         $tmp_name=$_FILES["cv"]["tmp_name"];
//         // $dir="uploads/". basename($tmp_name);

// $target_dir = "uploads/";
// $target_file = $target_dir . basename($_FILES["cv"]["name"]);

// // Moves the file from temporary storage to your 'uploads' folder
// if (move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file)) {
//     echo "The file has been saved.";
// }
// die('jajaj');
//         // /var/www/tbhadhana/public_html/tushar/job_management
//         move_uploaded_file($tmp_name,$dir);

//         $sql="insert into applications (
//             job_id,
//             applicant_id,
//             cv) values (
//             '$job_id',
//             '$applicant_id',
//             '$dir'
//             )";


//         // if(move_uploaded_file($tmp_name,$dir)){
//         //     if($conn->query($sql)===true){
//         //         echo("applied !!!!!!!!!");

//         //     }else{
//         //         echo" error is".$conn->error;
//         //     }
//         // }

//     }
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $job_id = $_POST['job_id'];
    $applicant_id = $_SESSION['user_id'];

    $image_name = $_FILES['cv']['name'];
    $tmp_name = $_FILES['cv']['tmp_name'];
    $folder = "uploads/" . basename($image_name);

        echo"hiiiiiiiiiiiiiiiii";
    if (move_uploaded_file($tmp_name, $folder)) {
            
        $sql="insert into applications (
            job_id,
            applicant_id,
            cv) values (
            '$job_id',
            '$applicant_id',
            '$folder'
            )";
        echo"hiiiiiiiiiiiiiiiii";
        if($conn->query($sql)===true){
            echo "<script>alert('Applied successfully');</script>";
            header("location:dashboard.php");
        }else{
            echo"error is  ".$conn->error;
        }
        
    }else{
        echo"bahaaar";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 400px;">

        <div class="card-body">

            <h3 class="text-center mb-4">Register</h3>

            <form  action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">upload cv</label>
                    <input 
                        type="file" 
                        name="cv" 

                        required
                    >
                </div>

                <input type="hidden" name="job_id" value="<?php echo $job_id ?>">
                <button class="btn btn-primary w-100">
                    Apply
                </button>

            </form>

        </div>

    </div>

</body>
</html>