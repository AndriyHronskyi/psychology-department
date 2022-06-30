<?php
require ('dbconfig.php');
include('pageParts.php');



if ($_POST['register']) {
    header("Location: /registration.php"); 
}

if ($_POST['Enter']) {
    $login = $_POST['loginS'];
    $password = $_POST['Password'];
    $getSpecialistLogins = mysqli_query($db, "SELECT * FROM adminusers ORDER BY adminusers.id");

    $errormsg;

    //перевірка логінів
    while ($bbb=mysqli_fetch_row($getSpecialistLogins)) {
        if ($bbb[1] == $login && $bbb[2] == $password) {
            //все ок
            setcookie("login",$login,time() + 18000, "/");
            header("Location: adminPanel.php");
        }else{
            if ($bbb[1] != $login || $bbb[2] != $password) {
                if ($bbb[1] != $login) {
                    $errormsg = 'Неправильний логін';
                }elseif ($bbb[2] == $password) {
                    $errormsg = 'Неправильний пароль';
                }
            }
        }
    }
}

if (!empty($_COOKIE["login"])) {
    if(isset($_POST['exit'])){
        unset($_COOKIE["login"]);
        
        if (!empty($_SESSION)) {
            // remove all session variables
        session_unset();
    
        // destroy the session
        session_destroy();
        }
        
    }else {
        header("Location: adminPanel.php");
        exit;
    }
    
}



$getSpecialistLogins = mysqli_query($db, "SELECT * FROM adminusers ORDER BY adminusers.id");
$errormsg ='';

?>
<head>
    <?php 
        styleSheetConnect('Авторизація','/PanelAdmins/login.css');;
    ?>
</head>
<body>
    <div class="Main">
        <?php //header
            makeHeader(2,'Авторизація');?>    
        <div class="container-1">
            <form method="POST" action="login.php" class="login-form">
                <?php
                if ($errormsg) {
                    echo"$errormsg";
                }
                ?>
                <select name="loginS"> 
                <?php
                
                while ($bbb=mysqli_fetch_row($getSpecialistLogins)) 
                {
                    echo"
                    <option value='$bbb[1]'>$bbb[1]</option>
                    ";
                }
                ?>
                </select><br>
                <input name="Password" type="password" value='' class="EField"> <br>
                    <input name="Enter" type="submit" value="Вхід" id="enter">
                <h4 class="discribe">Для отримання паролю, співробітникам <br>Психологічної служби ВНТУ, <br>потрібно завершити реєстрацію:</h4>
                    <input name="register" id="register"  type="submit" value="Реєстрація">
            </form>
        </div>
    </div>
    
    <?php 
    makeFooter();  //footer
    ?>
        
</body>