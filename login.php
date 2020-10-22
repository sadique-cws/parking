<?php include "fun.php";?>
<html lang="en">
    <head>
        <title>parking management system</title>
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <body>

    <?php include "header.php";?>

        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-lg-3 mx-auto">
                    <div class="card">
                        <div class="card-body">
                        <h2 class="lead">Login Here</h2>

                            <form action="login.php" method="post">
                                <div class="form-group">
                                    <label for="">Contact</label>
                                    <input type="text" name="contact" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="login" class="btn btn-danger btn-block">
                                </div>
                            </form>
                            <?php

                                if(isset($_POST['login'])){
                                    $contact = $_POST['contact'];
                                    $password = md5($_POST['password']);

                                    if(check("admin","contact='$contact' AND password='$password'")){
                                        $_SESSION['user']= $contact;
                                        echo "<script>window.open('index.php','_self')</script>";
                                    }
                                    else{
                                        echo "<script>alert('contact and password is incorrect')</script>";
                                    }
                                }

                            ?>

                            <a href="signup.php" class="small">Create an account?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>