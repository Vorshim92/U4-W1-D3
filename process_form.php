<?php include __DIR__ . '/includes/pdo.php'; ?>

<?php 
$name = $_POST['name'];
$surname = $_POST['surname'];
$age = $_POST['age'];

$stmt = $pdo->prepare("INSERT INTO userlist (name, surname, age) VALUES (:name, :surname, :age)");
$stmt->execute([
    'name' => $name,
    'surname' => $surname,
    'age' => $age,
]);

header('Location:userlist.php')
?>

