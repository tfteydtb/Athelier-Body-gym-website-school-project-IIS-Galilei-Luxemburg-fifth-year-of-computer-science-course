<?php
$servername = "localhost"; $username = "root"; $password = ""; $dbname = "palestra";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connessione fallita: " . $conn->connect_error); }

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

$sql_u = "SELECT nome FROM utenti WHERE id = $user_id";
$res_u = $conn->query($sql_u);
$utente = $res_u->fetch_assoc();

$sql_c = "SELECT * FROM corsi WHERE id NOT IN (SELECT id_corso FROM iscrizioni WHERE id_utente = $user_id)";
$corsi_disponibili = $conn->query($sql_c);

$sql_i = "SELECT c.id as id_corso, c.tipo_corso, c.data, c.fascia_oraria, a.cognome as coach 
          FROM iscrizioni i 
          JOIN corsi c ON i.id_corso = c.id 
          JOIN allenatori a ON c.id_allenatore = a.id 
          WHERE i.id_utente = $user_id";
$mie_iscrizioni = $conn->query($sql_i);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Utente | Atelier Body</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="user-bg text-center">
        <div class="container">
            <h1 class="user-title">ciao, <?php echo $utente['nome']; ?>!</h1>
            
            <div class="row">
                <!-- LE MIE ISCRIZIONI -->
                <div class="col-md-6 text-start">
                    <div class="admin-card">
                        <h2 class="impact-text" style="color: #C94245;">i tuoi corsi</h2>
                        <hr>
                        <?php if($mie_iscrizioni->num_rows > 0): ?>
                            <?php while($i = $mie_iscrizioni->fetch_assoc()): ?>
                                <div class="course-item">
                                    <div>
                                        <strong><?php echo $i['tipo_corso']; ?></strong><br>
                                        <small><?php echo $i['data']; ?> ore <?php echo $i['fascia_oraria']; ?> (Coach: <?php echo $i['coach']; ?>)</small>
                                    </div>
                                    <form action="disiscriviti.php" method="POST" onsubmit="return confirm('Sicuro di voler annullare l\'iscrizione?')">
                                        <input type="hidden" name="id_utente" value="<?php echo $user_id; ?>">
                                        <input type="hidden" name="id_corso" value="<?php echo $i['id_corso']; ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger border-2 fw-bold">Disiscriviti</button>
                                    </form>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>Non sei ancora iscritto a nessun corso. Muoviti!</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- ISCRIVITI A NUOVI CORSI -->
                <div class="col-md-6 text-start">
                    <div class="admin-card">
                        <h2 class="impact-text" style="color: #8584BD;">nuove sfide</h2>
                        <p>Scegli il corso e scendi in arena:</p>
                        <form action="iscriviti-corso.php" method="POST">
                            <input type="hidden" name="id_utente" value="<?php echo $user_id; ?>">
                            <select name="id_corso" class="form-control mb-3" style="border: 3px solid black; font-weight: bold;" required>
                                <option value="">-- Seleziona Corso --</option>
                                <?php while($c = $corsi_disponibili->fetch_assoc()): ?>
                                    <option value="<?php echo $c['id']; ?>">
                                        <?php echo $c['tipo_corso']; ?> (<?php echo $c['data']; ?>)
                                    </option>
                                <?php endwhile; ?>
                            </select>
                            <button type="submit" class="btn-iscriviti w-100">conferma iscrizione</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="mt-5">
                <a href="index.html" class="btn-footer">esci dall'area personale</a>
            </div>
        </div>
    </div>
    <div id="cursor"></div>
    <div id="cursor-follower"></div>

    <script src="script.js"></script>
</body>
</html>
<?php $conn->close(); ?>
