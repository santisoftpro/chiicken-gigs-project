<?php
include('includes/checklogin.php');
check_login();
if(isset($_POST['submit']))
{
    $chickenName=$_POST['chickenName'];
    $types=$_POST['types'];
    $dob=$_POST['dob'];
    $category=$_POST['category'];
    $quantity=$_POST['quantity'];
    $sql="INSERT INTO `chicken`(`chickenName`, `chickenType`, `dob`, `category`, `quantity`, `dates`) VALUES (chickenName:,types:,dob:,category:,quantity:)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':chickenName',$chickenName,PDO::PARAM_STR);
    $query->bindParam(':types',$types,PDO::PARAM_STR);
    $query->bindParam(':dob',$dob,PDO::PARAM_STR);
    $query->bindParam(':category',$category,PDO::PARAM_STR);
    $query->bindParam(':quantity',$quantity,PDO::PARAM_STR);
    $query->execute();
    if ($query->execute()){
        echo '<script>alert("Chicken has been Added successfully")</script>';
    }else{
        echo '<script>alert("Chicken failed! try again later")</script>';
    }
}
?>