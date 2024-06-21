<?php
include('conn.php');

if (isset($_GET['id'])) {
    $codAtendimento = $_GET['id'];

    $stmt = $pdo->prepare('DELETE FROM tbAtendimento WHERE codAtendimento = ?');
    $stmt->execute([$codAtendimento]);

    header('Location: addAtendimento.php');
    exit();
} else {
    header('Location: addAtendimento.php');
    exit();
}
?>
