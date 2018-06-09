<?php include "includes/admin_header.php";?>
<?php include "functions.php";?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
       <?php include "includes/admin_navigation.php";?>

        <?php
                        
                        if (isset($_GET['source'])){
                            
                            $source = $_GET['source'];
                            
                            
                        } else {
                            $source = '';
                        }
                        switch($source){
                                
                            case 'add_user':
                                include "includes/add_user.php";
                                break;
                                
                            case 'edit_user':
                                include "includes/edit_user.php";
                                break;
                                
                            case '2':
                                echo 'Nice';
                                break;
                                
                            case '3':
                                echo 'Nice';
                                break;
                                
                            case '4':
                                echo 'Nice';
                                break;
                            
                            default:
                                include "includes/view_all_users.php";
                                break;
                                
                        }
                        
                        
                        
                        ?>
                        
                       
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
       
        
        <?php include "includes/admin_footer.php";?>