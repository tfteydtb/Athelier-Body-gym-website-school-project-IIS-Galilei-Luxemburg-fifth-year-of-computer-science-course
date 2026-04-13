<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "palestra";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$user_input = $_POST['user'];
$pass_input = $_POST['pass'];

$stmt = $conn->prepare("SELECT id FROM amministratori WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $user_input, $pass_input);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    header("Location: admin.php");
    exit();
}

$stmt = $conn->prepare("SELECT id FROM utenti WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $user_input, $pass_input);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    header("Location: area-utente.php?id=" . $row['id']);
    exit();
}

$stmt = $conn->prepare("SELECT id FROM allenatori WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $user_input, $pass_input);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    header("Location: area-allenatore.php?id=" . $row['id']);
    exit();
}

echo "<script>alert('E-mail o Password errate!'); window.location.href='login.html';</script>";

$stmt->close();
$conn->close();
?>
