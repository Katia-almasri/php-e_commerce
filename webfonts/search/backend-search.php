<?php

require_once "../../DBHolder/DBManager.php";

try{
    $pdo = pdo_connect_mysql();
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
 
// Attempt search query execution
try{
    if(isset($_REQUEST["term"])){
        // create prepared statement
        $sql = "SELECT * FROM procomp WHERE pro_name LIKE :term UNION ALL SELECT * FROM proclient WHERE pro_name LIKE :term;";
        $stmt = $pdo->prepare($sql);
        $term = '%'.$_REQUEST["term"] .'%';
        // bind parameters to statement
        $stmt->bindParam(":term", $term);
        // execute the prepared statement
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                echo "<p> <a href = product.php?id=".$row["pro_id"].">" . $row["pro_name"] . "</a> </p>";
            }
        } else{
            echo "<p>No matches found</p>";
        }
    }  
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
 
// Close statement
unset($stmt);
 
// Close connection
unset($pdo);
?>