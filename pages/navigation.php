<?php 

$home_link = $_SESSION["home_link"];
$accesslevel = $_SESSION["clearance"];
$pagename = explode('/', $_SERVER['SCRIPT_NAME']);
$page = end($pagename);

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
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome: 
                <?php echo $_SESSION["fullname"]."<br>Business ID: ".$_SESSION["business_id"];; ?></div>

                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>

                
<?php
switch ($accesslevel) {
    case 9:
        
    ?>    

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
            
            <li class='<?php if($page == 'index.php' || $page == 'business_profile.php' || $page == 'user_profile.php' || $page == 'change_password.php' || $page == 'settings.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>index.php'>
                    <i class='material-icons'>home</i>
                    <span>Home</span>
                </a>
            </li>
                
            <li class='<?php if($page == 'categories.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>categories.php'>
                    <i class='material-icons'>category</i>
                    <span>Categories</span>
                </a>
            </li>

            <li class='<?php if($page == 'add_item.php' || $page == 'update_item.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>add_item.php'>
                    <i class='material-icons'>shopping_cart</i>
                    <span>Items</span>
                </a>
            </li>

            <li class='<?php if ($page == 'add_stock.php' || $page == 'prepare_stock_order.php' || $page == 'add_suppliers.php' || $page == 'supplier_account.php'){echo 'active';} ?>'>
                <a href='javascript:void(0);' class='menu-toggle'>
                    <i class='material-icons'>business_center</i>
                    <span>Stock</span>
                </a>
                <ul class='ml-menu'>
					<!--
                    <li class='<?php //if ($page == 'add_stock.php') {echo 'active';} ?>'>
                        <a href='<?php //echo $home_link; ?>add_stock.php'>
                            <span>Add Stock</span>
                        </a>
                    </li>
					-->
                    <li class='<?php if ($page == 'prepare_stock_order.php') {echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>prepare_stock_order.php'>
                            <span>Prepare Stock Order</span>
                        </a>
                    </li>
                    <li class='<?php if ($page == 'add_suppliers.php') {echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>add_suppliers.php'>
                            <span>Add Supplier</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class='<?php if($page == 'sales.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>sales.php' target="_blank">
                    <i class='material-icons'>payment</i>
                    <span>Make Sales</span>
                </a>
            </li>

            <li class='<?php if ($page == 'borrow.php'){echo 'active';} ?>'>
                <a href='javascript:void(0);' class='menu-toggle'>
                    <i class='material-icons'>fast_forward</i>
                    <span>Borrowing</span>
                </a>
                <ul class='ml-menu'>
                    <li class='<?php if ($page == 'borrow.php') {echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>borrow.php'>
                            <span>Borrow</span>
                        </a>
                    </li>
                    
                    <li class='<?php if ($page == 'borrow_list.php') {echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>borrow_list.php'>
                            <span>Debt </span>
                        </a>
                    </li>
                    
                    <li  class='<?php if ($page == 'borrow_info.php') {echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>borrow_info.php'>
                            <span>Debt Info </span>
                        </a>
                    </li>
                    
                </ul>
            </li>

            <li class='<?php if ($page == 'return.php' || $page == 'return_approval.php'){echo 'active';} ?>'>
                <a href='javascript:void(0);' class='menu-toggle'>
                    <i class='material-icons'>open_in_browser</i>
                    <span>Returning</span>
                </a>
                <ul class='ml-menu'>
                    <li class='<?php if ($page == 'return.php') {echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>return.php'>
                            <span>Return</span>
                        </a>
                    </li>
                    <li class='<?php if ($page == 'return_approval.php') {echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>return_approval.php'>
                            <span>Return Approval</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class='<?php if($page == 'add_customer.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>add_customer.php'>
                    <i class='material-icons'>person_add</i>
                    <span>Customers</span>
                </a>
            </li>

            <li class='<?php if ($page == 'eod.php' || $page == 'sales_report.php' || $page == 'product_report_details.php' || $page == 'debt.php'){echo 'active';} ?>'>
                <a href='javascript:void(0);' class='menu-toggle'>
                    <i class='material-icons'>assignment</i>
                    <span>Finance</span>
                </a>
                <ul class='ml-menu'>
                    <li class='<?php if($page == 'eod.php'){echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>eod.php'>
                            <span>End of Day</span>
                        </a>
                    </li>
                    <li class='<?php if($page == 'sales_report.php'){echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>sales_report.php'>
                            <span>Sales Report</span>
                        </a>
                    </li>
                    <li class='<?php if($page == 'debt.php'){echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>debt.php'>
                            <span>Debt</span>
                        </a>
                    </li>
                    <li class='<?php if($page == 'product_report_details.php'){echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>product_report_details.php'>
                            <span>Product Reports</span>
                        </a>
                    </li>
                    <li class='<?php if($page == 'supply_report_details.php'){echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>supply_report_details.php'>
                            <span>Supply Reports</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class='<?php if($page == 'add_user.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>add_user.php'>
                    <i class='material-icons'>forum</i>
                    <span>Users</span>
                </a>
            </li>

            <li class='<?php if($page == 'subscription.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>subscription.php'>
                    <i class='material-icons'>forum</i>
                    <span>Subscription</span>
                </a>
            </li>

            <li class='<?php if($page == 'subscription_approval.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>subscription_approval.php'>
                    <i class='material-icons'>forum</i>
                    <span>Subscription Approval</span>
                </a>
            </li>

    <?php  
    break;

    case 7:
    ?>    

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
            
            <li class='<?php if($page == 'index.php' || $page == 'business_profile.php' || $page == 'user_profile.php' || $page == 'change_password.php' || $page == 'settings.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>index.php'>
                    <i class='material-icons'>home</i>
                    <span>Home</span>
                </a>
            </li>
                
            <li class='<?php if($page == 'categories.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>categories.php'>
                    <i class='material-icons'>category</i>
                    <span>Categories</span>
                </a>
            </li>

            <li class='<?php if($page == 'add_item.php' || $page == 'update_item.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>add_item.php'>
                    <i class='material-icons'>shopping_cart</i>
                    <span>Items</span>
                </a>
            </li>

            <li class='<?php if ($page == 'add_stock.php' || $page == 'prepare_stock_order.php' || $page == 'add_suppliers.php'){echo 'active';} ?>'>
                <a href='javascript:void(0);' class='menu-toggle'>
                    <i class='material-icons'>business_center</i>
                    <span>Stock</span>
                </a>
                <ul class='ml-menu'>
                    <li class='<?php if ($page == 'add_stock.php') {echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>add_stock.php'>
                            <span>Add Stock</span>
                        </a>
                    </li>
                    <li class='<?php if ($page == 'prepare_stock_order.php') {echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>prepare_stock_order.php'>
                            <span>Prepare Stock Order</span>
                        </a>
                    </li>
                    <li class='<?php if ($page == 'add_suppliers.php') {echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>add_suppliers.php'>
                            <span>Add Supplier</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class='<?php if($page == 'sales.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>sales.php' target="_blank">
                    <i class='material-icons'>payment</i>
                    <span>Make Sales</span>
                </a>
            </li>

            <li class='<?php if ($page == 'borrow.php'){echo 'active';} ?>'>
                <a href='javascript:void(0);' class='menu-toggle'>
                    <i class='material-icons'>fast_forward</i>
                    <span>Borrowing</span>
                </a>
                <ul class='ml-menu'>
                    <li class='<?php if ($page == 'borrow.php') {echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>borrow.php'>
                            <span>Borrow</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class='<?php if ($page == 'return.php' || $page == 'return_approval.php'){echo 'active';} ?>'>
                <a href='javascript:void(0);' class='menu-toggle'>
                    <i class='material-icons'>open_in_browser</i>
                    <span>Returning</span>
                </a>
                <ul class='ml-menu'>
                    <li class='<?php if ($page == 'return.php') {echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>return.php'>
                            <span>Return</span>
                        </a>
                    </li>
                    <li class='<?php if ($page == 'return_approval.php') {echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>return_approval.php'>
                            <span>Return Approval</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class='<?php if($page == 'add_customer.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>add_customer.php'>
                    <i class='material-icons'>person_add</i>
                    <span>Customers</span>
                </a>
            </li>

            <li class='<?php if ($page == 'eod.php' || $page == 'sales_report.php' || $page == 'product_report_details.php' || $page == 'debt.php'){echo 'active';} ?>'>
                <a href='javascript:void(0);' class='menu-toggle'>
                    <i class='material-icons'>assignment</i>
                    <span>Finance</span>
                </a>
                <ul class='ml-menu'>
                    <li class='<?php if($page == 'eod.php'){echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>eod.php'>
                            <span>End of Day</span>
                        </a>
                    </li>
                    <li class='<?php if($page == 'sales_report.php'){echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>sales_report.php'>
                            <span>Sales Report</span>
                        </a>
                    </li>
                    <li class='<?php if($page == 'debt.php'){echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>debt.php'>
                            <span>Debt</span>
                        </a>
                    </li>
                    <li class='<?php if($page == 'product_report_details.php'){echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>product_report_details.php'>
                            <span>Product Reports</span>
                        </a>
                    </li>
                    <li class='<?php if($page == 'supply_report_details.php'){echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>supply_report_details.php'>
                            <span>Supply Reports</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class='<?php if($page == 'add_user.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>add_user.php'>
                    <i class='material-icons'>forum</i>
                    <span>Users</span>
                </a>
            </li>

    <?php
    break;

    case 6:
    ?>    

    <ul class="dropdown-menu pull-right">
        
       
        <li><a href="<?php echo $home_link; ?>user_profile.php"><i class="material-icons">person</i>User Profile</a></li>
        <li><a href="<?php echo $home_link; ?>change_password.php"><i class="material-icons">vpn_key</i>Change Password</a></li>
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
            
            <li class='<?php if($page == 'index.php' || $page == 'business_profile.php' || $page == 'user_profile.php' || $page == 'change_password.php' || $page == 'settings.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>index.php'>
                    <i class='material-icons'>home</i>
                    <span>Home</span>
                </a>
            </li>
                
            <li class='<?php if($page == 'categories.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>categories.php'>
                    <i class='material-icons'>category</i>
                    <span>Categories</span>
                </a>
            </li>

            <li class='<?php if($page == 'add_item.php' || $page == 'update_item.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>add_item.php'>
                    <i class='material-icons'>shopping_cart</i>
                    <span>Items</span>
                </a>
            </li>

            <li class='<?php if ($page == 'add_stock.php' || $page == 'prepare_stock_order.php' || $page == 'add_suppliers.php'){echo 'active';} ?>'>
                <a href='javascript:void(0);' class='menu-toggle'>
                    <i class='material-icons'>business_center</i>
                    <span>Stock</span>
                </a>
                <ul class='ml-menu'>
                    <li class='<?php if ($page == 'add_stock.php') {echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>add_stock.php'>
                            <span>Add Stock</span>
                        </a>
                    </li>
                    <li class='<?php if ($page == 'prepare_stock_order.php') {echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>prepare_stock_order.php'>
                            <span>Prepare Stock Order</span>
                        </a>
                    </li>
                    <li class='<?php if ($page == 'add_suppliers.php') {echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>add_suppliers.php'>
                            <span>Add Supplier</span>
                        </a>
                    </li>
                </ul>
            </li>
           
    <?php
    break;

    case 5:
    ?>    

    <ul class="dropdown-menu pull-right">
        
        
        <li><a href="<?php echo $home_link; ?>user_profile.php"><i class="material-icons">person</i>User Profile</a></li>
        <li><a href="<?php echo $home_link; ?>change_password.php"><i class="material-icons">vpn_key</i>Change Password</a></li>
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
            
            <li class='<?php if($page == 'index.php' || $page == 'business_profile.php' || $page == 'user_profile.php' || $page == 'change_password.php' || $page == 'settings.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>index.php'>
                    <i class='material-icons'>home</i>
                    <span>Home</span>
                </a>
            </li>
            

            <li class='<?php if($page == 'add_customer.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>add_customer.php'>
                    <i class='material-icons'>person_add</i>
                    <span>Customers</span>
                </a>
            </li>

            <li class='<?php if ($page == 'eod.php' || $page == 'sales_report.php' || $page == 'product_report_details.php' || $page == 'debt.php'){echo 'active';} ?>'>
                <a href='javascript:void(0);' class='menu-toggle'>
                    <i class='material-icons'>assignment</i>
                    <span>Finance</span>
                </a>
                <ul class='ml-menu'>
                    <li class='<?php if($page == 'eod.php'){echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>eod.php'>
                            <span>End of Day</span>
                        </a>
                    </li>
                    <li class='<?php if($page == 'sales_report.php'){echo 'active';} ?>'>
                        <a href='<?php echo $home_link; ?>sales_report.php'>
                            <span>Sales Report</span>
                        </a>
                    </li>
                   
                   
                </ul>
            </li>


    <?php
    break;

    case 4:
    ?>    

    <ul class="dropdown-menu pull-right">
        
        <li><a href="<?php echo $home_link; ?>user_profile.php"><i class="material-icons">person</i>User Profile</a></li>
        <li><a href="<?php echo $home_link; ?>change_password.php"><i class="material-icons">vpn_key</i>Change Password</a></li>
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

            <li class='<?php if($page == 'index.php' || $page == 'user_profile.php' || $page == 'change_password.php' ){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>index.php'>
                    <i class='material-icons'>home</i>
                    <span>Home</span>
                </a>
            </li>

            <li class='<?php if($page == 'add_item.php' || $page == 'update_item.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>add_item.php'>
                    <i class='material-icons'>shopping_cart</i>
                    <span>Items</span>
                </a>
            </li>

            
    <?php  
    break;

    case 3:
    ?>    

    <ul class="dropdown-menu pull-right">
        
        <li><a href="<?php echo $home_link; ?>user_profile.php"><i class="material-icons">person</i>User Profile</a></li>
        <li><a href="<?php echo $home_link; ?>change_password.php"><i class="material-icons">vpn_key</i>Change Password</a></li>
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
            
            <li class='<?php if($page == 'index.php' || $page == 'user_profile.php' || $page == 'change_password.php' ){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>index.php'>
                    <i class='material-icons'>home</i>
                    <span>Home</span>
                </a>
            </li>

            <li class='<?php if($page == 'sales.php'){echo 'active';} ?>'>
                <a href='<?php echo $home_link; ?>sales.php'>
                    <i class='material-icons'>payment</i>
                    <span>Make Sales</span>
                </a>
            </li>

    <?php  
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



                    
                    
                   
                    
                
