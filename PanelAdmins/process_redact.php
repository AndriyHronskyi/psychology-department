
<?php
require 'dbconfig.php';

function checkPostsDb($type, $db){
    switch ($type) {
        case 'news':
            $check = mysqli_query($db, "SELECT * FROM news ORDER BY news.id DESC");
        break;
        case 'plans':
            $check = mysqli_query($db, "SELECT * FROM plans ORDER BY plans.id DESC");
        break;
        case 'laws':
            $check = mysqli_query($db, "SELECT * FROM laws ORDER BY laws.id DESC");
        break;
        case 'info':
            $check = mysqli_query($db, "SELECT * FROM info ORDER BY info.id DESC");
        break;
        case 'research':
            $check = mysqli_query($db, "SELECT * FROM research ORDER BY research.id DESC");
        break;
        case 'basicProvisions':
            $check = mysqli_query($db, "SELECT * FROM aboutus ORDER BY aboutus.id DESC");
        break;
        case 'activities':
            $check = mysqli_query($db, "SELECT * FROM aboutusph ORDER BY aboutusph.id DESC");
        break;
    }

    return $check;
}

function choosePostId($check, $type){
    switch ($type) {
        case 'laws':
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
            <h3 class="subTitle">Редагування</h3>
            <p>Оберіть нормативний документ для редагування:</p>
            <select name = "redpost" require>
                <table class= 'tbldel'>
                <option value="">
                    <tr class= 'deltitlepanel'>
                        <td></td>
                        <td>Заголовок</td>
                        <td>Назва файлу</td>
                        <td>Дата публікації</td>
                    </tr>
                </option>
                <?php
                $io = 0; 
                while ($red=mysqli_fetch_row($check))
                {  
                    $io++;
                    echo"
                    <option id='$red[0]' value= '$red[0]'>
                    <tr class= 'delOtherPanel'>                  
                        <td><p>$io</p></td>
                        <td><p>$red[2]</p></td>
                        <td><p>$red[4]</p></td>      
                    </tr>
                    </option>
                    ";                                                  
                }
                ?>
                </table>
            </select>
                <?php echo"<input type='hidden' name='redtype' value=$type>";?>
                <br>
                <a class='cancel' href="adminPanel.php">Скасувати</a>
                <input type="submit" class="submitBtn" name="redpostresult" value="Редагувати">
            </form>
            <?php 
        break;
    
        case 'plans':
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
            <h3 class="subTitle">Редагування</h3>
            <p>Оберіть план заходів для редагування:</p>
            <select name = "redpost" require>
                <table class= 'tbldel'>
                <option value="">
                    <tr class= 'deltitlepanel'>
                        <td></td>
                        <td>Півріччя</td>
                        <td>Навчальний рік</td>
                    </tr>
                </option>
                <?php
                $io = 0; 
                while ($red=mysqli_fetch_row($check))
                {  
                    $io++;

                    //Формування інформації для переліку навчальних планів
                    $nextY = $red[3];
                    $nextY += 1;
                    if ($red[4] == 1) {
                        $pYear = 'Перше';
                    }else {
                        $pYear = 'Друге';
                    }
                    $subTitle = "$pYear півряччя $red[3]/$nextY р";
                
                    //Назва 
                    echo"
                    <option id='$red[0]' value= '$red[0]'>
                    <tr class= 'delOtherPanel'>                  
                        <td><p>$subTitle</p></td>       
                    </tr>
                    </option>
                    ";                                                  
                }
                ?>
                </table>
            </select>
                <?php echo"<input type='hidden' name='redtype' value=$type>";?>
                <br>
                <a class='cancel' href="adminPanel.php">Скасувати</a>
                <input type="submit" class="submitBtn" name="redpostresult" value="Редагувати">
            </form>
            <?php 
        break;

        case 'basicProvisions':
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
            <h3 class="subTitle">Редагування</h3>
            <p>Оберіть положення для редагування:</p>
            <select name = "redpost" require>
                <table class= 'tbldel'>
                <option value="">
                    <tr class= 'deltitlepanel'>
                        <td></td>
                        <td>Заголовок</td>
                        <td>Пункт 1</td>
                        <td>Пункт 2</td>
                        <td>...</td>
                    </tr>
                </option>
                <?php
                $io = 0; 
                while ($red=mysqli_fetch_row($check))
                {  
                    $io++;
                    $ttext0 = strip_tags($red[1]);
                        $ttext0 = str_split($ttext0,50);
                    $ttext1 = strip_tags($red[2]);
                        $ttext1 = str_split($ttext1,25);
                    $ttext2 = strip_tags($red[3]);
                        $ttext2 = str_split($ttext2,25);
    
                    echo"
                    <option id='$red[0]' value= '$red[0]'>
                    <tr class= 'delOtherPanel'>                  
                        <td><p>$io</p></td>
                        <td><p>$ttext0[0] |</p></td>
                        <td><p>$ttext1[0] |</p></td>
                        <td><p>$ttext2[0]</p></td>      
                    </tr>
                    </option>
                    ";                                                  
                }
                ?>
                </table>
            </select>
                <?php echo"<input type='hidden' name='redtype' value=$type>";?>
                <br>
                <a class='cancel' href="adminPanel.php">Скасувати</a>
                <input type="submit" class="submitBtn" name="redpostresult" value="Редагувати">
            </form>
            <?php 
        break;

        case 'activities':
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
            <h3 class="subTitle">Редагування</h3>
            <p>Оберіть публікацію для редагування:</p>
            <select name = "redpost" require>
                <table class= 'tbldel'>
                <option value="">
                    <tr class= 'deltitlepanel'>
                        <td></td>
                        <td>Заголовок</td>
                        <td>Назва файлу</td>
                    </tr>
                </option>
                <?php
                $io = 0; 
                while ($red=mysqli_fetch_row($check))
                {  
                    $io++;
                    $ttext0 = strip_tags($red[1]);
                    $ttext0 = str_split($ttext0,50);
                    echo"
                    <option id='$red[0]' value= '$red[0]'>
                    <tr class= 'delOtherPanel'>                  
                        <td><p>$io</p></td>
                        <td><p>$ttext0[0]</p></td>
                        <td><p>$red[2]</p></td>   
                    </tr>
                    </option>
                    ";                                                  
                }
                ?>
                </table>
            </select>
                <?php echo"<input type='hidden' name='redtype' value=$type>";?>
                <br>
                <a class='cancel' href="adminPanel.php">Скасувати</a>
                <input type="submit" class="submitBtn" name="redpostresult" value="Редагувати">
            </form>
            <?php 
        break;

        default:
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
            <h3 class="subTitle">Редагування</h3>
            <p>Оберіть публікацію для редагування:</p>
            <select name = "redpost" require>
                <table class= 'tbldel'>
                <option value="">
                    <tr class= 'deltitlepanel'>
                        <td></td>
                        <td>Заголовок</td>
                        <td>Текст</td>
                        <td>Назва файлу</td>
                        <td>Дата публікації</td>
                    </tr>
                </option>
                <?php
                $io = 0; 
                while ($red=mysqli_fetch_row($check))
                {  
                    $io++;
                    $ttext = strip_tags($red[2]);
                    $ttext = str_split($ttext,50);
    
                    echo"
                    <option id='$red[0]' value= '$red[0]'>
                    <tr class= 'delOtherPanel'>                  
                        <td><p>$io</p></td>
                        <td><p>$red[1]</p></td>
                        <td><p>$ttext[0]</p></td>
                        <td><p>$red[3]</p></td>
                        <td><p>$red[5]</p></td>      
                    </tr>
                    </option>
                    ";                                                  
                }
                ?>
                </table>
            </select>
                <?php echo"<input type='hidden' name='redtype' value=$type>";?>
                <br>
                <input type="submit" class="submitBtn" name="redpostresult" value="Редагувати">
            </form>
            <?php 
        break;
    }  
    
}

