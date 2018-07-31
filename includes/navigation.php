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
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
             <?php 
                    $query = "SELECT * FROM categories";
                    $select_all_categories_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_categories_query)){
                       $catTitle =  $row['cat_title'];
                        $catId = $row['cat_id'];
                        echo 
                        "<a class='dropdown-item' href='category.php?category={$catId}'>{$catTitle}</a>";
                    }
                    ?>
        </div>
      </li>
                    <li>
                    <a class="nav-link" href='capstone_page.php' class="">Capstone</a></button>
                    </li>
                    
                </ul>
                <ul class="navbar-nav icon-nav">
                    <a class="nav-link" href="https://www.linkedin.com/in/henry-owen-87257887/" target=" "><span class="fab fa-linkedin"></span></a>
                    <a class="nav-link" href="https://github.com/how1" target=" "><span class="fab fa-github-square"></span></a>
                </ul>
                <ul class="navbar-nav">
                    <?php
                    session_start();
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
                        echo "<li><a class='dropdown-item' href='registration.php'>Sign Up</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>