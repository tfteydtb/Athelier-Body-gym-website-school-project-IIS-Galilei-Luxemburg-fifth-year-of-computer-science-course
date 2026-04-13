<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "palestra";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connessione fallita: " . $conn->connect_error); }

$sql_allenatori = "SELECT id, nome, cognome FROM allenatori";
$risultato_allenatori = $conn->query($sql_allenatori);
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Allenatori | Atelier Body</title>
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

    <div class="admin-sub-bg allenatori">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="admin-title text-white">gestione allenatori</h1>
                <a href="admin.php" class="btn btn-outline-light btn-sm fw-bold">← Dashboard</a>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="admin-card-form reveal-bouncy">
                        <h2 class="form-title">nuovo coach</h2>
                        <form action="inserisci-allenatore.php" method="POST">
                            <label class="admin-label">nome</label>
                            <input type="text" name="nome" class="form-control-admin" placeholder="es. Marco" required>
                            <label class="admin-label">cognome</label>
                            <input type="text" name="cognome" class="form-control-admin" placeholder="es. Rossi" required>
                            <label class="admin-label">email</label>
                            <input type="email" name="mail" class="form-control-admin" placeholder="coach@email.it" required>
                            <label class="admin-label">password</label>
                            <div class="password-box mb-3">
                                <input type="password" name="password" id="coachPass" class="form-control-admin" placeholder="********" required>
                                <span class="password-eye" onclick="togglePass('coachPass')">👁️</span>
                            </div>
                            <button type="submit" class="btn-admin-action btn-add w-100">arruola coach</button>
                        </form>
                    </div>
                </div>

                <script>
                    function togglePass(id) {
                        const input = document.getElementById(id);
                        input.type = input.type === "password" ? "text" : "password";
                    }
                </script>

                <div class="col-12 col-md-6">
                    <div class="admin-card-form reveal-bouncy" style="transition-delay: 0.2s;">
                        <h2 class="form-title" style="border-color: black;">rimuovi</h2>
                        <form action="rimuovi-allenatore.php" method="POST" onsubmit="return confirm('Sicuro di voler licenziare questo coach?')">
                            <label class="admin-label">seleziona allenatore</label>
                            <select name="id_allenatore" class="form-control-admin mb-4" required>
                                <option value="">-- Scegli Allenatore --</option>
                                <?php
                                while($row = $risultato_allenatori->fetch_assoc()) {
                                    echo "<option value='{$row['id']}'>{$row['nome']} {$row['cognome']} (ID: {$row['id']})</option>";
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn-admin-action btn-remove w-100">licenzia coach</button>
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
