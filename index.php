<?php include "fun.php";

if(!isset($_SESSION['user'])){
    echo "<script>window.open('login.php','_self')</script>";
}

 //get userid

 $log = $_SESSION['user'];
 $query = mysqli_query($connect,"select * from admin where contact ='$log'");
 $user = mysqli_fetch_array($query);
 $user = $user[0];


?>
<html lang="en">
    <head>
        <title>parking management system</title>
        <link rel="stylesheet" href="bootstrap.css">
        <style>
        
            .bg-theme{
                background-color:#8e44ad;
            }
            .btn-theme{
                background-color:#b71540;
                color:white;
            }
        </style>
    </head>
    <body>  

      <?php include "header.php";?>

        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-lg-3">
                    <form action="index.php" method="post">

                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Contact</label>
                            <input type="text" name="contact" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">reg_no</label>
                            <input type="text" name="reg_no" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Type</label>
                            <select name="type" class="form-control">
                                <option value="1">Car</option>
                                <option value="2">MoterBike</option>
                                <option value="3">Cycle</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Color</label>
                            <input type="color" name="color" class="">
                        </div>
                        <div class="form-group">
                            <label for="">brand</label>
                            <input type="text" name="brand" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">model</label>
                            <input type="text" name="model" class="form-control">
                        </div>
                        <div class="form-group">
                            <select name="delivered" class="form-control">
                                <option value="1">True</option>
                                <option value="0">False</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" name="send">
                            <input type="reset" class="btn btn-danger" name="clear" value="clear">
                        </div>
                    </form>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-3 ml-auto">
                        
                    <form  method="get">
                        <input type="date" class="form-control" onChange="this.form.submit()" name="filter_date">
                    </form>
                    
                    </div>
                    </div>
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>Contact</th>
                            <th>Type</th>
                            <th>Reg_no</th>
                            <th>date</th>
                            <th>color</th>
                            <th>brand</th>
                            <th>model</th>
                            <th>delivered</th>
                            <th>amount</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $user_id = $user;

                            if(isset($_GET['find'])){
                                $search = $_GET['search'];

                                $calling = search("records"," (reg_no LIKE '%$search%' OR name LIKE '%$search%')");
                            }
                            elseif(isset($_GET['filter_date'])){
                                $date = strtotime($_GET['filter_date']);
                                $date =  Date("Y-m-d",$date);
                                $calling = search("records"," date='$date'");
                          
                            }
                            else{
                                $date = Date("Y-m-d");
                                $calling = calling("records","  WHERE user_id='$user_id' AND date='$date' ORDER BY delivered ASC");
                            }

                            foreach($calling as $record):
                                if($record['delivered'] == 1){
                                    $bg = "bg-white";
                                }
                                elseif($record['delivered'] == 0){
                                    $bg = "bg-theme text-white";
                                }
                            ?>
                            <tr class="<?= $bg;?>">
                                <td><?= $record_id = $record['id'];?></td>
                                <td><?= $record['name'];?></td>
                                <td><?= $record['contact'];?></td>
                                <td><?= $record['type'];?></td>
                                <td><?= $record['reg_no'];?></td>
                                <td><?= $record['date'];?></td>
                                <td><?= $record['color'];?></td>
                                <td><?= $record['brand'];?></td>
                                <td><?= $record['model'];?></td>
                                <td><?php
                                if( $record['delivered']==1){
                                        echo "<a href='index.php?update_status=0&id=$record_id' class='badge badge-success'>Closed</a>";
                                }
                                else{
                                    echo "<a href='index.php?update_status=1&id=$record_id' class='badge badge-danger'>Active</a>";
                                }
                                ?></td>
                                <td><?= $record['amount'];?></td>
                                <td><a href="view.php?id=<?= $record_id;?>" class="btn btn-success btn-sm">View</a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>

<?php 
   if(isset($_POST['send'])){
        $type = $_POST['type'];

        if($type == 1){
            $typeValue = "Car";
            $price = 50;
        }
        elseif($type == 2){
            $typeValue = "MotorBike";
            $price = 10;
        }
        elseif($type==3){
            $typeValue = "Cycle";
            $price = 5;
        }


       
        $fields = array(
            'name' => $_POST['name'],
            'contact' => $_POST['contact'],
            'reg_no' => $_POST['reg_no'],
            'type' =>$type,
            'color' => $_POST['color'],
            'brand' => $_POST['brand'],
            'model' => $_POST['model'],
            'delivered' => $_POST['delivered'],
            'amount' => $price,
            'user_id' => $user['id']
        );

        send($_POST['contact'],"aapka Gadi No ".$_POST['reg_no'].", park kr diya gaya hai \n thanks ");
        insert('records',$fields);


        echo "<script>window.open('index.php','_self')</script>";

        
    }



    if(isset($_GET['update_status'])){
        $id = $_GET['update_status'];
        $record_id = $_GET['id'];

        if($id == 1 || $id == 0){
            update("records"," delivered = '$id'"," id='$record_id'");
            echo "<script>window.open('index.php','_self')</script>";
        }
    
    
    }
    ?>









<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>