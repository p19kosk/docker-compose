<?php
session_start();
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Αρχική - Πλατφόρμα Λιστών Αναπαραγωγής</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', Arial, Helvetica, sans-serif;
            background-color: #1a202c;
            color: #e2e8f0;
            transition: background-color 0.3s, color 0.3s;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            line-height: 1.6;
        }

        .topnav {
            overflow: hidden;
            background-color: #2d3748;
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 60px;
            padding: 0 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .topnav .brand {
            color: #8db1da;
            font-size: 24px;
            font-weight: 600;
        }

        .nav-links-group {
            display: flex;
            justify-content: flex-end;
            <?php if (isset($_SESSION['user_id'])): ?>
                gap: 20px;
                width: 160%;
            <?php else: ?>
                gap: 60px;
                width: 650%;
            <?php endif; ?>
        }

        .nav-links-group-user {
            display: flex;
            gap: 1px;
            justify-content: flex-end;
            width: 80%;
        }

        .topnav a:not(.login-signup-link, .logout-link) {
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
            font-weight: 400;
            transition: background-color 0.3s, color 0.3s;
            display: inline-block;
            border-radius: 8px;
        }

        .topnav a:not(.login-signup-link, .logout-link):hover {
            background-color: #4a5568;
            color: white;
        }

        .topnav a.active {
            background-color: #4a5568;
            color: white;
            font-weight: 600;
        }

        .topnav-right-items {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .login-signup-link, .logout-link {
            padding: 10px 18px;
            border-radius: 8px;
            background-color: #4a5568;
            color: #e2e8f0;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: background-color 0.3s, color 0.3s, transform 0.2s;
            white-space: nowrap;
        }

        .login-signup-link:hover, .logout-link:hover {
            background-color: #615bb1;
            color: white;
            transform: translateY(-2px);
        }

        #theme-toggle {
            background: none;
            border: none;
            color: #8db1da;
            font-size: 22px;
            cursor: pointer;
            padding: 5px;
            line-height: 1;
            transition: color 0.3s, transform 0.2s;
        }

        #theme-toggle:hover {
            color: #f2f2f2;
            transform: scale(1.1);
        }

        .hero-section {
            background: linear-gradient(rgba(26, 32, 44, 0.85), rgba(26, 32, 44, 0.95)), url('images/hero-background.jpg');
            background-size: cover;
            background-position: center;
            padding: 80px 20px;
            text-align: center;
            color: white;
        }

        .search-form {
            position: absolute;
            left: 30px;
            top: 50%;
            transform: translateY(-50%);
            gap: 15px;
            align-items: center;
            z-index: 0;
        }

        .search-form input[type="text"] {
            padding: 9px 8px;
            font-size: 17px;
            border: none;
            border-radius: 6px;
            outline: none;
            background-color: #3b485b;
            color: #f0f0f0;
            margin-right: 10px;
        }

        .search-form input[type="date"], .search-form button{
            padding: 10px 10px;
            font-size: 15px;
            border: none;
            border-radius: 6px;
            outline: none;
            background-color: #3b485b;
            color: #f0f0f0;
            margin-right: 10px;
        }

        .search-form button:hover {
            background-color: #4a5568;
            color: white;
            cursor: pointer;
            transition: background-color 0.1s, color 0.1s;
        }

        .search-form input[type="date"]:hover {
            cursor: pointer;
        }

        body.light-theme .search-form input[type="text"] {
            background-color: #e2e6ea;
            color: #212529;
        }

        body.light-theme .search-form input[type="date"] {
            background-color: #dadce0;
            color: #212529;
        }

        body.light-theme .search-form button {
            background-color: #dadce0;
            color: #212529;
        }

        body.light-theme .search-form button:hover {
            background-color: #007bff;
            color: white;
            transition: background-color 0.1s, color 0.1s;
        }

        .hero-section h1 {
            font-size: 3em;
            margin-bottom: 20px;
            font-weight: 700;
            color: #a3bfd9;
        }

        .hero-section p {
            font-size: 1.2em;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            color: #cbd5e0;
        }

        .cta-button {
            background-color: #615bb1;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.2s;
            display: inline-block;
            box-shadow: 0 4px 10px rgba(97, 91, 177, 0.4);
        }

        .cta-button:hover {
            background-color: #4e488e;
            transform: translateY(-3px);
        }

        .features-section {
            padding: 60px 20px;
            text-align: center;
        }

        .features-section h2 {
            font-size: 2.5em;
            margin-bottom: 15px;
            color: #e2e8f0;
        }
        .features-section .section-subtitle {
            font-size: 1.1em;
            color: #a0aec0;
            margin-bottom: 50px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-box {
            background-color: #2d3748;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        .feature-box .icon {
            font-size: 3em;
            color: #8db1da;
            margin-bottom: 20px;
        }

        .feature-box h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #e2e8f0;
        }

        .feature-box p {
            font-size: 1em;
            color: #cbd5e0;
        }

        hr {
            border: 0;
            height: 1px;
            width: 100%;
            background-color: #4a5568;
            margin-top: 40px;
            margin-bottom: 0;
        }

        .footer {
            font-size: 0.9em;
            width: 100%;
            color: #a0aec0;
            text-align: center;
            text-decoration: none;
            padding: 25px 0;
            margin-top: auto;
        }

        body.light-theme {
            background-color: #f8f9fa;
            color: #212529;
        }

        body.light-theme .topnav {
            background-color: #e9ecef;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        body.light-theme .topnav .brand {
            color: #0056b3;
        }

        body.light-theme .topnav a:not(.login-signup-link, .logout-link) {
            color: #343a40;
        }

        body.light-theme .topnav a:not(.login-signup-link, .logout-link):hover {
            background-color: #007bff;
            color: white;
        }

        body.light-theme .topnav a.active {
            background-color: #007bff;
            color: white;
            font-weight: 600;
        }

        body.light-theme .login-signup-link,
        body.light-theme .logout-link {
            background-color: #007bff;
            color: white;
        }

        body.light-theme .login-signup-link:hover,
        body.light-theme .logout-link:hover {
            background-color: #0056b3;
        }

        body.light-theme #theme-toggle {
            color: #0056b3;
        }
        body.light-theme #theme-toggle:hover {
            color: #007bff;
            transform: scale(1.1);
        }

        body.light-theme .hero-section {
            background: linear-gradient(rgba(248, 249, 250, 0.85), rgba(248, 249, 250, 0.95)), url('images/hero-background-light.jpg');
            background-size: cover;
            background-position: center;
            color: #212529;
        }
        body.light-theme .hero-section h1 {
            color: #0056b3;
        }
        body.light-theme .hero-section p {
            color: #495057;
        }
        body.light-theme .cta-button {
            background-color: #007bff;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
        }
        body.light-theme .cta-button:hover {
            background-color: #0056b3;
        }

        body.light-theme .features-section h2 {
            color: #212529;
        }
        body.light-theme .features-section .section-subtitle {
            color: #6c757d;
        }
        body.light-theme .feature-box {
            background-color: #ffffff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        body.light-theme .feature-box:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        body.light-theme .feature-box .icon {
            color: #007bff;
        }
        body.light-theme .feature-box h3 {
            color: #343a40;
        }
        body.light-theme .feature-box p {
            color: #495057;
        }

        body.light-theme hr {
            background-color: #dee2e6;
        }

        body.light-theme .footer {
            color: #6c757d;
        }

        @media (max-width: 768px) {
            .topnav .brand {
                font-size: 20px;
            }
            .topnav a:not(.login-signup-link, .logout-link) {
                padding: 15px 10px;
                font-size: 15px;
            }
            .login-signup-link, .logout-link {
                padding: 8px 12px;
                font-size: 14px;
            }
            #theme-toggle {
                font-size: 20px;
            }
            .hero-section h1 {
                font-size: 2.5em;
            }
            .hero-section p {
                font-size: 1em;
            }
            .features-section h2 {
                font-size: 2em;
            }

            @media (max-width: 500px) {
                .topnav {
                    justify-content: space-between;
                    flex-wrap: wrap;
                    padding: 10px;
                }

                .topnav .brand {
                    position: static;
                    transform: none;
                    padding: 10px 0;
                    font-size: 18px;
                }

                .nav-links-group {
                    display: flex;
                    width: 100%;
                    justify-content: space-around;
                    margin-top: 10px;
                }

                .nav-links-group a:not(.login-signup-link, .logout-link) {
                    padding: 10px;
                    font-size: 15px;
                }

                .topnav-right-items {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    margin-top: 10px;
                }

                .topnav-right-items a.login-signup-link,
                .topnav-right-items a.logout-link {
                    white-space: nowrap;
                    font-size: 14px;
                    padding: 8px 12px;
                }

                #theme-toggle {
                    font-size: 18px;
                }
            }
        }
    </style>