//тут все ок
function getPostById($resultId, $type, $db){
    $querry;
    
    switch ($type) {
        case 'news':
            $querry = "SELECT * FROM news WHERE news.id = ".$resultId;      
            break;
        case 'plans':
            $querry = "SELECT * FROM plans WHERE plans.id = ".$resultId;        
            break;
        case 'laws':
            $querry = "SELECT * FROM laws WHERE laws.id = ".$resultId;          
            break;
        case 'info':
            $querry = "SELECT * FROM info WHERE info.id = ".$resultId;         
            break;
        case 'research':
            $querry = "SELECT * FROM research WHERE research.id = ".$resultId;         
            break; 
        case 'basicProvisions':
            $querry = "SELECT * FROM aboutus WHERE aboutus.id = ".$resultId;         
        break; 
        case 'activities':
            $querry = "SELECT * FROM aboutusph WHERE aboutusph.id = ".$resultId;         
        break;
    }

    $getPostByID = mysqli_query($db,$querry);
    return $getPostByID;
    // $getPostByID = mysqli_query($db,$querry);
    // if ($getPostByID) {
    //     //-----------
    //     $successmsg .= "Post ".$type."WHERE ID = ".$result." are got for redact Successfully"."<br>";
    //     return $getPostByID;
    // }else {
    //     $errormsg = " Database Error";
    //     echo $errormsg;
    // }
    
}

