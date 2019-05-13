
<?php if($_SESSION["clearance"]!=3) { ?>
<!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">euro_symbol</i>
                        </div>
                        <div class="content">
                            <div class="text">Today's Sales</div>
                            
                            <div class="number"><?php echo number_format(dailySales()); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">shopping_cart</i>
                        </div>
                        <div class="content">
                            <div class="text">Items sold Today</div>
                            
                            <div class="number"><?php echo  number_format(dailyQty()); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">euro_symbol</i>
                        </div>
                        <div class="content">
                            <div class="text">This Month Sales</div>
                           
                            <div class="number"><?php echo number_format(monthlySales()); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">shopping_cart</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Items Registered</div>
                            
                            <div class="number"> <?php echo number_format(totalItems()); ?> </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- #END# Widgets -->
            
           <div class="row clearfix">
           	
           		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-red">
                            <h2>
                                Quick Links <small> </small>
                            </h2>
                            
                        </div>
                        <div class="body">
                             <div class="list-group" style="font-weight: 600">
                               <a href="../pages/add_item.php" class="list-group-item">Items  </a>
                               <a href="../pages/add_stock.php" class="list-group-item">Stock  </a>
                               <a href="../pages/add_customer.php" class="list-group-item">Customers  </a>
                               <a href="../pages/eod.php" class="list-group-item">End of Day  </a>
                               <a href="../pages/sales_report.php" class="list-group-item">Sales Report  </a>
                               <a href="../pages/sales.php" target="_blank" class="list-group-item">Make Sales  </a>
                            </div>
                             
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-red">
                            <h2>
                                System Guide <small> </small>
                            </h2>
                            
                        </div>
                        <div class="body">
                            Quis pharetra a pharetra fames blandit. Risus faucibus velit Risus imperdiet mattis neque volutpat, etiam lacinia netus dictum magnis per facilisi sociosqu. Volutpat. Ridiculus nostra.
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-red">
                            <h2>
                                FAQ <small> </small>
                            </h2>
                           
                        </div>
                        <div class="body">
                           
                           <div class="list-group" >
                               <a href="" style="text-decoration: none" class="list-group-item">Frequent Qustion  </a>
                               <a href="" style="text-decoration: none" class="list-group-item">Frequent Qustion  </a>
                               <a href="" style="text-decoration: none" class="list-group-item">Frequent Qustion  </a>
                               <a href="" style="text-decoration: none" class="list-group-item">Frequent Qustion  </a>
                               <a href="" style="text-decoration: none" class="list-group-item">Frequent Qustion  </a>
                              
                            </div>
                        </div>
                    </div>
                </div>
           </div>

<?php } else { header("Location: sales.php");}?>