</head>
<body>
    <div class="topnav">
        <form class="search-form" method="GET" action="search.php">
            <input type="text" name="q" placeholder="Αναζήτηση...">
            Από: <input type="date" name="date_from">
            Έως: <input type="date" name="date_to">
            <button type="submit">Αναζήτηση</button>
        </form>

        <div class="nav-links-group">
            <a class="active" href="index.php">Αρχική</a>
            <a href="help.php">Βοήθεια</a>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="goal_sign_up.html">Σκοπός & Εγγραφή</a>
            <?php endif; ?>
        </div>
        <div class="nav-links-group-user">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="create_playlist.php">Δημιουργία Λίστας</a>
                <a href="followed_playlists.php">Ακολουθούμενοι</a>
                <a href="my_playlists.php">Οι Λίστες μου</a>
            <?php endif; ?> 
        </div>
        <div class="topnav-right-items">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="profile.php" class="profile-link">Προφίλ</a>
                <a href="logout.php" class="logout-link">Αποσύνδεση</a>
            <?php else: ?>
                <a href="sign_up_log_in.php" class="login-signup-link">Σύνδεση/Εγγραφή</a>
            <?php endif; ?>
            <button id="theme-toggle" title="Εναλλαγή θέματος">
                <i class="fa fa-sun-o" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <main>
        <section class="hero-section">
            <div class="container">
                <h1>Οργανώστε τις Αγαπημένες σας Στιγμές</h1>
                <p>Δημιουργήστε, διαχειριστείτε και μοιραστείτε τις προσωπικές σας λίστες αναπαραγωγής βίντεο από το YouTube εύκολα και γρήγορα. Ξεκινήστε την εμπειρία σας σήμερα!</p>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="sign_up_log_in.php" class="cta-button">Ξεκινήστε Τώρα!</a>
                <?php else: ?>  
                    <?php if ($_SESSION['user_id'] == 12 || $_SESSION['user_id'] == 13 || $_SESSION['user_id'] == 16): ?>
                        <a href="export.php" class="cta-button"> Export Lists </a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </section>

        <section class="features-section">
            <div class="container">
                <h2>Ανακαλύψτε τις Δυνατότητες</h2>
                <p class="section-subtitle">Η πλατφόρμα μας σας προσφέρει όλα τα εργαλεία για να απογειώσετε την εμπειρία σας με τις λίστες περιεχομένου ροής.</p>
                <div class="features-grid">
                    <div class="feature-box">
                        <div class="icon"><i class="fa fa-list-alt"></i></div>
                        <h3>Δημιουργία Λιστών</h3>
                        <p>Φτιάξτε απεριόριστες λίστες με τα αγαπημένα σας βίντεο, οργανωμένες ακριβώς όπως τις θέλετε.</p>
                    </div>
                    <div class="feature-box">
                        <div class="icon"><i class="fa fa-lock"></i> / <i class="fa fa-globe"></i></div>
                        <h3>Ιδιωτικές & Δημόσιες</h3>
                        <p>Επιλέξτε ποιες λίστες θα είναι ορατές μόνο σε εσάς και ποιες θα μοιραστεί
