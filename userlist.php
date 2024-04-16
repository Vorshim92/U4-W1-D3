<?php include __DIR__ . '/includes/pdo.php'; ?>

<?php

$totalStmt = $pdo->query('SELECT COUNT(*) FROM userlist');
$totalResults = $totalStmt->fetchColumn();

$resultsPerPage = 3;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$offset = ($page - 1) * $resultsPerPage;

$stmt = $pdo->prepare('SELECT * FROM userlist LIMIT :limit OFFSET :offset');
$stmt->bindParam(':limit', $resultsPerPage, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <style>
        #btn-td{
            width: 25%;
        }
    </style>
</head>
<body>
<div class="container ">
    <h1>USER LIST </h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">NAME</th>
          <th scope="col">SURNAME</th>
          <th scope="col">AGE</th>
        </tr>
      </thead>
      
        
         <?php 
         $i = ($page - 1) * $resultsPerPage + 1; 
         foreach ($stmt as $row)
         {
            echo "<tr>";
            echo "<th scope='row'>$i</th>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['surname']}</td>";
            echo "<td>{$row['age']}</td>"; 
            echo "<td id='btn-td'>
            <a href='http://localhost/U4-W1-D3/delete.php?id={$row['id']}'><button class='btn btn-danger'>delete</button></a>
            <a href='http://localhost/U4-W1-D3/details.php?id={$row['id']}'><button class='btn btn-info'>details</button></a>
            <a href='http://localhost/U4-W1-D3/modify.php?id={$row['id']}'><button class='btn btn-warning'>modify</button></a>
            </td>";
           
            echo "</tr>";
            $i++;
        }
       
          
         ?>
        </table>  
       
       <?php
if ($totalResults > $resultsPerPage) {
    ?>
    <div class="d-flex justify-content-center">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= ceil($totalResults / $resultsPerPage); $i++) : ?>
                <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?php echo ($page >= ceil($totalResults / $resultsPerPage)) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
      </nav>
   </div>
<?php
}
?>











        
    <a href='http://localhost/U4-W1-D3/' class='btn btn-info'>Form/Home</a> 
</div class="container">
</body>
</html>
