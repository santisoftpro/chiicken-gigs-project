<?php
include('includes/checklogin.php');
check_login();
if(isset($_POST['save']))
{
    $category=$_POST['category'];
    $code=$_POST['code'];
    $sql="INSERT INTO tblcategory(CategoryName, CategoryCode) VALUES (:category, :code)";
    $query=$dbh->prepare($sql);
    $query->bindParam(':category', $category, PDO::PARAM_STR);
    $query->bindParam(':code', $code, PDO::PARAM_STR);
    $query->execute();
    $LastInsertId=$dbh->lastInsertId();
    if ($LastInsertId > 0) 
    {
        echo '<script>alert("Registered successfully")</script>';
        echo "<script>window.location.href ='category.php'</script>";
    }
    else
    {
        echo '<script>alert("Something went wrong. Please try again")</script>';
    }
}
if(isset($_GET['del'])){    
    $cmpid=$_GET['del'];
    $query=mysqli_query($con,"DELETE FROM chicken WHERE chicken_id='$cmpid'");
    echo "<script>alert('Chicken record deleted.');</script>";   
    echo "<script>window.location.href='listChicken.php'</script>";
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
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <!--  start  modal -->
                                <div id="editData4" class="modal fade">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Category details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="info_update4">
                                                <?php @include("edit_category.php");?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                </div>
                                <!--   end modal -->
                                <!--  start  modal -->
                                <div id="editData5" class="modal fade">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">View category details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="info_update5">
                                                <?php @include("view_category.php");?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                </div>
                                <!--   end modal -->
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover table-bordered" id="dataTableHover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Chicken Name</th>
                                                <th class="text-center">Type</th>
                                                <th class="text-center">DOB</th>
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Age</th>
                                                <th class="text-center" style="width: 15%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql="SELECT * FROM `chicken`";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            if($query->rowCount() > 0)
                                            {
                                                foreach($results as $row)
                                                {
                                                    $currentDate = date('Y-m-d');

                                                    // calculate ages
                                                    $dobDateTime = new DateTime($row->dob);
                                                    $currentDateTime = new DateTime($currentDate);
                                                    $ageInterval = $dobDateTime->diff($currentDateTime);
                                                    $years = $ageInterval->y;
                                                    $months = $ageInterval->m;
                                                    $days = $ageInterval->d;
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo htmlentities($cnt);?></td>
                                                        <td class=""><a href="#" class="edit_data5" id="<?php echo htmlentities($row->chicken_id); ?>" ><?php echo htmlentities($row->chickenName);?></a></td>
                                                        <td class="text-center"><?php echo htmlentities($row->chickenType);?></td>
                                                        <td class="text-center"><?php echo htmlentities(date("d-m-Y", strtotime($row->dob)));?></td>
                                                        <td class="text-center"><?php echo htmlentities($row->category);?></td>
                                                        <td class="text-center"><?php echo htmlentities($row->quantity);?></td>
                                                        <td class="text-center"><?php echo "$years years, $months months, and $days days"; ?></td>
                                                        <td class="text-center">
                                                            <a href="#" class="edit_data4" id="<?php echo htmlentities($row->chicken_id); ?>" title="click to edit"><i class="mdi mdi-pencil-box-outline" aria-hidden="true"></i></a>
                                                            <a href="#" class="edit_data5" id="<?php echo htmlentities($row->chicken_id); ?>" title="click to view">&nbsp;<i class="mdi mdi-eye" aria-hidden="true"></i></a>
                                                            <a href="listChicken.php?del=<?php echo $row->id;?>" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do you really want to delete?');"> <i class="mdi mdi-delete"></i> </a>
                                                        </td>
                                                    </tr>
                                                    <?php 
                                                    $cnt = $cnt + 1;
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
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
    <!-- End custom js for this page -->
    <script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click','.edit_data4',function(){
            var edit_id4=$(this).attr('id');
            $.ajax({
                url:"edit_chicken.php",
                type:"post",
                data:{edit_id4:edit_id4},
                success:function(data){
                    $("#info_update4").html(data);
                    $("#editData4").modal('show');
                }
            });
        });
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click','.edit_data5',function(){
            var edit_id5=$(this).attr('id');
            $.ajax({
                url:"view_chicken.php",
                type:"post",
                data:{edit_id5:edit_id5},
                success:function(data){
                    $("#info_update5").html(data);
                    $("#editData5").modal('show');
                }
            });
        });
    });
    </script>
</body>
</html>
