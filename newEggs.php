<?php
include('includes/checklogin.php');
check_login();
if(isset($_POST['submit']))
{
    $eggName=$_POST['eggName'];
    $quantity=$_POST['quantity'];
    $price=$_POST['price'];
    $sql="INSERT INTO `eggs`(`name`, `quantity`, `price`) VALUES (:eggName, :quantity, :price)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':eggName',$eggName,PDO::PARAM_STR);
    $query->bindParam(':quantity',$quantity,PDO::PARAM_STR);
    $query->bindParam(':price',$price,PDO::PARAM_STR);
    if ($query->execute()){
        echo '<script>alert("Eggs has been Added Successfully")</script>';
    }else{
        echo '<script>alert("Eggs failed! try again later")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php");?>
<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <?php @include("includes/header.php");?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            <?php @include("includes/sidebar.php");?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="float: left;">Add New Eggs</h5>
                                </div>

                                <div class="card-body">
                                    
                                            <form method="post">
                                               
                                                <div>&nbsp;</div>
                                                <div class="row">
                                                    <div class="form-group row col-md-6">
                                                        <label class="col-12" for="register1-username">Eggs name:</label>
                                                        <div class="col-12">
                                                            <input type="text" class="form-control" name="eggName" placeholder="Eggs Name" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row col-md-6">
                                                        <label class="col-12" for="register1-email">Eggs Quantity:</label>
                                                        <div class="col-12">
                                                            <input type="text" class="form-control" name="quantity" placeholder="eggs Quantity" required='true'  >
                                                        </div>
                                                    </div>
                                                </div>
                                             
                                            <div class="row"> 
                                                <div class="form-group row col-md-6">
                                                    <label class="col-12" for="register1-password">Eggs Price:</label>
                                                    <div class="col-12">
                                                        <input type="number" class="form-control" name="price" placeholder="Egg Price" required='true' >
                                                    </div>
                                                </div>
                                               
                                            </div>

                                         
                                    <br>
                                    <button type="submit" name="submit" class="btn btn-primary btn-fw mr-2" style="float: left;">Save Eggs</button>
                                    
                                    <a href="listEggs.php" class="btn btn-primary btn-fw mr-2" style="float: left;">Close</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            <?php @include("includes/footer.php");?>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<?php @include("includes/foot.php");?>
</body>
</html>