//For Specialists (process-specialists.php)

function chooseSpecialistsId($check){
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">

    <h3 class="subTitle">Редагування</h3>    <!--Привести впорядок-->
    <p>Оберіть працівника для редагування:</p>

    <select name = "redSpecialist" require>
        <table class= 'tbldel'>
        <?php

            echo"
                <option id='$red[0]' value= '$red[0]'>
                <tr class= 'delOtherPanel'>                  
                    <td><p>...</p></td>      
                </tr>
                </option>
            "; 

        $io = 0; 
        while ($red=mysqli_fetch_row($check))
        {  
            $io++;
            echo"
            <option id='$red[0]' value= '$red[0]'>
            <tr class= 'delOtherPanel'>                  
                <td><p>$io</p></td>
                <td><p>$red[2]</p></td>
                <td><p>$red[1]</p></td>
                <td><p> $red[3] | </p></td>
                <td><p>$red[4]</p></td>      
            </tr>
            </option>
            ";                                                  
        }
        ?>
        </table>
    </select>

        <input type="submit" class="submitBtn" name="redSpecialistResult" value="Редагувати">
    </form>
    <?php
}

function getSpecialistById($redSpecialistId, $db){
    $querry = "SELECT * FROM specialists WHERE specialists.id = ".$redSpecialistId;
    $getSpecialistById = mysqli_query($db,$querry);
    return $getSpecialistById;
}

function delSpecialistsId($check){
    ?>
    <form action="process_specialists.php" method="post" enctype="multipart/form-data">

    <h3 class="subTitle">Видалити</h3>    <!--Привести впорядок-->
    <h3 class="subTitle">Оберіть працівника для видалення:</h3>

    <select name = "delSpecialist" require>        
        <table class= 'tbldel'>
        <option>...</option>
        <?php
        $io = 0; 
        while ($red=mysqli_fetch_row($check))
        {  
            $io++;
            echo"
            <option id='$red[0]' value= '$red[0]'>
            <tr class= 'delOtherPanel'>                  
                <td><p>$io</p></td>
                <td><p>$red[2]</p></td>
                <td><p>$red[1]</p></td>
                <td><p> $red[3] | </p></td>
                <td><p>$red[4]</p></td>      
            </tr>
            </option>
            ";                                                  
        }
        ?>
    </select>
        
        <input type="submit" class="submitBtn" name="delSpecialistResult" value="Видалити">
    </form>
    <?php
}
?>