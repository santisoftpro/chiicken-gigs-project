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
    $sql="INSERT INTO `chicken`(`chickenName`, `chickenType`, `dob`, `category`, `quantity`) VALUES (:chickenName, :types, :dob, :category, :quantity)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':chickenName',$chickenName,PDO::PARAM_STR);
    $query->bindParam(':types',$types,PDO::PARAM_STR);
    $query->bindParam(':dob',$dob,PDO::PARAM_STR);
    $query->bindParam(':category',$category,PDO::PARAM_STR);
    $query->bindParam(':quantity',$quantity,PDO::PARAM_STR);
    if ($query->execute()){
        echo '<script>alert("Chicken has been Added successfully")</script>';
    }else{
        echo '<script>alert("Chicken failed! try again later")</script>';
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
                                    <h5 class="modal-title" style="float: left;">Add New Checken</h5>
                                </div>

                                <div class="card-body">
                             
                                            <form method="post">
                                               
                                                <div>&nbsp;</div>
                                                <div class="row">
                                                    <div class="form-group row col-md-6">
                                                        <label class="col-12" for="register1-username">Chicken name:</label>
                                                        <div class="col-12">
                                                            <input type="text" class="form-control" name="chickenName" placeholder="Chicken Name" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row col-md-6">
                                                        <label class="col-12" for="register1-email">Chicken Type:</label>
                                                        <div class="col-12">
                                                            <input type="text" class="form-control" name="types" placeholder="Chicken Type" required='true'  >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group row col-md-6">
                                                      <label class="col-12" for="register1-email">Birthdate:
                                                      </label>
                                                      <div class="col-12">
                                                        <input type="date" class="form-control" name="dob" value="" placeholder="Date of Birtth" required='true'  >
                                                    </div>
                                                </div>
                                                <div class="form-group row col-md-6">
                                                    <label class="col-12" for="register1-email">Chicken Category:</label>
                                                    <div class="col-12">
                                                        <input type="text" class="form-control" name="category" placeholder="Chicken Category" required='true' >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row"> 
                                                <div class="form-group row col-md-6">
                                                    <label class="col-12" for="register1-password">Quantity:</label>
                                                    <div class="col-12">
                                                        <input type="number" class="form-control" name="quantity" placeholder="Chicken Quantity" required='true' >
                                                    </div>
                                                </div>
                                               
                                            </div>

                                           
                                    <br>
                                    <button type="submit" name="submit" class="btn btn-primary btn-fw mr-2" style="float: left;">Save Checken</button>
                                    
                                    <a href="listChicken.php" class="btn btn-primary btn-fw mr-2" style="float: left;">Close</a>
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