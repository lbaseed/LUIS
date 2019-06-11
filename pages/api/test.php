<?php

require("../../inc/config.php");

$tid = 1; 
$total = 2000;
$dt = "";
$mop = "";
$am_tendered = 2000;
$change = 0;
$bal = 1200;
$cust_id = 10001;


$stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_trans (`tid`, `total_sales`, `date`, `mop`, `amount_tendered`, `change`, `balance`, `cid`, `cashier`, `timeStamp`, `status`) VALUES (:tid, :total_sales, :date, :mop, :amount_tendered, :change, :balance, :cid, :cashier, NOW(), :status) ");
$insert_trans = $stmt->execute(['tid' => $tid, 'total_sales' => $total, 'date' => $dt, 'mop' => $mop, 'amount_tendered' => $am_tendered, 'change' => $change, 'balance' => $bal, 'cid' => $cust_id, 'cashier' => $_SESSION["cur_user"], 'status' => "" ]);

?>