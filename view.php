<?php include "fun.php";
if(!isset($_SESSION['user'])){
    echo "<script>window.open('login.php','_self')</script>";
}
?>
<html lang="en">
    <head>
        <title>parking management system</title>
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <body>

    <?php 
$id = $_GET['id'];
$data = view('records'," id='$id'");
?>

<?php include "header.php";?>

        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <td><?= $data['name'];?></td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td><?= $data['contact'];?></td>
                    </tr>
                    <tr>
                        <th>type</th>
                        <td><?= $data['type'];?></td>
                    </tr>
                    <tr>
                        <th>Model</th>
                        <td><?= $data['model'];?></td>
                    </tr>
                    <tr>
                        <th>Brand</th>
                        <td><?= $data['brand'];?></td>
                    </tr>
                    <tr>
                        <th>Reg_no</th>
                        <td><?= $data['reg_no'];?></td>
                    </tr>
                    <tr>
                        <th>color</th>
                        <td><?= $data['color'];?></td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td><?= $data['date'];?></td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td><?= $data['amount'];?></td>
                    </tr>
                </table>
                <a href="" class="btn btn-primary d-print-none" onclick="window.print();">Print This Challan</a>
                <a href="index.php" class="btn btn-success d-print-none">Go Back</a>
                </div>
            </div>
        </div>
    </body>
    </html>