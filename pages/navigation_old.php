<?php 

//$home_link = $_SESSION["home_link"];
$accesslevel = 9;
$page = end(explode('/', $_SERVER['SCRIPT_NAME']));

?>

    <section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="../images/logos/<?php echo $logo; ?>" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome: <?php echo $_SESSION["fullname"]; ?></div>

                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>

                <ul class="dropdown-menu pull-right">
                    <li><a href="<?php echo $home_link; ?>business_profile.php"><i class="material-icons">person</i>Business Profile</a></li>
                    <li role="seperator" class="divider"></li>
                    <li><a href="<?php echo $home_link; ?>user_profile.php"><i class="material-icons">person</i>User Profile</a></li>
                    <li><a href="<?php echo $home_link; ?>change_password.php"><i class="material-icons">vpn_key</i>Change Password</a></li>
                    <li role="seperator" class="divider"></li>
                    <li><a href="<?php echo $home_link; ?>/ settings.php"><i class="material-icons">settings_applications</i>Settings</a></li>
                    <li role="seperator" class="divider"></li>
                    <li><a href="<?php echo $home_link; ?>logout.php"><i class="material-icons">input</i>Sign Out</a></li>
                </ul>

                </div>
            </div>
        </div>
        <!-- #User Info -->
<!-- Menu -->
<div class="menu">
    <ul class="list">
        <li class="header">MAIN NAVIGATION</li>

