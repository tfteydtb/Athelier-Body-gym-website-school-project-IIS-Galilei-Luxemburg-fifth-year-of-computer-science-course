<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "palestra";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connessione fallita: " . $conn->connect_error); }

$sql_utenti = "SELECT id, nome, cognome FROM utenti";
$risultato_utenti = $conn->query($sql_utenti);
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Utenti | Atelier Body</title>
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

    <div class="admin-sub-bg utenti">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="admin-title text-white">gestione utenti</h1>
                <a href="admin.php" class="btn btn-outline-light btn-sm fw-bold">← Dashboard</a>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- Aggiungi Utente -->
                <div class="col-12 col-xl-7">
                    <div class="admin-card-form reveal-bouncy">
                        <h2 class="form-title">nuovo profilo</h2>
                        <form action="inserisci-utente.php" method="POST">
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label class="admin-label">nome</label>
                                    <input type="text" name="nome" class="form-control-admin" placeholder="es. Mario" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="admin-label">cognome</label>
                                    <input type="text" name="cognome" class="form-control-admin" placeholder="es. Rossi" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="admin-label">codice fiscale</label>
                                    <input type="text" name="codice_fiscale" class="form-control-admin" placeholder="RSSMRA..." required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="admin-label">telefono</label>
                                    <input type="tel" name="telefono" class="form-control-admin" placeholder="+39..." required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="admin-label">abbonamento</label>
                                    <select name="tipo_abbonamento" class="form-control-admin">
                                        <option value="basic">Basic</option>
                                        <option value="elite">Elite</option>
                                        <option value="pro">Pro</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="admin-label">email</label>
                                    <input type="email" name="mail" class="form-control-admin" placeholder="mario@email.it" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="admin-label">data inizio</label>
                                    <input type="date" name="data_inizio" class="form-control-admin" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="admin-label">data fine</label>
                                    <input type="date" name="data_fine" class="form-control-admin" required>
                                </div>
                                <div class="col-12">
                                    <label class="admin-label">password</label>
                                    <div class="password-box">
                                        <input type="password" name="password" id="userPass" class="form-control-admin" placeholder="********" required>
                                        <span class="password-eye" onclick="togglePass('userPass')">👁️</span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn-admin-action btn-add w-100 mt-3">registra ora</button>
                        </form>
                    </div>
                </div>

                <script>
                    function togglePass(id) {
                        const input = document.getElementById(id);
                        input.type = input.type === "password" ? "text" : "password";
                    }
                </script>

                <!-- Rimuovi Utente Dinamico -->
                <div class="col-12 col-xl-5">
                    <div class="admin-card-form reveal-bouncy" style="transition-delay: 0.2s;">
                        <h2 class="form-title" style="border-color: #C94245;">rimuovi utente</h2>
                        <form action="rimuovi-utente.php" method="POST" onsubmit="return confirm('Sei sicuro? Questa azione è irreversibile.')">
                            <label class="admin-label">seleziona chi eliminare</label>
                            <select name="id_utente" class="form-control-admin" required>
                                <option value="">-- Scegli Utente --</option>
                                <?php
                                while($row = $risultato_utenti->fetch_assoc()) {
                                    echo "<option value='{$row['id']}'>{$row['nome']} {$row['cognome']} (ID: {$row['id']})</option>";
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn-admin-action btn-remove w-100 mt-3">elimina profilo</button>
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
