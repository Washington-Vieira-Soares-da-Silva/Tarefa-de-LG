<?php
	include('conn.php');

	$sql = "
	    SELECT
	        c.codCliente,
	        c.nomeCliente,
	        c.telefoneCliente,
	        c.EmailCliente,
	        a.nomeAnimal,
	        a.fotoAnimal,
	        t.tipoAnimal
	    FROM
	        tbCliente c
	    INNER JOIN
	        tbAnimal a ON c.codCliente = a.codCliente
	    INNER JOIN
	        tbTipoAnimal t ON a.codTipoAnimal = t.codTipoAnimal;
	";
	$result = $pdo->query($sql)->fetchAll();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$nomeAnimal = $_POST['nomeAnimal'];
		$fotoAnimal = $_POST['fotoAnimal'];
		$codTipoAnimal = $_POST['codTipoAnimal'];
		$codCliente = $_POST['codCliente'];

		$stmt = $pdo->prepare('INSERT INTO tbAnimal (nomeAnimal, fotoAnimal, codTipoAnimal, codCliente) VALUES (?, ?, ?, ?)');
		$stmt->execute([$nomeAnimal, $fotoAnimal, $codTipoAnimal, $codCliente]);

		header('location: addAnimal.php');
		exit();
	}

	$TiposDeAnimais = $pdo->query('SELECT codTipoAnimal, tipoAnimal FROM tbTipoAnimal')->fetchAll();
	$Clientes = $pdo->query('SELECT codCliente, nomeCliente FROM tbCliente')->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Adicionar Animal</title>
</head>
<body>
	<h2>Adicionar Animal</h2>
	<form method="POST">
		
		<label for="nomeAnimal">Nome do Animal:</label>
		<input type="text" name="nomeAnimal" required><br>

		<label for="fotoAnimal">Foto do Animal:</label>
		<input type="text" name="fotoAnimal" required><br>

		<label for="codTipoAnimal">Tipo De Animal:</label>

		<select name="codTipoAnimal" required>
			<?php foreach ($TiposDeAnimais as $TiposDeAnimal): ?>
				<option value="<?= $TiposDeAnimal['codTipoAnimal'] ?>"><?= $TiposDeAnimal['tipoAnimal'] ?></option>
			<?php endforeach; ?>
		</select><br>

		<label for="codCliente">Cliente:</label>

		<select name="codCliente" required>
			<?php foreach ($Clientes as $Cliente): ?>
				<option value="<?= $Cliente['codCliente'] ?>"><?= $Cliente['nomeCliente'] ?></option>
			<?php endforeach; ?>
		</select><br>
		<br>
		<input type="submit" value="Adicionar">

	</form>

	<table>		
		<tr>
			<th>Codigo do Cliente:</th>
			<th>Cliente:</th>
			<th>Telefone:</th>
			<th>Email:</th>	
			<th>Nome do Animal:</th>
			<th>Foto do Animal:</th>
			<th>Tipo de Animal:</th>
		</tr>
		<?php foreach ($result as $row): ?>
        <tr>
        	<td><?= $row['codCliente'] ?></td>
            <td><?= $row['nomeCliente'] ?></td>
            <td><?= $row['telefoneCliente'] ?></td>
            <td><?= $row['EmailCliente'] ?></td>
            <td><?= $row['nomeAnimal'] ?></td>
            <td><?= $row['fotoAnimal'] ?></td>
            <td><?= $row['tipoAnimal'] ?></td>
            
        </tr>
    	<?php endforeach; ?>
	</table>
	<br>
	<a href="index.php">Voltar</a>

</body>
</html>