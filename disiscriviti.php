<?php
$servername = "localhost"; $username = "root"; $password = ""; $dbname = "palestra";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connessione fallita: " . $conn->connect_error); }

$id_utente = $_POST['id_utente'];
$id_corso = $_POST['id_corso'];

// SQL per rimuovere l'iscrizione
$sql = "DELETE FROM iscrizioni WHERE id_utente = ? AND id_corso = ?";

if($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ii", $id_utente, $id_corso);
    if($stmt->execute()) {
        echo "<h1>Ti sei disiscritto correttamente dal corso.</h1>";
        header("refresh:2;url=area-utente.php?id=$id_utente");
    } else {
        echo "Errore: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
