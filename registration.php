<?php
require 'dbconfig.php';
include('pageParts.php');
$getSpecialistLogins = mysqli_query($db, "SELECT * FROM specialists ORDER BY specialists.id");

if ($_POST['register']) {
    $login = $_POST['email'];
    $password = $_POST['password'];

    while ($bbb=mysqli_fetch_row($getSpecialistLogins)) 
    {
        if ($bbb[8] == $login) {
            $id = $bbb[0];
            $sqlValues = "('".$login."','".$password."','".$id."')";
            $querry = "INSERT INTO adminusers(login,password,id_specialist) VALUES".$sqlValues;

            if (mysqli_query($db,$querry)) {
                header("Location: /login.php");
            }else {
                echo "Db error!! Sql querry error";
            }
        }
    }
}
?>
<head>
    <?php 
        styleSheetConnect('Реєстрація','/PanelAdmins/registration.css');;
    ?>
</head>
<body>
    <div class="Main">
            <?php //header
            makeHeader(0,'Реєстрація');?>     
        <div class="container-1">
            <form method="POST" action="registration.php" class="login-form">
                <select name="loginS" onclick="emailSet()" id="loginS" required>
                    
                <?php $getAdminLogins = mysqli_query($db, "SELECT * FROM adminusers ORDER BY adminusers.id");
                        $ID = array();
                        while ($aaa = mysqli_fetch_row($getAdminLogins)) {  //перевіряємо які логіни вже зареєстровані
                            array_push($ID, $aaa[1]);
                        }
                        
                    while ($bbb=mysqli_fetch_row($getSpecialistLogins)) {
                        if (in_array($bbb[8],$ID)) {
                            /*такий логін вже є в базі, тому його не показуєм*/
                        }else {
                            echo"
                                <option value='$bbb[8]'>$bbb[1] $bbb[2] $bbb[3]</option>
                            ";
                        }
                    }?>
                    
                </select>

                <h4 class='discribe'>Ваша пошта для входу:</h4>
                 <input name='email' type='email' id='email' value='' class='EField' required readonly>
                 <br>
                    <h4 class="discribe"  style="padding-left: 0px;">Для завершення реєстрації створіть пароль</h4>
                    <h4 class="discribe">Введіть новий пароль:</h4>
                <input name="password" type="password" value='' class="EField" id="p1" required> 
                    <h4 class="discribe"  style="margin-top: 0px;">Повторно введіть пароль:</h4>
                        <p id="alert">Пароль введено невірно:</p>
                <input name="password" type="password"  value='' class="EField"id="p2" required> 
                
                <input name="register" id="register" onClick="check()" type="submit" value="Реєстрація">
            </form>
        </div>
    </div>

    <?php 
    makeFooter();  //footer
    ?>
</body>
<script>
    function emailSet() {
        document.getElementById('email').value = document.getElementById('loginS').value;
    }
    function check() {

        if (document.getElementById('p1').value == document.getElementById('p2').value && document.getElementById('p1').value != 0) {
            alert('Пароль введено вірно');
            document.getElementById('register').type = 'submit';
            
            }else{
                var form = document.forms[0];
                form.reset();
                document.getElementById('alert').style.display = 'block';
                document.getElementById('alert').style.font = '800 14px tomato';
                //document.getElementById('alert').style.color = 'tomato';
            }
        
    }

</script>


