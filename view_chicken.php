<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<div class="card-body">
  <h3><?php  echo $_POST['edit_id'];?></h3>
  <?php
  $eid=$_POST['edit_id5'];
  $sql="SELECT * FROM chicken  WHERE chicken_id=:eid";
  $query = $dbh -> prepare($sql);
  $query-> bindParam(':eid', $eid, PDO::PARAM_STR);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
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

        <h4 style="color: blue">Category Information</h4>
        <table border="1" class="table table-bordered">
          <tr>
            <th>Chicken Name</th>
            <td><?php  echo $row->chickenName;?></td>
          </tr>
          <tr>
            <th>Type</th>
            <td><?php  echo $row->chickenType;?></td>
          </tr>
          <tr>
            <th>DOB</th>
            <td><?php  echo $row->dob;?></td>
          </tr>
          <tr>
            <th>Category</th>
            <td><?php  echo $row->category;?></td>
          </tr>
          <tr>
            <th>Quantity</th>
            <td><?php  echo $row->quantity;?></td>
          </tr>
          <tr>
            <th>Age</th>
            <td><?php  echo "$years years, $months months, and $days days";?></td>
          </tr>
        </table> 
        <?php 
      }
    } ?>
  </div>