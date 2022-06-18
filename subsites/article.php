<?php
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Polskie Kryptydy</title>
        <link rel="stylesheet" href="../styles/mainStyle.css"/>
        <script type="text/javascript" src="../scripts/articleView.js"></script>
    </head>
    <body>
        <div class="bg"></div>
        <div class="banner">
            <a href="../index.php" id="home-button">Strona Główna</a>
            <a href="../index.php#newest-marker">Najnowsze</a>
            
            <?php
                if(!isset($_SESSION["USER_ID"])){
                    echo "<a href='login.php' id='loginButton'>
                    Zaloguj się
                    <p id='userPhoto'></p>
                    </a>";
                }
                else{
                    echo "<a href='userPage.php' id='loginButton'>".$_SESSION["USER_NICK"];
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
        
        <div id="popular"></div>
        <div class="main">
            <div class="content-window">
                <div class="section-dark">
                    <h2 id="articleTitle"></h2>
                    <p class="editor-data" id="editData">aaa</p>
                </div>
                <div class="section-darker">
                    <div class="additional-photos">
                    </div>
                    <p class="article-content" id="articleText">
                </div>
                <div class="section-dark">
                    <h2>Komentarze</h2>
                    <div class="comment-section" id="articleComments">

                    </div>
                </div>
                <p class="editor-data">
                    Polskie Stowarzyszenie Fanów Adama Małysza | Skalna 2022
                </p>
            </div>
        </div>
    </body>
</html>