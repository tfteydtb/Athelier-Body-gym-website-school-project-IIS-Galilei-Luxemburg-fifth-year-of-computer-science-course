<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Atelier Body</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Stili Dashboard Admin - UNICI E GIOCOSI */
        .admin-bg {
            background-color: #F8C1BA;
            min-height: 100vh;
            padding-top: 180px; 
            overflow-x: hidden;
            padding-bottom: 100px;
        }

        .admin-title {
            font-family: 'Impact', sans-serif;
            font-size: 100px;
            color: black;
            text-align: center;
            text-transform: lowercase;
            margin-bottom: 80px;
            line-height: 0.9;
        }

        .admin-card-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            padding: 20px;
            flex-wrap: wrap;
        }

        .admin-card {
            width: 360px; /* Ridotto per farne stare 3 */
            height: 480px;
            background-color: white;
            border: 8px solid black;
            border-radius: 20px;
            position: relative;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 20px 20px 0px black;
            overflow: hidden;
            text-decoration: none;
        }

        .admin-card:hover {
            transform: scale(1.02);
            box-shadow: 10px 10px 0px black;
        }

        .admin-card-icon {
            font-size: 110px;
            margin-bottom: 20px;
            z-index: 5;
        }

        .admin-card-label {
            font-family: 'Impact', sans-serif;
            font-size: 32px;
            color: black;
            text-transform: lowercase;
            z-index: 5;
        }

        /* EFFETTO HOVER MAXIMA-STYLE (Pannello Bianco Sovrapposto) */
        .admin-explanation-panel {
            position: absolute;
            top: -100%; 
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            z-index: 10;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 30px;
            transition: all 0.6s cubic-bezier(0.19, 1, 0.22, 1);
            border-radius: 0 0 40px 40px; 
            text-align: left;
        }

        .admin-card:hover .admin-explanation-panel {
            top: 0;
        }

        .explanation-text-large {
            font-family: 'Impact', sans-serif;
            font-size: 45px;
            color: #C94245; 
            text-transform: uppercase;
            line-height: 0.95;
            transform: rotate(-6deg);
            margin-bottom: 20px;
            transition: transform 0.4s 0.2s;
        }

        .admin-card:hover .explanation-text-large {
            transform: rotate(-3deg) scale(1.05);
        }

        .explanation-desc-small {
            font-family: 'Impact', sans-serif;
            font-size: 19px;
            color: black;
            text-transform: lowercase;
            line-height: 1.1;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.4s 0.3s;
        }

        .admin-card:hover .explanation-desc-small {
            opacity: 1;
            transform: translateY(0);
        }

        .tag-admin {
            background-color: #F4ED36;
            color: black;
            padding: 5px 12px;
            font-family: 'Impact', sans-serif;
            font-size: 16px;
            width: fit-content;
            margin-bottom: 15px;
            border: 3px solid black;
            transform: rotate(2deg);
        }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader-content">
            <img src="personaggio.png" alt="Atelier Body" class="loader-logo">
            <div class="loader-bar"><div class="loader-progress"></div></div>
            <p class="loader-text">autorizzazione amministratore...</p>
        </div>
    </div>

    <!-- Navbar -->
    <div class="container-fluid fixed-top mt-4 d-flex justify-content-center" style="z-index: 9999;">
        <div class="navbar-custom">
            <div class="nav-item">
                <span id="menuToggle" class="nav-link-custom">menù</span>
            </div>
            <div class="nav-item logo-item">
                <a href="index.html" class="card">
                    <img src="logoScritta.png" class="img-base immagine_piccola">
                    <img src="personaggioHeader.png" class="img-hover immagine_piccola">
                </a>
            </div>
            <div class="nav-item">
                <a href="login.html" class="nav-link-custom">log-in</a>
            </div>
        </div>
    </div>

    <!-- Pulsante Accessibilità rapido -->
    <div class="accessibility-fab left-side" id="accFab" title="Accessibilità">
        <div class="wheelchair-icon">
            <div class="wheelchair-head"></div>
            <div class="wheelchair-body"></div>
            <div class="wheelchair-wheel"></div>
        </div>
    </div>

    <div id="accPanel" class="acc-panel">
        <span id="closeAcc" class="close-acc">&times;</span>
        <h3>Opzioni Accessibilità</h3>
        <button onclick="toggleHighContrast()">Inverti Colori (WCAG)</button>
        <button onclick="toggleDyslexicFont()">Font Leggibile (Dyslexic)</button>
        <button onclick="readAloud()">Leggi Contenuto (Audio)</button>
        <button onclick="changeFontSize(1.2)">Ingrandisci Caratteri</button>
        <button onclick="changeFontSize(1)">Dimensioni Standard</button>
    </div>

    <!-- Overlay Menu -->
    <div id="menuOverlay" class="menu-overlay">
        <span id="closeMenu" class="close-btn">&times;</span>
        <div class="menu-content">
            <a href="chi-siamo.html" class="menu-link">chi siamo</a>
            <a href="index.html#corsi" class="menu-link">corsi</a>
            <a href="allenatori.html" class="menu-link">allenatori</a>
            <a href="contatti.html" class="menu-link">contatti</a>
            <a href="admin.html" class="menu-link" style="color: #C94245;">admin area</a>
        </div>
    </div>

    <div class="admin-bg overflow-hidden position-relative">
        <div class="container pb-5">
            <h1 class="admin-title reveal-bouncy">dashboard <br> admin</h1>

            <div class="admin-card-container">
                <!-- 1. GESTIONE UTENTI -->
                <a href="admin-utenti.php" class="admin-card reveal-bouncy">
                    <div class="admin-explanation-panel">
                        <div class="tag-admin">database</div>
                        <div class="explanation-text-large">CONTROLLO <br> UTENTI</div>
                        <div class="explanation-desc-small">
                            Gestisci l'anagrafica completa, abbonamenti e scadenze di tutta la community.
                        </div>
                    </div>
                    <div class="admin-card-icon">👥</div>
                    <div class="admin-card-label">gestione utenti</div>
                </a>

                <!-- 2. GESTIONE ALLENATORI -->
                <a href="admin-allenatori.php" class="admin-card reveal-bouncy" style="transition-delay: 0.1s;">
                    <div class="admin-explanation-panel">
                        <div class="tag-admin">staff</div>
                        <div class="explanation-text-large">SQUADRA <br> COACH</div>
                        <div class="explanation-desc-small">
                            Arruola nuovi istruttori o gestisci i profili dei maestri d'assalto.
                        </div>
                    </div>
                    <div class="admin-card-icon">💪</div>
                    <div class="admin-card-label">gestione allenatori</div>
                </a>

                <!-- 3. GESTIONE CORSI -->
                <a href="admin-corsi.php" class="admin-card reveal-bouncy" style="transition-delay: 0.2s;">
                    <div class="admin-explanation-panel">
                        <div class="tag-admin">palinsesto</div>
                        <div class="explanation-text-large">PIANO <br> CORSI</div>
                        <div class="explanation-desc-small">
                            Organizza le sessioni settimanali, assegna coach e monitora le disponibilità.
                        </div>
                    </div>
                    <div class="admin-card-icon">🗓️</div>
                    <div class="admin-card-label">gestione corsi</div>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer Completo -->
    <footer class="footer-custom mt-5">
        <div class="footer-deco" style="top: 10%; right: 5%;">⚙️</div>
        <div class="footer-deco" style="bottom: 15%; left: 2%;">🔒</div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="logoScritta.png" alt="Atelier Body" class="footer-logo">
                    <div class="footer-info" style="color: black;">
                        area riservata amministatore<br>
                        via dell'acciaio, 42 - genova
                    </div>
                </div>
                <div class="col-lg-6 text-end">
                    <p class="text-black fw-bold">STAY FOCUSED, ADMIN.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>