<?php
include('includes/checklogin.php');
check_login();
if(isset($_POST['submit']))
{
    $chickenName=$_POST['chickenName'];
    $location=$_POST['location'];
    $status=$_POST['status'];
    $sql="INSERT INTO `child`(`childName`, `location`, `status`) VALUES ('$childname','$location','$status')";
    $query = $dbh->prepare($sql);
    $query->bindParam(':chickenName',$chickenName,PDO::PARAM_STR);
    $query->bindParam(':location',$location,PDO::PARAM_STR);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    if ($query->execute()){
        echo '<script>alert("Child has been Added successfully")</script>';
    }else{
        echo '<script>alert("Child failed! try again later")</script>';
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
                                                        <label class="col-12" for="register1-username">Child name:</label>
                                                        <div class="col-12">
                                                            <input type="text" class="form-control" name="chickenName" placeholder="Chicken Name" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row col-md-6">
                                                        <label class="col-12" for="register1-email">Location Born:</label>
                                                        <div class="col-12">
                                                            <input type="text" class="form-control" name="location" placeholder="Location Born" required='true'  >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group row col-md-6">
                                                      <label class="col-12" for="register1-email">status
                                                      </label>
                                                      <div class="col-12">
                                                        <select name="status" class="form-control" required='true'>
                                                            <option value="">Healthy</option>
                                                            <option value="">Mederate</option>
                                                            <option value="">Improvement</option>
                                                        </select>
                                                        
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            

                                           
                                    <br>
                                    <button type="submit" name="submit" class="btn btn-primary btn-fw mr-2" style="float: left;">Save Children</button>
                                    
                                    <a href="manage-child.php" class="btn btn-primary btn-fw mr-2" style="float: left;">Close</a>
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