<?php
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        session_start();
        if(isset($_SESSION["USER_ID"])){
            session_unset();
            session_destroy();
        }
        
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){
        $userNick = $_POST["userNick"];
        $userPass = $_POST["userPassword"];
        $query = "select * from users where userNick = '".$userNick."';";//check if in users table

        try{
            $db_connect = mysqli_connect("localhost", "root", "pass", "plkryptydy");
            if($db_connect->connect_error){
                die($db_connect->connect_error);
            }
            $result = $db_connect->query($query);
            if($result->num_rows == 1){
                $user = $result->fetch_assoc();
                if(password_verify($userPass, $user["userPassword"])){
                    if(session_status() !== PHP_SESSION_ACTIVE){
                        session_start();
                        $_SESSION["USER_ID"] = $user["userId"];
                        $_SESSION["USER_NICK"] = $user["userNick"];
                        $_SESSION["USER_AVATAR_PATH"] = $user["userAvatarPath"];
                        
                        header("Location: userPage.php");
                    }
                }
            }
            else{
                throw new Exception('User not found');
            }
        }
        catch(Exception $e){
            
        }
        
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Polskie Kryptydy</title>
        <link rel="stylesheet" href="../styles/mainStyle.css"/>
        <script type="text/javascript" src="../scripts/loginPage.js"></script>
    </head>
    <body>
        <div class="banner">
            <a href="http://localhost/strona/index.php">PolskieKryptydy</a>
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
        <div class="login-window">
            <div class="section-dark">
                <h2>Zaloguj/Zarejestruj się</h2>
            </div>
            <div class="section-darker" id="loginWindow">
                <div id="login-div">
                    <h2>Zaloguj się</h2>
                    <form id="form-login" action="login.php" method="POST">
                        <input type="text" name="userNick" placeholder="Nazwa użytkownika"/><br>
                        <input type="password" name="userPassword" placeholder="Hasło"/><br>
                        <button type="submit">Zaloguj</button>
                    </form>
                </div>
                <div>
                    <h2>Zarejestruj się</h2>
                    <form id="form-register" action="../scripts/login.php" method="POST">
                        <input type="text" name="userName" maxlength="30" placeholder="Imię" oninput="checkNamesOnInput(0)"/><br>
                        <input type="text" name="userSurname" maxlength="30" placeholder="Nazwisko" oninput="checkNamesOnInput(1)"/><br><br>
                        <input type="tel" name="userPhone" maxlength="9" placeholder="Telefon" oninput="checkPhoneNumberOnInput()"/><br>
                        <input type="email" name="userEmail" maxlength="50" placeholder="Adres e-mail"/><br><br>
                        <input type="text" name="userNick" maxlength="50" placeholder="Nazwa użytkownika"/><br>
                        <input type="password" name="userPassword" maxlength="100" placeholder="Hasło"/><br>
                    </form>
                    <br></br>
                    <button onclick="checkRegistrationForm()">Zarejestruj</button>
                    
                </div>
            </div>
            
        </div>
    </body>
</html>