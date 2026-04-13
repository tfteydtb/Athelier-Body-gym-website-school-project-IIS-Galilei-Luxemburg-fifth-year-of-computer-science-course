<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "palestra";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connessione fallita: " . $conn->connect_error);
}

// Recupero dati
$tipo_corso = $_POST['tipo_corso'];
$id_allenatore = $_POST['id_allenatore'];
$data_corso = $_POST['data'];
$fascia_oraria = $_POST['fascia_oraria'];
$max_iscritti = $_POST['numero_massimo_iscritti'];

// SQL
$sql = "INSERT INTO corsi (tipo_corso, id_allenatore, data, fascia_oraria, numero_massimo_iscritti) VALUES (?, ?, ?, ?, ?)";

if($stmt = $conn->prepare($sql)) {
  // s = stringa, i = intero
  // Ordine: tipo_corso(s), id_allenatore(i), data(s), fascia_oraria(s), max_iscritti(i)
  $stmt->bind_param("sissi", $tipo_corso, $id_allenatore, $data_corso, $fascia_oraria, $max_iscritti);
  
  if($stmt->execute()) {
    echo "<h1>Corso pianificato con successo!</h1>";
    header("refresh:2;url=admin-corsi.html");
  } else {
    echo "Errore nell'inserimento: " . $stmt->error;
    echo "<br>Assicurati che l'ID Allenatore inserito esista nella tabella allenatori!";
  }
  $stmt->close();
}

$conn->close();
?>
