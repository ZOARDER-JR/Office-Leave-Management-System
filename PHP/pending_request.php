
<!DOCTYPE html>
<html>
<head>
  <title></title>

  <style type="text/css">
  #body{

    border: 1px black dashed;
    width: 700px;
    margin: 0px auto;
    margin-top: 20px;
    margin-bottom: 20px;
    padding: 10px;
  }

  td {
    text-align: center;
  }

  </style>
</head>
<body>
  <center><h1> Office Leave Management System (Admin Panel)</h1></center>
  <br><br>

  <div id="body">
     <?php
        include('connect.php');

        $result = mysqli_query($conn,"select * from request_table");

        if(mysqli_num_rows($result) > 0)
        {
      ?>
      <table style="width: 100%">
          <tr>
              <th>Username</th>
              <th>Days Requested</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
          <?php while( $row = mysqli_fetch_array($result) ) { ?>
          <tr>
              <td><?php echo $row['Username']; ?></td>
              <td><?php echo $row['Days']; ?></td>
              <td><?php echo $row['Status']; ?></td>
              <td>
                  <a href="view.php?id=<?php echo $row['Username']; ?>">View</a> /
                  <a href="accept.php?id=<?php echo $row['Username']; ?>"><?php if($row['Status'] == 1){?> Accepted <?php } else { ?> Accept <?php } ?> </a> /
                  <a href="reject.php?id=<?php echo $row['Username']; ?>"><?php if($row['Status'] == 2){?> Rejected <?php } else { ?> Reject <?php } ?> </a>
              </td>
          </tr>
          <?php } ?>
      </table>
<?php } ?>

      <center> <h4> <a href="admin.php"> Back </h4></center>
  </div>


</body>
</html>