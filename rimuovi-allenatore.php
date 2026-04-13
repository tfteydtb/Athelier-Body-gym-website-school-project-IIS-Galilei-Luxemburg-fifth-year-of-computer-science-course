<?php
$servername = "localhost"; $username = "root"; $password = ""; $dbname = "palestra";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connessione fallita: " . $conn->connect_error); }

$id = $_POST['id_allenatore'];
$sql = "DELETE FROM allenatori WHERE id = ?";

if($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $id);
    if($stmt->execute()) {
        echo "<h1>Allenatore rimosso con successo!</h1>";
        header("refresh:2;url=admin-allenatori.php");
    } else { 
        echo "<h1>Errore nella rimozione!</h1>";
        echo "<p>Potrebbe esserci un corso assegnato a questo allenatore. Elimina prima i suoi corsi!</p>"; 
    }
    $stmt->close();
}
$conn->close();
?>
