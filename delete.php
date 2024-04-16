<?php include __DIR__ . '/includes/pdo.php'; ?>

<?php



$id=$_GET['id'];
       
        $stmt= $pdo->prepare("DELETE FROM userlist WHERE id=?");
        $stmt->execute([$id]);
          
header('Location:userlist.php')
?>