<?php
switch ($accesslevel) {
    case 9:
        
        if ($page == 'index.php') {
            echo "
                <li class='active'>
                    <a href='{$home_link}index.php'>
                        <i class='material-icons'>home</i>
                        <span>Home</span>
                    </a>
                </li>
            ";
        }else {
            echo "
                <li>
                    <a href='{$home_link}index.php'>
                        <i class='material-icons'>home</i>
                        <span>Home</span>
                    </a>
                </li>
            ";
        }

        if ($page == 'categories.php') {
            echo "
                <li class='active'>
                    <a href='{$home_link}categories.php'>
                        <i class='material-icons'>forum</i>
                        <span>Categories</span>
                    </a>
                </li>
            ";
        }else {
            echo "
                <li>
                    <a href='{$home_link}categories.php'>
                        <i class='material-icons'>forum</i>
                        <span>Categories</span>
                    </a>
                </li>
            ";
        }        
            
        if ($page == 'add_item.php') {
            echo "
                <li class='active'>
                    <a href='{$home_link}add_item.php'>
                        <i class='material-icons'>forum</i>
                        <span>Items</span>
                    </a>
                </li>
            ";
        }else {
            echo "
                <li>
                    <a href='{$home_link}add_item.php'>
                        <i class='material-icons'>forum</i>
                        <span>Items</span>
                    </a>
                </li>
            ";
        } 
           
        if ($page == 'add_stock.php' || $page == 'prepare_stock_order.php' || $page == 'add_suppliers.php') {
            echo "
                <li class='active'>
                    <a href='javascript:void(0);' class='menu-toggle'>
                        <i class='material-icons'>assignment</i>
                        <span>Stock</span>
                    </a>
                    <ul class='ml-menu'>
            ";

            if ($page == 'add_stock.php') {
                echo "
                    <li class='active'>
                        <a href='{$home_link}add_stock.php'>
                            <span>Add Stock</span>
                        </a>
                    </li>
                ";
            }else{
                echo "
                    <li>
                        <a href='{$home_link}add_stock.php'>
                            <span>Add Stock</span>
                        </a>
                    </li>
                ";
            }

            if ($page == 'prepare_stock_order.php') {
                echo "
                    <li class='active'>
                        <a href='{$home_link}prepare_stock_order.php'>
                            <span>Prepare Stock Order</span>
                        </a>
                    </li>
                ";
            }else{
                echo "
                    <li>
                        <a href='{$home_link}prepare_stock_order.php'>
                            <span>Prepare Stock Order</span>
                        </a>
                    </li>
                ";
            }

            if ($page == 'add_suppliers.php') {
                echo "
                    <li class='active'>
                        <a href='{$home_link}add_suppliers.php'>
                            <span>Add Supplier</span>
                        </a>
                    </li>
                ";
            }else{
                echo "
                    <li>
                        <a href='{$home_link}add_suppliers.php'>
                            <span>Add Supplier</span>
                        </a>
                    </li>
                ";
            }

            echo "
                </ul>
            </li>
            ";

        }else {
            echo "
                <li>
                    <a href='javascript:void(0);' class='menu-toggle'>
                        <i class='material-icons'>assignment</i>
                        <span>Stock</span>
                    </a>
                    <ul class='ml-menu'>
                        <li>
                            <a href='{$home_link}add_stock.php'>
                                <span>Add Stock</span>
                            </a>
                        </li>
                        <li>
                            <a href='{$home_link}prepare_stock_order.php'>
                                <span>Prepare Stock Order</span>
                            </a>
                        </li>
                        <li>
                            <a href='{$home_link}add_suppliers.php'>
                                <span>Add Supplier</span>
                            </a>
                        </li>
                    </ul>
                </li>
            ";
        }
            
        if ($page == 'sales.php') {
            echo "
                <li class='active'>
                    <a href='{$home_link}sales.php'>
                        <i class='material-icons'>forum</i>
                        <span>Make Sales</span>
                    </a>
                </li>
            ";
        }else {
            echo "
                <li>
                    <a href='{$home_link}sales.php'>
                        <i class='material-icons'>forum</i>
                        <span>Make Sales</span>
                    </a>
                </li>
            ";
        } 
        
        if ($page == 'add_customer.php') {
            echo "
                <li class='active'>
                    <a href='{$home_link}add_customer.php'>
                        <i class='material-icons'>person_add</i>
                        <span>Manage Customers</span>
                    </a>
                </li>
            ";
        }else {
            echo "
                <li>
                    <a href='{$home_link}add_customer.php'>
                        <i class='material-icons'>person_add</i>
                        <span>Manage Customers</span>
                    </a>
                </li>
            ";
        } 
                
        if ($page == 'eod.php' || $page == 'sales_report.php' || $page == 'product_report_details.php') {
            echo "
                <li class='active'>
                    <a href='javascript:void(0);' class='menu-toggle'>
                        <i class='material-icons'>assignment</i>
                        <span>Finance</span>
                    </a>
                    <ul class='ml-menu'>
            ";

            if ($page == 'eod.php') {
                echo "
                    <li class='active'>
                        <a href='{$home_link}eod.php'>
                            <span>End of Day</span>
                        </a>
                    </li>
                ";
            }else {
                echo "
                    <li>
                        <a href='{$home_link}eod.php'>
                            <span>End of Day</span>
                        </a>
                    </li>
                ";
            }

            if ($page == 'sales_report.php') {
                echo "
                    <li class='active'>
                        <a href='{$home_link}sales_report.php'>
                            <span>Sales Report</span>
                        </a>
                    </li>
                ";
            }else {
                echo "
                    <li>
                        <a href='{$home_link}sales_report.php'>
                            <span>Sales Report</span>
                        </a>
                    </li>
                ";
            }

            if ($page == 'debts.php') {
                echo "
                    <li class='active'>
                        <a href='{$home_link}debts.php'>
                            <span>Debts</span>
                        </a>
                    </li>
                ";
            }else {
                echo "
                    <li>
                        <a href='{$home_link}debts.php'>
                            <span>Debts</span>
                        </a>
                    </li>
                ";
            }

            if ($page == 'product_report_details.php') {
                echo "
                    <li class='active'>
                        <a href='{$home_link}product_report_details.php'>
                            <span>Product Reports</span>
                        </a>
                    </li>
                ";
            }else {
                echo "
                    <li>
                        <a href='{$home_link}product_report_details.php'>
                            <span>Product Reports</span>
                        </a>
                    </li>
                ";
            }

            if ($page == 'supply_report_details.php') {
                echo "
                    <li class='active'>
                        <a href='{$home_link}supply_report_details.php'>
                            <span>Supply Reports</span>
                        </a>
                    </li>
                ";
            }else {
                echo "
                    <li>
                        <a href='{$home_link}supply_report_details.php'>
                            <span>Supply Reports</span>
                        </a>
                    </li>
                ";
            }
        
            echo "
                </ul>

                </li>
            ";

        }else {
            echo "
                <li>
                    <a href='javascript:void(0);' class='menu-toggle'>
                        <i class='material-icons'>assignment</i>
                        <span>Finance</span>
                    </a>
                    <ul class='ml-menu'>
                        <li>
                            <a href='{$home_link}eod.php'>
                                <span>End of Day</span>
                            </a>
                        </li>
                        <li>
                            <a href='{$home_link}sales_report.php'>
                                <span>Sales Report</span>
                            </a>
                        </li>
                        <li>
                            <a href='{$home_link}debts.php'>
                                <span>Debts</span>
                            </a>
                        </li>
                        <li>
                            <a href='{$home_link}product_report_details.php'>
                                <span>Product Reports</span>
                            </a>
                        </li>
                        <li>
                            <a href='{$home_link}supply_report_details.php'>
                                <span>Supply Reports</span>
                            </a>
                        </li>
                    </ul>
                </li>
            ";
        }  
            
        if ($page == 'add_user.php') {
            echo "
                <li class='active'>
                    <a href='{$home_link}add_user.php'>
                        <i class='material-icons'>forum</i>
                        <span>Users</span>
                    </a>
                </li>
            ";
        }else {
            echo "
                <li>
                    <a href='{$home_link}add_user.php'>
                        <i class='material-icons'>forum</i>
                        <span>Users</span>
                    </a>
                </li>
            ";
        }  

        break;
    
}


?>

</ul>
</div>
<!-- #Menu -->

<!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; <?php echo date("Y"); ?> <a href="javascript:void(0);">K9IS - All Rights Reserved</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.1
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
       
    </section>



                    
                    
                   
                    
                
