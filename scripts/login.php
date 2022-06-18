<head>
    <meta charset="UTF-8">
    <title>Glosariusz Kryptyd</title>
    <link rel="stylesheet" href="../styles/mainStyle.css"/>
    <style>
        div{
            color: white;
        }
        h2{
            font-size: 32pt;
        }
        #err{
            color: #aa2222;
        }

        div .section-darker{
            min-height: 0px;
            padding: 5% 0%;
            height: 20px;
        }
        a{
            margin-top: 15%;
            margin-left: 2%;
            font-size: 16pt;
        }

        
    </style>
</head>
<div class="bg"></div>
<div class="banner">
    <a href="../index.php" id="home-button">Strona Główna</a>
    <a href="../index.php">Najnowsze</a>
    <a href="../subsites/login.php" id="loginButton">
    Zaloguj się
    <p id="userPhoto"></p>
    </a>
</div>
<div class="login-window">
    <div class="section-dark">
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            try{
                $passwordHash = password_hash($_POST['userPassword'], PASSWORD_DEFAULT);
                $query = "insert into users (userName, userSurname, userPhone, userMail, userNick, userPassword) values ('".$_POST['userName']."','".$_POST['userSurname']."','".$_POST['userPhone']."','".$_POST['userEmail']."','".$_POST['userNick']."','".$passwordHash."')";

                $db_connect = mysqli_connect("localhost", "root", "InIkzok32!") or die($db_connect);
                mysqli_select_db($db_connect, "plkryptydy");
                mysqli_set_charset($db_connect, "utf8");

                $result = mysqli_query($db_connect, $query) or die(mysqli_error($db_connect));

                echo "<h2>Rejestracja pomyślna</h2></div>";
            }
            catch(Exception $e){
                echo "<h2 id='err'>WYSTĄPIŁ BŁĄD</h2></div>";
                echo "<div class='section-darker'>";
                switch($e->GetCode()){
                    case 1062: //duplikat
                        $dupliKey = $e->GetMessage();
                        $dupliKey = substr($dupliKey, strpos($dupliKey, "users")+10);
                        $dupliKey = substr($dupliKey, 0, strlen($dupliKey)-8);
                        echo "<a>Isnieje konto z takim samym ";
                        switch($dupliKey){
                            case "Phone":
                                echo "numerem telefonu. <i id='err'>(".$_POST['userPhone'].")";
                                break;
                            case "Mail":
                                echo "adresem e-mail. <i id='err'>(".$_POST['userEmail'].")";
                                break;
                            case "Nick":
                                echo "nickiem. <i id='err'>(".$_POST["userNick"].")";
                                break;
                        }
                        echo "</i></a>";
                        break;
                    default:
                        echo "Wystąpił nieznany błąd.";
                        break;
                }
                echo "</div>";
            }
            mysqli_close($db_connect);
        }
    ?>
    </div>
</div>