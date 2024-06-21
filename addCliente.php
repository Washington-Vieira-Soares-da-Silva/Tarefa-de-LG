<?php
	include('conn.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$nomeCliente = $_POST['nomeCliente'];
		$telefoneCliente = $_POST['telefoneCliente'];
		$EmailCliente = $_POST['EmailCliente'];

		$stmt = $pdo->prepare('INSERT INTO tbCliente (nomeCliente, telefoneCliente, EmailCliente) VALUES (?, ?, ?)');
		$stmt->execute([$nomeCliente, $telefoneCliente, $EmailCliente]);

		header('location: addCliente.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Adicionar Cliente</title>
</head>
<body>
	<h2>Adicionar Cliente</h2>
	<form method="POST">
		
		<label>Nome do Cliente:</label>
		<input type="text" name="nomeCliente" required><br>

		<label>Telefone do Cliente:</label>
		<input type="text" name="telefoneCliente" required><br>

		<label>Email do Cliente:</label>
		<input type="text" name="EmailCliente" required><br>

		<input type="submit" value="Adicionar">
	</form>
	<br>
	<a href="index.php">Voltar</a>
</body>
</html>