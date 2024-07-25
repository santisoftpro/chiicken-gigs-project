<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['insert']))
{
    $eib= $_SESSION['editbid'];
    $chickenName=$_POST['chickenName'];
    $chickenType=$_POST['chickenType'];
    $dob=$_POST['dob'];
    $category=$_POST['category'];
    $quantity=$_POST['quantity'];
    $sql4="UPDATE chicken SET chickenName=:chickenName, chickenType=:chickenType, dob=:dob, category=:category ,quantity=:quantity  WHERE  chicken_id=:eib";
    $query=$dbh->prepare($sql4);
    $query->bindParam(':category',$category,PDO::PARAM_STR);
    $query->bindParam(':product',$product,PDO::PARAM_STR);
    $query->bindParam(':price',$price,PDO::PARAM_STR);
    $query->bindParam(':eib',$eib,PDO::PARAM_STR);
    $query->execute();
    if ($query->execute())
    {
        echo '<script>alert("updated successfuly")</script>';
    }else{
        echo '<script>alert("update failed! try again later")</script>';
    }
}
?>
<div class="card-body">
    <?php
    $eid=$_POST['edit_id4'];
    $sql2="SELECT * FROM chicken where chicken_id=:eid";
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
                <div class="control-group">
                    <label class="control-label" for="basicinput">Chicken Name</label>
                    <div class="controls">
                     
                </div>  
                <div>&nbsp;</div>
                
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-sm-12 pl-0 pr-0">Chicken Name</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="chickenName" id="chickenName" class="form-control" value="<?php  echo $row->chickenName;?>" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-sm-12 pl-0 pr-0">Chicken Type</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="chickenType" value="<?php  echo $row->chickenType;?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 ">
                        <label class="col-sm-12 pl-0 pr-0">Date of Birth</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="dob" value="<?php  echo $row->dob;?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 ">
                        <label class="col-sm-12 pl-0 pr-0">Category</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="category" value="<?php  echo $row->category;?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 ">
                        <label class="col-sm-12 pl-0 pr-0">Quantity</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="quantity" value="<?php  echo $row->quantity;?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="insert" class="btn btn-primary btn-fw mr-2" style="float: left;">Update</button>
            </form>
            <?php 
        }
    } ?>
</div>