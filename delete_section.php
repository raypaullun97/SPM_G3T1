<?php 
    spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );
    
    $id = $_GET['section_id'];

    $conn_manager = new ConnectionManager();
    $pdo = $conn_manager->getConnection();
    
    $sql = 'delete from section where section_id = :section_id';
    $stmt1 = $pdo->prepare($sql);
    $stmt1->bindParam(":section_id",$id);
    
    $delStatus = $stmt1->execute();
    $stmt1 = null;
    $pdo = null;
    
    if ($delStatus)
    {
        header('location:sections.php');
    }

?>