σετε με τον κόσμο ή τους φίλους σας.</p>
                    </div>
                    <div class="feature-box">
                        <div class="icon"><i class="fa fa-users"></i></div>
                        <h3>Ακολουθήστε Άλλους</h3>
                        <p>Ανακαλύψτε και ακολουθήστε άλλους χρήστες για να βλέπετε τις δημόσιες λίστες τους απευθείας στο προφίλ σας.</p>
                    </div>
                     <div class="feature-box">
                        <div class="icon"><i class="fa fa-youtube-play"></i></div>
                        <h3>Άμεση Αναπαραγωγή</h3>
                        <p>Δείτε τα βίντεο από τις λίστες σας (ή όσων ακολουθείτε) απευθείας μέσα από την πλατφόρμα μας.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <hr>
    <footer class="footer">
        Τεχνολογίες Διαδικτύου - Εργασία 2025 - Ιόνιο Πανεπιστήμιο, Τμήμα Πληροφορικής
    </footer>

    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const body = document.body;
        const themeIcon = themeToggleBtn.querySelector('i');

        function setTheme(theme) {
            body.classList.remove('light-theme', 'dark-theme');
            themeIcon.classList.remove('fa-sun-o', 'fa-moon-o');

            if (theme === 'light') {
                body.classList.add('light-theme');
                themeIcon.classList.add('fa-moon-o');
                localStorage.setItem('theme', 'light');
                themeToggleBtn.title = "Εναλλαγή σε σκούρο θέμα";
            } else {
                body.classList.add('dark-theme');
                themeIcon.classList.add('fa-sun-o');
                localStorage.setItem('theme', 'dark');
                themeToggleBtn.title = "Εναλλαγή σε ανοιχτό θέμα";
            }
        }

        const currentTheme = localStorage.getItem('theme');
        setTheme(currentTheme || 'dark');

        themeToggleBtn.addEventListener('click', () => {
            const newTheme = body.classList.contains('light-theme') ? 'dark' : 'light';
            setTheme(newTheme);
        });
    </script>
</body>
</html>
