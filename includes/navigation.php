        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                   
                   <?php 
                    $query = "SELECT * FROM categories";
                    $select_all_categories_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_categories_query)){
                       $catTitle =  $row['cat_title'];
                        $catId = $row['cat_id'];
                        echo "<li><a href='category.php?category=$catId'>{$catTitle}</a></li>";
                    }
                    session_start();
                    if (isset($_SESSION['username'])){
                        $username = $_SESSION['username'];
                       
                        if ($_SESSION['user_role'] == 'admin'){
                            echo "<li><a href='admin'>Admin</a></li>";
                        }
                        echo "<li class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-user'></i> $username <b class='caret'></b></a>
                    <ul class='dropdown-menu'>
                        <li>
                            <a href='profile.php'><i class='fa fa-fw fa-user'></i> Profile</a>
                        </li>
                        
                        <li>
                            <a href='includes/logout.php'><i class='fa fa-fw fa-power-off'></i> Log Out</a>
                        </li>
                    </ul>
                </li>";
                    
                    } else { 
                        echo "<li><a       href='registration.php'>Sign Up</a></li>";
                    }
                    ?>
                    
                   
                   
                
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>