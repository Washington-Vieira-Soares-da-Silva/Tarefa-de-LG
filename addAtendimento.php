<?php
	include('conn.php');

$sql = "
    SELECT
        c.codAtendimento,
        c.DataAtendimento,
        c.HoraAtendimento,
        a.codAnimal,
        a.nomeAnimal,
        t.codVet,    
        t.nomeVet
    FROM
        tbAnimal a 
    INNER JOIN
        tbAtendimento c ON c.codAnimal = a.codAnimal
    INNER JOIN
        tbVeterinario t ON c.codVet = t.codVet;
";
$result = $pdo->query($sql)->fetchAll();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$DataAtendimento = $_POST['DataAtendimento'];
		$HoraAtendimento = $_POST['HoraAtendimento'];
		$codAnimal = $_POST['codAnimal'];
		$codVet = $_POST['codVet'];

		$stmt = $pdo->prepare('INSERT INTO tbAtendimento (DataAtendimento, HoraAtendimento, codAnimal, codVet) VALUES (?, ?, ?, ?)');
		$stmt->execute([$DataAtendimento, $HoraAtendimento, $codAnimal, $codVet]);

		header('location: addAtendimento.php');
		exit();
	}

	$Animais = $pdo->query('SELECT codAnimal, nomeAnimal FROM tbAnimal')->fetchAll();
	$Veterinarios = $pdo->query('SELECT codVet, nomeVet FROM tbVeterinario')->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Adicionar Atendimento</title>
</head>
<body>
	<h2>Adicionar Atendimento</h2>
	<form method="POST">
		
		<label for="DataAtendimento">Data do Atendimento:</label>
		<input type="text" name="DataAtendimento" required><br>

		<label for="HoraAtendimento">Hora do Atendimento:</label>
		<input type="text" name="HoraAtendimento" required><br>

		<label for="codAnimal">Animal:</label>

		<select name="codAnimal" required>
			<?php foreach ($Animais as $Animal): ?>
				<option value="<?= $Animal['codAnimal'] ?>"><?= $Animal['nomeAnimal'] ?></option>
			<?php endforeach; ?>
		</select><br>

		<label for="codVet">Veterinario:</label>

		<select name="codVet" required>
			<?php foreach ($Veterinarios as $Veterinario): ?>
				<option value="<?= $Veterinario['codVet'] ?>"><?= $Veterinario['nomeVet'] ?></option>
			<?php endforeach; ?>
		</select><br>
		<br>
		<input type="submit" value="Adicionar">

	</form>

	<table>
	    <tr>
	    	<th>Codigo do Atendimento:</th>
	        <th>Data do Atendimento:</th>
	        <th>Hora do Atendimento:</th>
	        <th>Codigo do Animal:</th>
	        <th>Animal:</th>
	        <th>Codigo do Veterinário:</th>
	        <th>Veterinário:</th> 
	        <th>Ação</th>
	    </tr>
    	<?php foreach ($result as $row): ?>
        <tr>
        	<td><?= $row['codAtendimento'] ?></td>
            <td><?= $row['DataAtendimento'] ?></td>
            <td><?= $row['HoraAtendimento'] ?></td>
            <td><?= $row['codAnimal'] ?></td>
            <td><?= $row['nomeAnimal'] ?></td> 
            <td><?= $row['codVet'] ?></td>
            <td><?= $row['nomeVet'] ?></td> 
            <td>
                <a href='excluir.php?id=<?= $row['codAtendimento'] ?>'>Excluir</a>
            </td>
        </tr>
    	<?php endforeach; ?>
	</table>

	<br>
	<a href="index.php">Voltar</a>
</body>
</html>