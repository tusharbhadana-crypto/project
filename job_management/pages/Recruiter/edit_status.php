<?php
    session_start();
    require '../../db/db.php';
    if($_SESSION['login']!==true){
            echo "<script>
            alert('You are not logged in go back to login');
            window.location.href='../login.php';
            </script>";
            exit();
    }
    if($_SESSION['role']!=="Recruiter"){
        echo "<script>
        alert('You do not have access to this page go back to login');
        window.location.href='../login.php';
        </script>";
        exit();
    }
    require '../../db/db.php';
    if(isset($_GET) && (!empty($_GET['application_id']))){
        $application_id=$_GET['application_id'];
    }
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $application_id=$_POST['application_id'];
        $status=$_POST['status'];

        $sql="update applications set status='$status' where id=".$application_id;

        if($conn->query($sql)===TRUE){
            echo "<script>
            alert('Status updated successfully');
            window.location.href='dashboard.php';
            </script>";
        }else{
            die("error is ".$conn->error);
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
<body>
    
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <input type="hidden" name="application_id" value="<?php echo $application_id; ?>">
        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="rejected">Rejected</option>
            <option value="shortlisted">Shortlisted</option>
            <option value="interview_call">Interview Call</option>
            <option value="applied">Applied</option>
        </select>
        <button type="submit">Update Status</button>
    </form>

</body>
</html>