<?php
$servername = "localhost"; $username = "root"; $password = ""; $dbname = "palestra";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connessione fallita: " . $conn->connect_error); }

$coach_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

$sql_c = "SELECT nome, cognome FROM allenatori WHERE id = $coach_id";
$res_c = $conn->query($sql_c);
$coach = $res_c->fetch_assoc();

$sql_corsi = "SELECT * FROM corsi WHERE id_allenatore = $coach_id ORDER BY data ASC";
$mie_lezioni = $conn->query($sql_corsi);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Coach | Atelier Body</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="coach-bg text-center">
        <div class="container">
            <h1 class="coach-title">bentornato coach <?php echo $coach['cognome']; ?></h1>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="admin-card reveal-bouncy">
                        <h2 class="impact-text mb-4">le tue prossime lezioni</h2>
                        <?php if($mie_lezioni->num_rows > 0): ?>
                            <?php while($l = $mie_lezioni->fetch_assoc()): ?>
                                <div class="lezione-item">
                                    <h4 class="fw-bold text-uppercase"><?php echo $l['tipo_corso']; ?></h4>
                                    <p class="mb-0">
                                        📅 <strong>Data:</strong> <?php echo $l['data']; ?> | 
                                        ⏰ <strong>Ora:</strong> <?php echo $l['fascia_oraria']; ?> | 
                                        👥 <strong>Posti:</strong> <?php echo $l['numero_massimo_iscritti']; ?>
                                    </p>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>Non hai lezioni programmate al momento. Riposati!</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="mt-5">
                <a href="index.html" class="btn-footer" style="background-color: black; color: white;">log-out coach</a>
            </div>
        </div>
    </div>
    <div id="cursor"></div>
    <div id="cursor-follower"></div>

    <script src="script.js"></script>
</body>
</html>
<?php $conn->close(); ?>
