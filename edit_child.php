<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_POST['insert'])) {
    $eib = $_SESSION['editbid'];
    $childName = $_POST['childname'];
    $location = $_POST['locationborn'];
    $status = $_POST['statushe'];

    // Print the values for debugging
    echo "eib: $eib, childName: $childName, location: $location, status: $status";

    $sql4 = "UPDATE child SET childName = :childName, location = :location, status = :status WHERE child_Id = :eib";
    $query = $dbh->prepare($sql4);

    $query->bindParam(':childName', $childName, PDO::PARAM_STR);
    $query->bindParam(':location', $location, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':eib', $eib, PDO::PARAM_INT); // Assuming child_Id is an integer

    try {
        if ($query->execute()) {
            echo "eib: $eib, childName: $childName, location: $location, status: $status";
            // echo '<script>alert("Updated successfully")</script>';
            // echo "eib: $eib, childName: $childName, location: $location, status: $status";
        } else {
            throw new Exception("Update failed");
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo '<script>alert("Update failed! Try again later")</script>';
    }
}
?>

<div class="card-body">
    <?php
    $eid=$_POST['edit_id4'];
    $sql2="SELECT * FROM child WHERE child_Id=:eid";
    $query2 = $dbh -> prepare($sql2);
    $query2-> bindParam(':eid', $eid, PDO::PARAM_STR);
    $query2->execute();
    $results=$query2->fetchAll(PDO::FETCH_OBJ);
    if($query2->rowCount() > 0)
    {
        foreach($results as $row)
        {
            $_SESSION['editbid']=$row->id;
            ?>
            <form class="form-sample"  method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-sm-12 pl-0 pr-0">Child Name</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="childname" id="childName" class="form-control" value="<?php  echo $row->childName;?>" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 ">
                        <label class="col-sm-12 pl-0 pr-0">Born Location</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="locationborn" value="<?php  echo $row->location;?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 ">
                        <label class="col-sm-12 pl-0 pr-0">status</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="statushe" value="<?php  echo $row->status;?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="insert" class="btn btn-primary btn-fw mr-2" style="float: left;">Update</button>
            </form>
            <?php 
        }
    } ?>
</div>