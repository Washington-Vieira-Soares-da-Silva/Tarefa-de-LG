<?php
	include('conn.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$tipoAnimal = $_POST['tipoAnimal'];

		$stmt = $pdo->prepare('INSERT INTO tbTipoAnimal (tipoAnimal) VALUES (?)');
		$stmt->execute([$tipoAnimal]);

		header('location: addTipoAnimal.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Adicionar Tipo de Animal</title>
</head>
<body>
	<h2>Adicionar Tipo de Animal</h2>
	<form method="POST">
		
		<label>Tipo de Animal:</label>
		<input type="text" name="tipoAnimal" required><br>

		<input type="submit" value="Adicionar">
	</form>
	<br>
	<a href="index.php">Voltar</a>
</body>
</html>