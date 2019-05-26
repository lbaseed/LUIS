<?php
//Study roll back and apply
ob_start(); 
include("../inc/config.php"); 
include("../inc/php_functions.php"); 


try {
    $conn->beginTransaction();

    $stmt = $conn->prepare("INSERT INTO users (name) VALUES (?)");
    $query = $stmt->execute(["iklil"]);

    $stmt = $conn->prepare("UPDATE 111_items SET barcode = :barcode WHERE item_id = :item_id ");
    
    $stmt->execute(['barcode' => 1 , 'item_id' => 1]);

    if ($query) {
        echo "good";
    }else {
        
       throw new Exception();
        
    }
    
    $conn->commit();
}catch (Exception $e){
    $conn->rollback();
    echo "e->getMessage()";
}

?>