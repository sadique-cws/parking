<nav class="navbar navbar-expand-lg navbar-dark bg-theme">
            <a href="" class="navbar-brand">Parking</a>

            <?php if(isset($_SESSION['user'])):?>

            <form action="index.php" method="get" class="form-inline my-auto mx-auto" autocomplete="off">
                <input type="search" name="search" list="ritika" class="form-control" size="70" placeholder="Enter Vehicle No">
                
                <datalist id="ritika">
                    <?php 
                     $calling = calling("records"," delivered ASC");
                     foreach($calling as $record):
                    ?>
                    <option><?= $record['reg_no'];?></option>
                    <?php endforeach;?>

                </datalist>
                <input type="submit" name="find" class="btn btn-success">
            </form>
            <?php endif;?>


            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">About</a>
                </li>
                
                <?php if(isset($_SESSION['user'])): ?>
                <li class="nav-item">
                    <a href="logout.php" class="btn btn-theme">Logout</a>
                </li>
                <?php endif;?>
            </ul>
        </nav>