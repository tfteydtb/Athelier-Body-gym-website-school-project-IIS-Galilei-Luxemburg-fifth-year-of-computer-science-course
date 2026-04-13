<?php
$servername = "localhost"; $username = "root"; $password = ""; $dbname = "palestra";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connessione fallita: " . $conn->connect_error); }

$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['mail']; // Riceviamo 'mail' dal form
$password_coach = $_POST['password'];

// Inserimento con colonna 'email'
$sql = "INSERT INTO allenatori (nome, cognome, email, password) VALUES (?, ?, ?, ?)";

if($stmt = $conn->prepare($sql)) {
  $stmt->bind_param("ssss", $nome, $cognome, $email, $password_coach);
  
  if($stmt->execute()) {
    echo "<h1>Allenatore aggiunto con successo!</h1>";
    header("refresh:2;url=admin-allenatori.php");
  } else {
    echo "Errore: " . $stmt->error;
  }
  $stmt->close();
}
$conn->close();
?>
