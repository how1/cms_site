        <nav class="navbar navbar-dark navbar-expand-md fixed-top bg-dark" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div>
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand" href="index.php">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
            </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Posts
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
             <?php 
                    // $query = "SELECT * FROM categories";
                    // $select_all_categories_query = mysqli_query($connection, $query);
                    
                    // while($row = mysqli_fetch_assoc($select_all_categories_query)){
                    //    $catTitle =  $row['cat_title'];
                    //     $catId = $row['cat_id'];
                    //     echo 
                    //     "<a class='dropdown-item' href='category.php?category={$catId}'>{$catTitle}</a>";
                    // }
            ?>

            <?php 
                $query = "SELECT * FROM categories ";
                $select_categories_sidebar = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc(
                $select_categories_sidebar)){
                $quantity_query = "SELECT * FROM posts WHERE post_category_id={$row['cat_id']} AND post_status = 'published' ";
                $send = mysqli_query($connection, $quantity_query);
                $numPosts = mysqli_num_rows($send);
                $catTitle =  $row['cat_title'];
                $catId = $row['cat_id'];
                echo "<a class='dropdown-item list-group-item-action' href='category.php?category=$catId'>{$catTitle}<span style='float: right' class='badge badge-primary badge-pill'>{$numPosts}</span></a>";
                }    
            ?>
            </div>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Web Apps
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">   
            <a class='dropdown-item' href='http://threejswebsim.henrywowen.com'>Particle Physics Simulator</a>
            <a class='dropdown-item' href='http://chopperassault.henrywowen.com'>Chopper Assault</a>
            <a class='dropdown-item' href='http://spherejauntersxs.henrywowen.com'>Sphere Jaunters XS</a>

        </div>
      </li>
                    
                </ul>
                <ul class="navbar-nav">
                        <ul class="navbar-nav icon-nav">
                        <a class="nav-link" href="https://www.linkedin.com/in/henry-owen-87257887/" target=" "><span class="fab fa-linkedin"></span></a>
                        <a class="nav-link" href="https://github.com/how1" target=" "><span class="fab fa-github-square"></span></a>
                        </ul>
                </ul>
                <ul class="navbar-nav">
                    <?php

                    if (isset($_SESSION['username'])){
                    $username = $_SESSION['username'];

                    if ($_SESSION['user_role'] == 'admin'){
                        echo "<li><a class='nav-link' href='admin'>Admin</a></li>";
                    }
                    echo "<li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' href='#'' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-user'></i> {$username} </a>
                    <ul class='dropdown-menu'>
                    <li>
                        <a class='dropdown-item' href='profile.php'><i class='fa fa-fw fa-user'></i> Profile</a>
                    </li>

                    <li>
                        <a class='dropdown-item' href='includes/logout.php'><i class='fa fa-fw fa-power-off'></i> Log Out</a>
                    </li>
                    </ul>
                    </li>";

                    } else { 
                    //  echo "<li><a class='nav-link' href='registration.php'>Sign Up</a></li>";
                    }
                    ?>
                </ul>
                
                <ul class="navbar-nav">
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input name="search" placeholder="Search" type="text" class="form-control mr-sm-2">
                        <span class="input-group-btn">
                            <button name='submit' class="btn btn-default" type="submit">
                                <span class="fas fa-search" style="color: white"></span>
                        </button>
                        
                        </span>
                    </div>
                    </form> 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>