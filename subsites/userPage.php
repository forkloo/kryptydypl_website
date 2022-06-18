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
                    <h2 id="articleTitle">
                    <?php
                    if(isset($_SESSION["USER_NICK"])){
                        echo "Panel użytkownika - ".$_SESSION["USER_NICK"];
                    }
                    else{
                        echo "BŁĄD - UŻYTKOWNIK NIEZALOGOWANY";
                    }
                    ?></h2>
                    </h2>
                    <?php
                        if(file_exists($_SESSION["USER_AVATAR_PATH"])){
                            echo "<img id='userPhoto' href='".$_SESSION["USER_AVATAR_PATH"]."'/>";
                        }
                        else{
                            echo "<p id='userPhoto'></p>";
                        }
                        echo "</a>";
                    ?>
                </div>
                <div class="section-darker">
                    <?php
                        if(isset($_SESSION["USER_NICK"])){
                            try{
                                $db_connect = mysqli_connect("localhost", "root", "pass", "plkryptydy");
                                if($db_connect->connect_error){
                                    die($db_connect->connect_error);
                                }
                                $query = "select * from users where userId = ".$_SESSION["USER_ID"];
                                $result = $db_connect->query($query);
                                if($result->num_rows == 1){
                                    $user = $result->fetch_assoc();
                                    
                                    echo "<p class='article-content' id='articleText'>Imię i Nazwisko: ".$user["userName"]." ".$user["userSurname"]."<br>".
                                        "Adres e-mail: ".$user["userMail"]."<br>".
                                        "Numer telefonu: ".$user["userPhone"]."</p>";
                                }
                                else{
                                    throw new Exception('User not found');
                                }
                            }
                            catch(Exception $e){
                                
                            }
                            
                            echo "<form action='login.php' method='get'>";
                            echo "<input type='submit' value='Wyloguj'></input>";
                            echo "</form>";
                        }
                    ?>
                </div>
                </div>
                <p class="editor-data">
                    Polskie Stowarzyszenie Fanów Adama Małysza | Skalna 2022
                </p>
            </div>
        </div>
    </body>
</html>

