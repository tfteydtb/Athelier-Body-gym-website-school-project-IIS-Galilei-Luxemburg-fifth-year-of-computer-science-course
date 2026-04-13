<?php
$servername = "localhost"; $username = "root"; $password = ""; $dbname = "palestra";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connessione fallita: " . $conn->connect_error); }

$id = $_POST['id_utente'];
$sql = "DELETE FROM utenti WHERE id = ?";

if($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $id);
    if($stmt->execute()) {
        echo "<h1>Utente rimosso con successo!</h1>";
        header("refresh:2;url=admin-utenti.php");
    } else { echo "Errore: " . $stmt->error; }
    $stmt->close();
}
$conn->close();
?>
