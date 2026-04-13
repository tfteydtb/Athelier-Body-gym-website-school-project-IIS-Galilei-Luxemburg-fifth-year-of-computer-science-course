<?php
$servername = "localhost"; $username = "root"; $password = ""; $dbname = "palestra";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connessione fallita: " . $conn->connect_error); }

$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$codice_fiscale = $_POST['codice_fiscale'];
$telefono = $_POST['telefono'];
$tipo_abbonamento = $_POST['tipo_abbonamento'];
$data_inizio = $_POST['data_inizio'];
$data_fine = $_POST['data_fine'];
$email = $_POST['mail']; 
$password_utente = $_POST['password'];

$sql = "INSERT INTO utenti (nome, cognome, codice_fiscale, telefono, tipo_abbonamento, data_inizio, data_fine, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

if($stmt = $conn->prepare($sql)) {
  $stmt->bind_param("sssssssss", $nome, $cognome, $codice_fiscale, $telefono, $tipo_abbonamento, $data_inizio, $data_fine, $email, $password_utente);
  
  if($stmt->execute()) {
    echo "<h1>Utente registrato con successo!</h1>";
    header("refresh:2;url=admin-utenti.php");
  } else {
    echo "Errore: " . $stmt->error;
  }
  $stmt->close();
}
$conn->close();
?>
