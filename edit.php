<?php
include('connection.php');

$messages="";


//Edit
if (isset($_GET['id'])) {
    $id=$_GET['id'];

    $sql = "SELECT id,item, quantity, price FROM transaction WHERE id=$id";
    $result = $conn->query($sql);
    // output data of row
    $row = $result->fetch_assoc();
        $id=$row['id'];
        $item=$row['item'];
        $quantity=$row['quantity'];
        $price=$row['price'];

       
} else {
    
            if (isset($_POST['id']) && $_POST['id']!='') {
                //Get submitted form
                $id=$_POST['id'];
                $item=$_POST['item'];
                $quantity=$_POST['quantity'];
                $price=$_POST['price'];
                # update
                $sql = "UPDATE transaction SET item='$item',quantity='$quantity',price='$price'  WHERE id=$id";

                if ($conn->query($sql) === TRUE) {
                    $messages= "Record updated successfully";
                    header('location:index.php');
                } else {
                    $messages="Error updating record: " . $conn->error;
                }
            }else {
                if (isset($_POST['item']) && $_POST['quantity'] && $_POST['price']) {
                    //Get submitted form
                    $item=$_POST['item'];
                    $quantity=$_POST['quantity'];
                    $price=$_POST['price'];
    
                    //select query for data above
                    //check if the query is true
                    //if true, then message will be "Double entry"
                    //else Perform insert




                    $messages= $item.' was bought and the quantity is '.$quantity.' at unit price of '.$price;
                    //End 
    
                    //Insert into database
                    $sql = "INSERT INTO transaction (item, quantity, price) VALUES ('$item', '$quantity', '$price')";
    
                    if ($conn->query($sql) === TRUE) {
                        $messages= "New record created successfully";
    
                        header('location:index.php');
                    } else {
                        $messages= "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
                //End insert
            }
            
}
//End Edit



$conn->close();
include('header.php');
?>

<body>

<a href="index.php" type="button" class="btn btn-xs btn-info">Go Back</a>

<hr width="400px" style="color:#ffffff;">
    
<form style="background-color:#5FE036;" action="edit.php" method="POST">

<br><br>

      <label for="Item">Item</label>
      <input type="text" class="form-control" id="Item" name="item" placeholder="Item" value="<?php echo $item; ?>">
<br>
<br>

      <label for="Quantity">Quantity</label>
      <input type="number" class="form-control" id="Quantity" name="quantity" placeholder="Quantity" value="<?php echo $quantity; ?>">
<br>
<br>
      <label for="Price">Unit Price</label>
      <input type="text" class="form-control" id="Price" name="price" placeholder="Unit Price" value="<?php echo $price; ?>">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
<br>
<br>


  <button type="submit" class="btn btn-primary">Submit</button>

  <br>
  <br>

  <?php 
  echo '<span style="color:red;">'.$messages.'</span>'; 
  ?>
</form>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
</body>


</html>