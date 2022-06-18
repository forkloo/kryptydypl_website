<html>
    <head>
        <meta charset="UTF-8">
        <title>Glosariusz Kryptyd</title>
        <link rel="stylesheet" href="styles/mainStyle.css"/>
        <script type="text/javascript" src="lib/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="scripts/viewportController.js"></script>
    </head>
    <body id="top">
        <div class="bg"></div>
        <div class="banner">
            <a href="#top" id="home-button">Strona Główna</a>
            <a href="#newest-marker">Najnowsze</a>
            <?php
                if(session_status() !== PHP_SESSION_ACTIVE){
                    session_start();
                }
                if(!isset($_SESSION["USER_ID"])){
                    echo "<a href='subsites/login.php' id='loginButton'>
                    Zaloguj się
                    <p id='userPhoto'></p>
                    </a>";
                }
                else{
                    echo "<a href='subsites/userPage.php' id='loginButton'>".$_SESSION["USER_NICK"];
                    if(file_exists($_SESSION["USER_AVATAR_PATH"])){
                        echo "<img href='".$_SESSION["USER_AVATAR_PATH"]."'/>";
                    }
                    else{
                        echo "<p id='userPhoto'></p>";
                    }
                    echo "</a>";
                }
                
            ?>
        </div>
        
        <div class="main" id="newest-marker">
            <div class="content-window">
                <div class="section-dark">
                    <div class="welcome">
                        <h1>kryptydy.pl</h1>
                        <h2>Polski glosariusz kryptyd online</h2>
                    </div>
                </div>
                
                <div class="section-darker" id="newest">
                    <h2>
                        Niedawno edytowane artykuły
                    </h2>
                    <div class="article">
                        <h3>
                            Lądowanie UFO w Brzostku
                        </h3>
                        <span>
                            Ufo wylądowało w Brzostku zaraz po postawieniu pierwszego paczkomatu. Inpost odmawia składania wyjaśnień.
                        </span>
                        <p class="editor-data">
                            użytkownik <i>wybitnyZiomek32pl</i> edytował 2020-03-17 16:19
                        </p>
                    </div>
                    <div class="article">
                        <h3>
                            Zygmunt, człowiek dzwon
                        </h3>
                        <span>
                            Młody Zygmunt, w wieku 10 lat uderzył głową w Dzwon Zygmunta. Drgania Dzwonu [...]
                        </span>
                        <p class="editor-data">
                            użytkownik <i>wybitnyZiomek32pl</i> edytował 2020-03-17 16:19
                        </p>
                    </div>
                </div>
                <p class="editor-data">
                    Polskie Stowarzyszenie Fanów Adama Małysza | Skalna 2022
                </p>
            </div>
        </div>
    </body>
</html>