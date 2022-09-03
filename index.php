<?php
include('connection.php');

if (!isset($_SESSION['id'])) {
    header('location:login');
}

$messages="";
$userid=$_SESSION['id'];
echo $userid;
//Select from DB
$history="";
$count=1;
$revenue=0;

        $sql = "SELECT id, item, quantity, price, salestime FROM transaction WHERE softdelete='0' AND userid='$userid'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $id=$row['id'];
                $item=$row['item'];
                $quantity=$row['quantity'];
                $price=$row['price'];
                $salestime=$row['salestime'];
                $total=$price * $quantity;
                $revenue+=$total;

                $history.="<tr>
                            <td>".$count."</td>
                            <td>".$item."</td>
                            <td>".$quantity."</td>
                            <td>".$price."</td>
                            <td>".$total."</td>
                            <td>".$salestime."</td>
                            <td>
                            <a href='edit?id=".$id."' type='button' class='btn btn-xs btn-info'>Edit</a> 
                             
                            <a href='delete?id=".$id."' type='button' class='btn btn-xs btn-danger'>Delete</a>
                            </td>
                        </tr>";

                        $count++;
            }
        } else {
            $history= "0 results";
        }
//End

$conn->close();
include('header.php');
?>


<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index">Shop</a>
            </div>
     
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="logout"><i class="fa fa-fw fa-dashboard"></i> Logout</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         Dailycash
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->


             <div class="col-lg-12">
                        <h2>Transactions  &emsp; Welcome <?php echo $_SESSION['fn']; ?>  </h2> 
                        <a href="edit" type="button" class="btn btn-xs btn-info">Add New</a>
                                
                        <div class="table-responsive">
                        <br>
                        Revenue= <?php echo  "&#8358; ".number_format($revenue,2);?>
                        <br>
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th><b>Total Price</b></th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo $history; ?>
                                </tbody>
                                <tbody>
                                       
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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
