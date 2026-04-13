<?php
$servername = "localhost"; $username = "root"; $password = ""; $dbname = "palestra";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connessione fallita: " . $conn->connect_error); }

$id_utente = intval($_POST['id_utente']);
$id_corso = intval($_POST['id_corso']);

// 1. Recupero data corso con prepared statement
$stmt_data = $conn->prepare("SELECT data FROM corsi WHERE id = ?");
$stmt_data->bind_param("i", $id_corso);
$stmt_data->execute();
$res_data = $stmt_data->get_result();
$data_corso = $res_data->fetch_assoc()['data'];

// 2. Inserimento iscrizione
$sql = "INSERT INTO iscrizioni (id_utente, id_corso, data_iscrizione) VALUES (?, ?, ?)";
if($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("iis", $id_utente, $id_corso, $data_corso);
    if($stmt->execute()) {
        echo "<h1 style='text-align:center; font-family:Impact; margin-top:100px;'>ISCRIZIONE COMPLETATA! 🏋️‍♂️</h1>";
        header("refresh:2;url=area-utente.php?id=$id_utente");
    }
    $stmt->close();
}
$conn->close();
?>
