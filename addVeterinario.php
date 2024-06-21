<?php
	include('conn.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$nomeVet = $_POST['nomeVet'];

		$stmt = $pdo->prepare('INSERT INTO tbVeterinario (nomeVet) VALUES (?)');
		$stmt->execute([$nomeVet]);

		header('location: addVeterinario.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Adicionar Veterinario</title>
</head>
<body>
	<h2>Adicionar Veterinario</h2>
	<form method="POST">
		
		<label>Nome do Veterinario:</label>
		<input type="text" name="nomeVet" required><br>

		<input type="submit" value="Adicionar">
	</form>
	<br>
	<a href="index.php">Voltar</a>
</body>
</html>