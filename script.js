window.addEventListener('load', function () {
    const preloader = document.getElementById('preloader');
    const introImg = document.querySelector('.intro-img');
    if (preloader) {
        setTimeout(() => {
            preloader.classList.add('fade-out');
            if (introImg) {
                introImg.classList.add('start-anim');
            }
        }, 2000);
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menuToggle');
    const menuOverlay = document.getElementById('menuOverlay');
    const closeMenu = document.getElementById('closeMenu');
    const corsiLink = document.getElementById('corsiLink');

    // Apertura menu
    if (menuToggle) {
        menuToggle.addEventListener('click', function () {
            menuOverlay.classList.add('active');
        });
    }

    // Chiusura menu da X
    if (closeMenu) {
        closeMenu.addEventListener('click', function () {
            menuOverlay.classList.remove('active');
        });
    }

    // Chiusura menu quando si clicca un link interno come 'Corsi'
    if (corsiLink) {
        corsiLink.addEventListener('click', function () {
            menuOverlay.classList.remove('active');
        });
    }
});

// Scroll animations per la comparsa dei personaggi e nuovi effetti bouncy
const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px"
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            entry.target.classList.add('active');
        }
    });
}, observerOptions);

document.querySelectorAll('.animate-on-scroll, .reveal-bouncy').forEach(el => {
    observer.observe(el);
});

// Dati Modal dei Corsi
const corsiData = {
    'functional': {
        titolo: 'FUNCTIONAL TRAINING',
        desc: 'Allenamento completo a corpo libero + attrezzi\nMigliora forza, resistenza e coordinazione\nMolto dinamico (circuiti, HIIT)',
        istruttore: 'Marco Rossi',
        linkIstruttore: 'marco-rossi.html'
    },
    'hiit': {
        titolo: 'HIIT',
        desc: 'Allenamenti brevi ma super intensi\nPerfetto per bruciare grassi velocemente\nAlterna esercizi esplosivi e recupero',
        istruttore: 'Luca Bianchi',
        linkIstruttore: 'luca-bianchi.html'
    },
    'yoga': {
        titolo: 'YOGA FLOW',
        desc: 'Allenamento lento e controllato\nMigliora flessibilità e postura\nOttimo per ridurre lo stress',
        istruttore: 'Sara Verdi',
        linkIstruttore: 'sara-verdi.html'
    },
    'boxing': {
        titolo: 'FIT BOXING',
        desc: 'Mix tra boxe e fitness\nAllenamento cardio intenso\nMolto coinvolgente',
        istruttore: 'Andrea Neri',
        linkIstruttore: 'andrea-neri.html'
    },
    'strength': {
        titolo: 'STRENGTH & CONDITIONING',
        desc: 'Allenamento forza pura\nUso di pesi e bilancieri\nIdeale per massa muscolare',
        istruttore: 'Davide Gallo',
        linkIstruttore: 'davide-gallo.html'
    }
};

// Logica di apertura modale (globale)
window.openCorsoModal = function (corsoId) {
    const data = corsiData[corsoId];
    if (data) {
        document.getElementById('modalTitle').textContent = data.titolo;
        document.getElementById('modalDescription').textContent = data.desc;
        const istruttoreLink = document.getElementById('modalIstruttore');
        istruttoreLink.textContent = data.istruttore;
        istruttoreLink.href = data.linkIstruttore;

        const modal = document.getElementById('corsoModal');
        if (modal) {
            modal.classList.add('active');
        }
    }
};

window.closeCorsoModal = function () {
    const modal = document.getElementById('corsoModal');
    if (modal) {
        modal.classList.remove('active');
    }
};

// Chiudere il modale se clicco sull'overlay scuro
const corsoModal = document.getElementById('corsoModal');
if (corsoModal) {
    corsoModal.addEventListener('click', function (e) {
        if (e.target === this) {
            window.closeCorsoModal();
        }
    });
}

// ------------------------------------- 
// Logica Pagamento e Carta di Credito 
// ------------------------------------- 

