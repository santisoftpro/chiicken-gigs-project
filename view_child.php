<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<div class="card-body">
  <h3><?php  echo $_POST['edit_id'];?></h3>
  <?php
  $eid=$_POST['edit_id5'];
  $sql="SELECT * FROM child WHERE child_Id=:eid";
  $query = $dbh -> prepare($sql);
  $query-> bindParam(':eid', $eid, PDO::PARAM_STR);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0)
  {
    foreach($results as $row)
      {?>

        <h4 style="color: blue">Child Information</h4>
        <table border="1" class="table table-bordered">
          <tr>
            <th>Child Name</th>
            <td><?php  echo $row->childName;?></td>
          </tr>
          <tr>
            <th>Born Location</th>
            <td><?php  echo $row->location;?></td>
          </tr>
          <tr>
            <th>stutus</th>
            <td><?php  echo $row->status;?></td>
          </tr>
        </table> 
        <?php 
      }
    } ?>
  </div>