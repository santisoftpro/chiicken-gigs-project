<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('includes/checklogin.php');
check_login();


if(isset($_GET['del'])) {    
    $cmpid = intval($_GET['del']);
    $sql = "DELETE FROM child WHERE child_Id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $cmpid, PDO::PARAM_INT);
    $query->execute();
    echo "<script>alert('Child record deleted.');</script>";   
    echo "<script>window.location.href='manage-child.php';</script>";
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
                                <!-- Start modal -->
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
                                        </div>
                                    </div>
                                </div>
                                <!-- End modal -->

                                <!-- Start modal -->
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
                                        </div>
                                    </div>
                                </div>
                                <!-- End modal -->

                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover table-bordered" id="dataTableHover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Child Name</th>
                                                <th class="text-center">Born Location</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center" style="width: 15%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM child";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if($query->rowCount() > 0) {
                                                foreach($results as $row) {
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo htmlentities($cnt);?></td>
                                                        <td><a href="#" class="edit_data5" id="<?php echo ($row->child_Id);?>" ><?php echo htmlentities($row->childName);?></a></td>
                                                        <td class="text-center"><?php echo htmlentities($row->location);?></td>
                                                        <td class="text-center"><?php echo htmlentities($row->status);?></td>
                                                        <td class="text-center">
                                                            <a href="#" class="edit_data4" id="<?php echo ($row->child_Id); ?>" title="click to edit"><i class="mdi mdi-pencil-box-outline" aria-hidden="true"></i></a>
                                                            <a href="#" class="edit_data5" id="<?php echo ($row->child_Id); ?>" title="click to view">&nbsp;<i class="mdi mdi-eye" aria-hidden="true"></i></a>
                                                            <a href="manage-child.php?del=<?php echo $row->child_Id;?>" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do you really want to delete?');"><i class="mdi mdi-delete"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php 
                                                    $cnt++;
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
                var edit_id4 = $(this).attr('id');
                $.ajax({
                    url: "edit_child.php",
                    type: "post",
                    data: {edit_id4: edit_id4},
                    success: function(data){
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
                var edit_id5 = $(this).attr('id');
                $.ajax({
                    url: "view_child.php",
                    type: "post",
                    data: {edit_id5: edit_id5},
                    success: function(data){
                        $("#info_update5").html(data);
                        $("#editData5").modal('show');
                    }
                });
            });
        });
    </script>
</body>
</html>