document.addEventListener('DOMContentLoaded', function () {
    const cardNameInput = document.getElementById('cardNameInput');
    const cardNumInput = document.getElementById('cardNumInput');
    const cardExpiryInput = document.getElementById('cardExpiryInput');

    const cardNameDisplay = document.getElementById('cardNameDisplay');
    const cardNumDisplay = document.getElementById('cardNumDisplay');
    const cardExpiryDisplay = document.getElementById('cardExpiryDisplay');
    const cardBrandIcon = document.getElementById('cardBrandIcon');

    if (cardNameInput) {
        cardNameInput.addEventListener('input', function () {
            cardNameDisplay.textContent = this.value.toUpperCase() || 'NOME COGNOME';
        });
    }

    if (cardNumInput) {
        cardNumInput.addEventListener('input', function () {
            let val = this.value.replace(/\D/g, ''); // Rimuove non numerici
            let formatted = '';
            for (let i = 0; i < val.length; i++) {
                if (i > 0 && i % 4 === 0) formatted += ' ';
                formatted += val[i];
            }
            this.value = formatted;

            // Aggiorna display (con pallini per le cifre mancanti)
            let displayVal = formatted;
            if (formatted.length < 19) {
                // Esempio: 1234 5...
                // Non aggiungiamo pallini in modo complesso, basta mostrare quello che c'è
            }
            cardNumDisplay.textContent = formatted || '1234 •••• •••• 5678';

            // Cambio icona brand (semplificato)
            if (val.startsWith('4')) {
                cardBrandIcon.src = 'https://img.icons8.com/color/48/ffffff/visa.png';
            } else if (val.startsWith('5')) {
                cardBrandIcon.src = 'https://img.icons8.com/color/48/ffffff/mastercard.png';
            } else {
                cardBrandIcon.src = 'https://img.icons8.com/color/48/ffffff/visa.png'; // Default
            }
        });
    }

    if (cardExpiryInput) {
        cardExpiryInput.addEventListener('input', function () {
            let val = this.value.replace(/\D/g, '');
            if (val.length > 2) {
                val = val.substring(0, 2) + '/' + val.substring(2, 4);
            }
            this.value = val;
            cardExpiryDisplay.textContent = val || 'MM/AA';
        });
    }

    const paymentForm = document.getElementById('paymentForm');
    if (paymentForm) {
        paymentForm.addEventListener('submit', function (e) {
            e.preventDefault();
            alert('Pagamento effettuato con successo! Benvenuto in Atelier Body.');
            window.location.href = 'index.html';
        });
    }
});

// ------------------------------------- 
// Cursore Personalizzato Dinamico 
// ------------------------------------- 

document.addEventListener('DOMContentLoaded', function () {
    // Crea l'elemento cursore se non esiste
    if (!document.getElementById('custom-cursor')) {
        const cursor = document.createElement('div');
        cursor.id = 'custom-cursor';
        document.body.appendChild(cursor);
    }

    const cursor = document.getElementById('custom-cursor');

    document.addEventListener('mousemove', function (e) {
        cursor.style.left = e.clientX + 'px';
        cursor.style.top = e.clientY + 'px';
    });

    // Gestione hover su elementi cliccabili
    const clickables = document.querySelectorAll('a, button, .nav-link-custom, #menuToggle, .close-btn, [onclick]');

    clickables.forEach(el => {
        el.addEventListener('mouseenter', () => {
            cursor.classList.add('hover');
        });
        el.addEventListener('mouseleave', () => {
            cursor.classList.remove('hover');
        });
    });

    // Per elementi dinamici (opzionale se ne aggiungi altri)
    document.addEventListener('mouseover', function (e) {
        if (e.target.tagName === 'A' || e.target.tagName === 'BUTTON' || e.target.closest('a') || e.target.closest('button') || window.getComputedStyle(e.target).cursor === 'pointer') {
            cursor.classList.add('hover');
        } else {
            // Verifica se non siamo su un elemento cliccabile
            // Nota: mouseover bubble, quindi serve cautela
        }
    });

    document.addEventListener('mouseout', function (e) {
        if (e.target.tagName === 'A' || e.target.tagName === 'BUTTON' || e.target.closest('a') || e.target.closest('button')) {
            cursor.classList.remove('hover');
        }
    });
});

// ------------------------------------- 
// Logica Accessibilità 
// ------------------------------------- 

document.addEventListener('DOMContentLoaded', function () {
    const accFab = document.getElementById('accFab');
    const accPanel = document.getElementById('accPanel');
    const closeAcc = document.getElementById('closeAcc');

    if (accFab) {
        accFab.addEventListener('click', () => {
            accPanel.classList.toggle('active');
        });
    }

    if (closeAcc) {
        closeAcc.addEventListener('click', () => {
            accPanel.classList.remove('active');
        });
    }

    // Funzioni Globali per i bottoni onclick con Persistenza
    window.toggleHighContrast = function () {
        const active = document.body.classList.toggle('high-contrast');
        localStorage.setItem('high-contrast', active);
    };

    window.toggleDyslexicFont = function () {
        const active = document.body.classList.toggle('dyslexic-font');
        localStorage.setItem('dyslexic-font', active);
    };

    window.readAloud = function () {
        const textToRead = document.body.innerText;
        const utterance = new SpeechSynthesisUtterance(textToRead);
        utterance.lang = 'it-IT';
        if (window.speechSynthesis.speaking) {
            window.speechSynthesis.cancel();
        } else {
            window.speechSynthesis.speak(utterance);
        }
    };

    window.changeFontSize = function (size) {
        document.body.style.fontSize = (size * 100) + '%';
        localStorage.setItem('font-size', size);
    };

    // Al caricamento, ripristina le impostazioni salvate
    if (localStorage.getItem('high-contrast') === 'true') {
        document.body.classList.add('high-contrast');
    }
    if (localStorage.getItem('dyslexic-font') === 'true') {
        document.body.classList.add('dyslexic-font');
    }
    const savedFontSize = localStorage.getItem('font-size');
    if (savedFontSize) {
        document.body.style.fontSize = (savedFontSize * 100) + '%';
    }
});
