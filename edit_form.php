<?php include __DIR__ . '/includes/pdo.php'; ?>

<?php
$name = $_POST['name'];
$surname = $_POST['surname'];
$age = $_POST['age'];


$id= $_GET["id"];


$stmt = $pdo->prepare("UPDATE userlist  SET name = :name,   surname = :surname,  age= :age  WHERE id = :id");
$stmt->execute([
    'id' => $id,
    'name' => $name,
    'surname'=> $surname,
    'age' => $age,
]);
header('Location: userlist.php');