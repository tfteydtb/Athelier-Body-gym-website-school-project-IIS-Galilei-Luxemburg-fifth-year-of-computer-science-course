<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "palestra";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connessione fallita: " . $conn->connect_error); }

// Per la select degli allenatori nell'inserimento (Bonus semplicità)
$sql_all = "SELECT id, cognome FROM allenatori";
$res_all = $conn->query($sql_all);

// Per la rimozione dei corsi
$sql_corsi = "SELECT c.id, c.tipo_corso, c.data, a.cognome FROM corsi c JOIN allenatori a ON c.id_allenatore = a.id";
$risultato_corsi = $conn->query($sql_corsi);
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Corsi | Atelier Body</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="preloader">
        <div class="loader-content">
            <img src="personaggio.png" alt="Atelier Body" class="loader-logo">
            <div class="loader-bar"><div class="loader-progress"></div></div>
        </div>
    </div>

    <div class="admin-sub-bg corsi">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="admin-title text-black">gestione corsi</h1>
                <a href="admin.php" class="btn btn-dark btn-sm fw-bold">← Dashboard</a>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="admin-card-form reveal-bouncy">
                        <h2 class="form-title">crea evento</h2>
                        <form action="inserisci-corso.php" method="POST">
                            <label class="admin-label">tipologia</label>
                            <select name="tipo_corso" class="form-control-admin">
                                <option value="functional training">Functional Training</option>
                                <option value="hiit">HIIT</option>
                                <option value="yoga flow">Yoga Flow</option>
                                <option value="fit boxing">Fit Boxing</option>
                                <option value="strength & conditioning">Strength & Conditioning</option>
                            </select>
                            <label class="admin-label">allenatore</label>
                            <select name="id_allenatore" class="form-control-admin" required>
                                <option value="">-- Scegli Coach --</option>
                                <?php
                                while($r = $res_all->fetch_assoc()) {
                                    echo "<option value='{$r['id']}'>{$r['cognome']} (ID: {$r['id']})</option>";
                                }
                                ?>
                            </select>
                            <label class="admin-label">data</label>
                            <input type="date" name="data" class="form-control-admin" required>
                            <label class="admin-label">fascia oraria</label>
                            <input type="text" name="fascia_oraria" class="form-control-admin" placeholder="es. 18:00 - 19:30" required>
                            <label class="admin-label">max iscritti</label>
                            <input type="number" name="numero_massimo_iscritti" class="form-control-admin" value="20" required>
                            <button type="submit" class="btn-admin-action btn-add w-100 mt-3">pubblica corso</button>
                        </form>
                    </div>
                </div>

                <!-- Rimuovi Corso -->
                <div class="col-12 col-md-6">
                    <div class="admin-card-form reveal-bouncy" style="transition-delay: 0.2s;">
                        <h2 class="form-title" style="border-color: #C94245;">rimuovi</h2>
                        <form action="rimuovi-corso.php" method="POST" onsubmit="return confirm('Sicuro di voler cancellare questo corso?')">
                            <label class="admin-label">seleziona corso</label>
                            <select name="id_corso" class="form-control-admin mb-4" required>
                                <option value="">-- Elenco Corsi --</option>
                                <?php
                                while($row = $risultato_corsi->fetch_assoc()) {
                                    echo "<option value='{$row['id']}'>{$row['tipo_corso']} - {$row['cognome']} ({$row['data']})</option>";
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn-admin-action btn-remove w-100">elimina corso</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="cursor"></div>
    <div id="cursor-follower"></div>

    <script src="script.js"></script>
</body>
</html>
<?php $conn->close(); ?>
