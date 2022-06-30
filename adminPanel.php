<?php
    session_start();
    //start & autentification
    require 'dbconfig.php';
        
        $Login = $_COOKIE["login"]; 
        if(!$Login){
            header("Location: login.php");
            exit;
        }

        include('pageParts.php');                   //Файл з частинами елементів інтерфейсу   
        include('PanelAdmins/process_redact.php');  //Обробник операцій з редагування постів і профайлів співробітників

?>

<!-- | - start & autentification -->
<head>
    <title>Панель Управління | Психологічна служба ВНТУ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel='shortcut icon' href='Main/LogoPsy.png' type='image/png'>

    <link href='Main/index.css' type='text/css' rel='stylesheet'>
    <link href="PanelAdmins/adminPanel.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="Main">
        <header>
            <div class="container-0">
                <div class="Hhead">
                    <form action="login.php" method="post">
                        <label for='exit'><img src="https://img.icons8.com/fluent-systems-filled/96/000000/exit.png" alt="Вихід"></label>
                        <input type='submit' class="submitBtn" id = 'exit' name='exit' value='exit' />
                    </form>
                </div>
                <div class="Hhead">
                    <a href="adminPanel.php"><h1>Панель управління ресурсу</h1></a>
                </div>
            </div>
        </header>

        <div class="container-1">
            <div class="box-1">
                <?php Sidebar(0,1,$db); //(number of active element on menu , 1-specialist widet ON, connection)?>
            </div>
            <div class="box-2">
                <div class="box-title">
                    <h3>Статті & інформація</h3>
                </div>
                <div class="nContainer">
                    <div class="add-form">
                        <?php if ($_POST['addP']) {
                            ?>
                            <form action="process_posts.php" method="POST" enctype="multipart/form-data">
                                
                                <h1 class="sTitle">Додати публікацію</h1>
                                Виберіть розділ:
                                <select name = "type" require>
                                    <option value= ""></option> 
                                    <option value= "news">Дайджест подій</option>
                                    <option value= "laws">Нормативна база</option>
                                    <option value= "info">Корисна інформація</option>
                                    <option value= "research">Наукові дослідження</option>
                                </select> <br>

                                <!--Тут треба отримати відповідь, який розділ обрано
                                ше можна зробити, шоб цей надпис "Виберіть розділ", замінялась, на обрано розділ:пвапав
                                -->
                                Введіть заголовок:
                                <input type="text" name="newTitle" placeholder="Заголовок"><br>
                                <textarea name= "newText" class="textInput">Введіть текст</textarea><br>
                                <input type="file" name="files[]"><br><br>
                                <a class='cancel' href="adminPanel.php">Скасувати</a>
                                <input type="submit" name="add-post" class="submitBtn" value="Додати пост"><br>

                            </form>
                            <?php
                        }elseif ($_POST['addPlan']) {
                            ?>
                            <form action="process_posts.php" method="POST" enctype="multipart/form-data">
                                
                                <h1 class="sTitle">Додати навчальний план</h1>
                                <input type="hidden" name="type" value="plans">
                                <br>

                                Навчальний рік:
                                <select name="year" id="" require>
                                    <?php
                                        $b= date("Y");
                                        
                                        while ($a <= 10) {
                                            $bb=$b + 1;
                                            echo"<option value='$b'>$b - $bb</option>";
                                            $b += 1;
                                            $a += 1;
                                        }
                                    ?>
                                </select>
                                <br>
                                Півріччя: 
                                <select name="hyear" id="">
                                    <option value='1'>Перше півріччя</option>
                                    <option value='2'>Друге півріччя</option>
                                </select> 
                                <br>
                                <input type="file" name="files[]"><br><br>
                                <a class='cancel' href="adminPanel.php">Скасувати</a>
                                <input type="submit" class="submitBtn" name="add-post" value="Додати навчальний план"><br>

                            </form>
                            <?php
                        }elseif ($_POST['addAboutUs'] || $_POST['addAboutUS'] || $_POST['addAboutUsPH']) {
                                if (!empty($_POST['addAboutUs'])) {
                                    ?>
                                        <form action="adminPanel.php" method="post">
                                        <h1 class="sTitle">Додати на сторінку "Про нас":</h1>
                                            <input type="submit" class="submitBtn" name="addAboutUS" value="Основні положення">
                                            <input type="submit" class="submitBtn" name="addAboutUsPH" value="Напрямки роботи">
                                            <a class='cancel' href="adminPanel.php">Скасувати</a>
                                        </form>
                                    <?php
                                }
                            
                                if ($_POST['addAboutUS']) {
                                    ?>
                                    <form action="process_posts.php" method="post">
                                    <label for="newText">Назва положення: </label>   
                                        <?php echo "<textarea name='newText' id='newText' class='textInputAU' wrap='soft'></textarea><br>";
                                            for ($i=1; $i < 11; $i++) { 
                                                echo"
                                                <label for='newText-$i'>$i-й пункт: </label>
                                                <textarea name='newText-$i' id='newText-$i' class='textInputAU'  wrap='soft'></textarea><br>
                                                ";
                                            }
                                            echo "<input type='hidden' name='type' value='basicProvisions'>";
                                    ?>
                                    <a class='cancel' href="adminPanel.php">Скасувати</a>
                                    <input type="submit" name="add-post" class="submitBtn" value="Додати пост">
                                    </form><?php
                                        
                                }elseif ($_POST['addAboutUsPH']) {
                                    //просто фотки додавати
                                    ?>
                                    <form action="process_posts.php" method="POST" enctype="multipart/form-data">
                                
                                        <h1 class="sTitle">Додати публікацію</h1>
                                        
                                        Введіть заголовок:
                                        <input type="text" name="newTitle" placeholder="Заголовок"><br>
                                        
                                        <input type="file" name="files[]"><br>
                                        
                                        <input type='hidden' name='type' value='activities'>
                                        <a class='cancel' href="adminPanel.php">Скасувати</a>
                                        <input type="submit" name="add-post" class="submitBtn" value="Додати напрямок роботи"><br>
                                    </form>
                                    <?php
                                }
                        }else {
                            ?>
                            <form action="adminPanel.php" method="post">
                                <input type="submit" class="submitBtn" name="addP" value="Нова публікація">
                            </form>
                            <form action="adminPanel.php" method="post">
                                <input type="submit" class="submitBtn" name="addPlan" value="Новий навчальний план">
                            </form>
                            <form action="adminPanel.php" method="post">
                                <input type="submit" class="submitBtn" name="addAboutUs" value="Про нас">
                            </form>
                            <?php
                        }?>
                        
                    </div>
                    <div class="red-form">
                        
                        <!--Вибір розділу для редагування

                            Можна зробити, щоб це все відображало через echo при умові:
                            що $_POST['redType'] ==0
                        -->
                        <?php
                            if (empty($_POST['rtype']) && empty($_POST['redtype'])) {
                                echo"
                                <form action='adminPanel.php' method='POST'>
                                    <h3 class='subTitle'>Редагування</h3>
                                    <select name = 'rtype' require>
                                        <option value= ''></option> 
                                        <option value= 'news'>Дайджест подій</option>
                                        <option value= 'plans'>Плани заходів</option>
                                        <option value= 'laws'>Нормативна база</option>
                                        <option value= 'info'>Корисна інформація</option>
                                        <option value= 'research'>Наукові дослідження</option>
                                        <option value= 'basicProvisions'>Про нас | Основні положення</option>
                                        <option value= 'activities'>Про нас | Напрямки роботи</option>
                                    </select>
                                    <input type='submit' class='submitBtn' name='redType' value='Обрати розділ'><br>
                                </form>
                            ";
                            }else {
                                $RType = $_POST['rtype'];
                                $check;
                                
                            //basic provisions  activities
                            if ($RType) { 
                                $type = $RType;     
                                $check = checkPostsDb($type, $db);
                                
                                choosePostId($check, $type);        // обираємо необхідний пост
                            }

                            $resultId = 0;
                            $getPostById = 0;
                            $type = $_POST['redtype'];        //отримуємо значення типу поста з функції choosePostId(), бо вона оновлює сторінку і 'rtype' вже пустий
                            if ($_POST['redpostresult']) {
                                $resultId = $_POST['redpost'];   //отримуємо Id необхідного поста

                                $getPostById = getPostById($resultId, $type, $db);  // завантажуємо необхідний пост
                            }
                            
                            if ($getPostById) {
                                switch ($type) {
                                    case 'laws':
                                        ?>
                                        <form action="process_posts.php" method="post" enctype="multipart/form-data" class='redForm1'>
                                            <h1 class="sTitle">Редагування публікації:</h1>
                                            <?php
                                            while ($bbb=mysqli_fetch_row($getPostById)) 
                                            {
                                                ?>
                                                <h1 class='sTitle'>
                                                    <?php echo "Розділ: "; 
                                                    sectionNameConvert($type);?>
                                                </h1>
                                                <label for="redText">Опис документу:</label>
                                                <textarea name="redText" id="redText" style="width: 120%; height: 340px;"  wrap="soft"><?php echo "$bbb[1]";?></textarea><br><br>
                                                
                                                <label for="redTitle">Назва файлу: </label>   <!--Прописати назви і підключити до підписів через id-->
                                                <?php echo "<input type='text' name='redTitle' class='EField' id='redTitle' value='$bbb[2]'><br>";?> 
                                                    <?php
                                                    //декодування фотки
                                                    $file = $bbb[3];
                                                    $document = str_replace('data:application/pdf;base64,', '', $file); 
                                                    
                                                        $path = "laws/upload/".$bbb[2];   //назва файлу
                                                        //$path = 'imag.pdf';

                                                        //$path = str_replace('imag' , "$bbb[1]" , $path); 
                                                    
                                                    file_put_contents("$path", base64_decode($document));

                                                    if ($file) {
                                                        echo "<br>";
                                                        echo "<a href='$path'>Переглянути файл</a>";
                                                    }
                                                    echo "<p>Дата публікації: $bbb[4]</p> <br>"; 
                                                    echo "<p>Замінити документ: </p>"; 
                                                    echo "<input type='hidden' name='typeredpost' value=$type>";
                                                    echo "<input type='hidden' name='resultId' value=$resultId>"; 
                                            }?>
                                                <input type="file" name="files[]"> <br><br>  
                                                <a class='cancel' href="adminPanel.php">Скасувати</a>
                                                <input type="submit" class="submitBtn" name="red-post" value="Внести зміни">
                                        </form><?php
                                    break;
                                    
                                    case 'plans':
                                        ?>
                                        <form action="process_posts.php" method="post" enctype="multipart/form-data" class='redForm1'>
                                            <h1 class="sTitle">Редагування публікації:</h1>
                                            <?php
                                            while ($bbb=mysqli_fetch_row($getPostById)) 
                                            {
                                                ?>
                                                <h1 class='sTitle'>
                                                    <?php echo "Розділ: ";
                                                        sectionNameConvert($type);?>
                                                </h1>
                                                
                                                <label for="redTitle">Назва файлу: </label>   <!--Прописати назви і підключити до підписів через id-->
                                                <?php echo "<input type='text' name='redTitle' class='EField' id='redTitle' value='$bbb[1]'><br>";?> 
                                                    <?php
                                                    //декодування фотки
                                                    $file = $bbb[2];
                                                    $document = str_replace('data:application/pdf;base64,', '', $file); 
                                                    
                                                        $path = "Plans/upload/".$bbb[1];   //назва файлу

                                                    file_put_contents("$path", base64_decode($document));

                                                    if ($file) {
                                                        echo "<br>";
                                                        echo "<a href='$path'>Переглянути файл</a>";
                                                    }
                                                    echo "<p>Навчальний рік: $bbb[3]</p>"; 
                                                    echo "<p>Півріччя: $bbb[4]</p>"; 
                                                    echo "<p>Замінити документ: </p>"; 
                                                    echo "<input type='hidden' name='typeredpost' value=$type>";
                                                    echo "<input type='hidden' name='resultId' value=$resultId>"; 
                                            }?>
                                                <input type="file" name="files[]"> <br><br>  
                                                <a class='cancel' href="adminPanel.php">Скасувати</a>
                                                <input type="submit" class="submitBtn" name="red-post" value="Внести зміни">
                                        </form><?php
                                    break;

                                    case 'basicProvisions':
                                        ?>
                                        <form action="process_posts.php" method="post" enctype="multipart/form-data" class='redForm1'>
                                            <h1 class="sTitle">Редагування основних положень:</h1>
                                            <?php
                                            while ($bbb=mysqli_fetch_row($getPostById)) 
                                            {
                                                ?>
                                                <h1 class='sTitle'>
                                                <?php echo "Розділ: ";
                                                        sectionNameConvert($type);?>
                                                </h1>
                                                
                                                <label for="redText">Міні-заголовок: </label>   <!--Прописати назви і підключити до підписів через id-->
                                                <?php echo "<textarea name='redText' class='textInput' id='redText'>$bbb[1]</textarea><br>";?> 
                                                    <?php
                                                    for ($i=2; $i < 11; $i++) { 
                                                        if (strlen($bbb[$i])>0) {
                                                            
                                                            echo"<label for='redText-$i'>Текст пункта $i: </label><br>
                                                            <textarea name='redText-$i' id='redText-$i' class='textInputAU'  wrap='soft'>$bbb[$i]</textarea><br>";
                                                        }
                                                    }
                                                    echo "<input type='hidden' name='resultId' value=$resultId>";
                                                    echo "<input type='hidden' name='typeredpost' value=$type>";
                                                     
                                            }?>
                                                <br><br> 
                                                <a class='cancel' href="adminPanel.php">Скасувати</a> 
                                                <input type="submit" class="submitBtn" name="red-post" value="Внести зміни">
                                        </form><?php
                                    break;
                        
                                    case 'activities':
                                        ?>
                                        <form action="process_posts.php" method="post" enctype="multipart/form-data" class='redForm1'>
                                            <h1 class="sTitle">Редагування публікації:</h1>
                                            
                                            <h1 class='sTitle'>
                                            <?php echo "Розділ: ";
                                                        sectionNameConvert($type);?>
                                            </h1><?php
                                            while ($bbb=mysqli_fetch_row($getPostById)) 
                                            {
                                                ?>
                                                <label for="redText">Заголовок: </label>   <!--Прописати назви і підключити до підписів через id-->
                                                <?php echo "<textarea type='text' name='redText' class='textInputAU' id='redText'>$bbb[1]</textarea><br>";?> 
                                                    <?php
                                                    //декодування фотки
                                                    $file = $bbb[3];
                                                    $document = str_replace('data:application/pdf;base64,', '', $file); 
                                                    
                                                        $path = "About Us/upload/".$bbb[2];   //назва файлу

                                                    file_put_contents("$path", base64_decode($document));

                                                    if ($file) {
                                                        echo "<br>
                                                        <img src='$path' class='AImg'>
                                                        ";
                                                        
                                                    } 
                                                    echo "<p>Замінити документ: </p>"; 
                                                     
                                            }
                                                echo "<input type='hidden' name='typeredpost' value=$type>";
                                                echo "<input type='hidden' name='resultId' value=$resultId>";
                                            ?>
                                                <input type='file' name='files[]'> <br>
                                                <br>  
                                                <a class='cancel' href="adminPanel.php">Скасувати</a>
                                                <input type="submit" class="submitBtn" name="red-post" value="Внести зміни">
                                        </form><?php
                                    break;

                                    default:
                                        ?>
                                        <form action="process_posts.php" method="post" enctype="multipart/form-data">
                                            <h1 class="sTitle">Редагування публікації:</h1>
                                            <?php
                                            while ($bbb=mysqli_fetch_row($getPostById)) 
                                            {
                                                ?>
                                                <h4>
                                                <?php echo "Розділ: ";
                                                        sectionNameConvert($type);?>
                                                </h4>
                                                <label for="redTitle">Заголовок</label>
                                                <?php echo "<input type='text' name='redTitle' id='redTitle' value='$bbb[1]'><br>";?>
            
                                                <label for="redText">Текст публікації: </label><br>   <!--Прописати назви і підключити до підписів через id-->
                                                <textarea name="redText" id="redText" style="width: 560px; height: 340px;"  wrap="soft"><?php echo "$bbb[2]";?></textarea><br> 
                                                    <p>
                                                    <?//декодування фотки
                                                        $file = $bbb[4];
                                                        $img = str_replace('data:image/png;base64,', '', $file); 
                                                        $path = $bbb[3];
                                                        
                                                        file_put_contents("PanelAdmins/$path", base64_decode($img));             //розкодовує фотку з БД і створює файл з назвою $path .png
                                                    
                                                        if ($file) {
                                                            echo "<p>Завантажене фото:</p>";
                                                            echo "<img src='PanelAdmins/$path' class='sImg'> <br>";
                                                        }
                                                    ?>   
                                                    </p>
                                                    <?php echo "<p>Дата публікації: $bbb[5]</p> <br>"; 
                                                        echo "<input type='hidden' name='typeredpost' value=$type>";
                                                        echo "<input type='hidden' name='resultId' value=$resultId>"; 
                                            }?>
                                                <input type="file" name="files[]"> <br><br>  
                                                <a class='cancel' href="adminPanel.php">Скасувати</a>
                                                <input type="submit" class="submitBtn" class="submitBtn" name="red-post" value="Внести зміни">
                                        </form>                                        
                                        <?php
                                    break;
                                }
                                
                            }                            
                        }?>
                        
                    </div>
                    <div class="del-form">
                        <form action="adminPanel.php" method="POST">
                            <h3 class="subTitle">Оберіть розділ для видалення</h3>
                            <select name = "type" require>
                                <option value= ""></option> 
                                <option value= "news">Дайджест подій</option>
                                <option value= "plans">Плани заходів</option>
                                <option value= "laws">Нормативна база</option>
                                <option value= "info">Корисна інформація</option>
                                <option value= "research">Наукові дослідження</option>
                                <option value= 'basicProvisions'>Про нас | Основні положення</option>
                                <option value= 'activities'>Про нас | Напрямки роботи</option>
                            </select>
                            <input type="submit" class="submitBtn" name="delType" value="Обрати розділ"><br>
                        </form>
                    
                        <?php
                            $typedelpost = $_POST['type'];?>
                            <br>
                            <?php
                                if ($_POST['delType']) 
                                {

                                    //запит в бд для зчитування списку постів
                                    $check;
                                    switch ($typedelpost) {
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

                                    //Відображення данних з бд і відправлення ID в process_posts.php
                                    switch ($typedelpost) {
                                        case 'laws':
                                            ?>
                                            <!--Відправка в process_post.php для відправлення в бд-->
                                            <div class='Post'>                                            
                                            <form action="process_posts.php" method="post">
                                                <table class= 'tbldel'>
                                                    <tr class= 'deltitlepanel'>
                                                        <td></td>
                                                        <td>Заголовок</td>
                                                        <td>Назва файлу</td>
                                                        <td>Дата публікації</td>
                                                    </tr>
                                                    <?php
                                                    while ($del=mysqli_fetch_row($check))
                                                    {  
                                                        echo"
                                                        <tr class= 'delOtherPanel'>
                                                            <td><input type='checkbox' name='delpost' id='$del[0]' value='$del[0]'>
                                                            <input type='hidden' name='deltype' value='$typedelpost'>
                                                            </td>
                                                            <td><label for='$del[0]'>$del[1]</label></td>
                                                            <td><label for='$del[0]'>$del[2]</label></td>
                                                            <td><label for='$del[0]'>$del[4]</label></td>
                                                        </tr>";                                                  
                                                    }?>
                                                </table>
                                                <a class='cancel' href="adminPanel.php">Скасувати</a>
                                                <input type="submit" class="submitBtn" class="submitBtn" name="delpostresult" value="Видалити">
                                            </form>
                                            </div><?php
                                            break;
                                        
                                        case 'basicProvisions':
                                            ?>
                                            <!--Відправка в process_post.php для відправлення в бд-->
                                            <div class='Post'>                                            
                                            <form action="process_posts.php" method="post">
                                                <table class= 'tbldel'>
                                                    <tr class= 'deltitlepanel'>
                                                        <td></td>
                                                        <td>Заголовок</td>
                                                        <td>Пункт 1</td>
                                                        <td>Пункт 2</td>
                                                        <td>...</td>
                                                    </tr>
                                                    <?php
                                                    while ($del=mysqli_fetch_row($check))
                                                    {  
                                                        $ttext0 = strip_tags($del[1]);
                                                            $ttext0 = str_split($ttext0,50);
                                                        $ttext1 = strip_tags($del[2]);
                                                            $ttext1 = str_split($ttext1,25);
                                                        $ttext2 = strip_tags($del[3]);
                                                            $ttext2 = str_split($ttext2,25);
                                                        echo"
                                                        <tr class= 'delOtherPanel'>
                                                            <td><input type='checkbox' name='delpost' id='$del[0]' value='$del[0]'>
                                                            <input type='hidden' name='deltype' value='$typedelpost'>
                                                            </td>
                                                            <td><label for='$del[0]'>$ttext0[0]</label></td>
                                                            <td><label for='$del[0]'>$ttext1[0]</label></td>
                                                            <td><label for='$del[0]'>$ttext2[0]</label></td>
                                                        </tr>";                                                  
                                                    }?>
                                                </table>
                                                <a class='cancel' href="adminPanel.php">Скасувати</a>
                                                <input type="submit" class="submitBtn" class="submitBtn" name="delpostresult" value="Видалити">
                                            </form>
                                            </div><?php
                                        break;

                                        case 'activities':
                                            ?>
                                            <!--Відправка в process_post.php для відправлення в бд-->
                                            <div class='Post'>                                            
                                            <form action="process_posts.php" method="post">
                                                <table class= 'tbldel'>
                                                    <tr class= 'deltitlepanel'>
                                                        <td></td>
                                                        <td>Заголовок</td>
                                                        <td>Назва файлу</td>
                                                    </tr>
                                                    <?php
                                                    while ($del=mysqli_fetch_row($check))
                                                    {  
                                                        echo"
                                                        <tr class= 'delOtherPanel'>
                                                            <td><input type='checkbox' name='delpost' id='$del[0]' value='$del[0]'>
                                                            <input type='hidden' name='deltype' value='$typedelpost'>
                                                            </td>
                                                            <td><label for='$del[0]'>$del[1]</label></td>
                                                            <td><label for='$del[0]'>$del[2]</label></td>
                                                        </tr>";                                                  
                                                    }?>
                                                </table>
                                                <a class='cancel' href="adminPanel.php">Скасувати</a>
                                                <input type="submit" class="submitBtn" class="submitBtn" name="delpostresult" value="Видалити">
                                            </form>
                                            </div><?php
                                        break;

                                        case 'plans':
                                            ?>
                                            <!--Відправка в process_post.php для відправлення в бд-->
                                            <div class='Post'>                                            
                                            <form action="process_posts.php" method="post">
                                                <table class= 'tbldel'>
                                                    <tr class= 'deltitlepanel'>
                                                        <td></td>
                                                        <td>Назва файлу</td>
                                                        <td>Півріччя</td>
                                                        <td>Навчальний рік</td>
                                                    </tr>
                                                    <?php
                                                    while ($del=mysqli_fetch_row($check))
                                                    {  
                                                        echo"
                                                        <tr class= 'delOtherPanel'>
                                                            <td><input type='checkbox' name='delpost' id='$del[0]' value='$del[0]'>
                                                            <input type='hidden' name='deltype' value='$typedelpost'>
                                                            </td>
                                                            <td><label for='$del[0]'>$del[1]</label></td>
                                                            <td><label for='$del[0]'>$del[4]</label></td>
                                                            <td><label for='$del[0]'>$del[3]</label></td>
                                                        </tr>";                                                  
                                                    }?>
                                                </table>
                                                <a class='cancel' href="adminPanel.php">Скасувати</a>
                                                <input type="submit" class="submitBtn" name="delpostresult" value="Видалити">
                                            </form>
                                            </div><?php
                                            break;

                                        default:
                                            ?>
                                            <!--Відправка в process_post.php для відправлення в бд-->
                                            <div class='Post'>                                            
                                            <form action="process_posts.php" method="post" multiple>
                                                <table class= 'tbldel'>
                                                    <tr class= 'deltitlepanel'>
                                                        <td></td>
                                                        <td >Назва статті</td>
                                                        <td>Текст</td>
                                                        <td>Назва файлу</td>
                                                        <td>Дата публікації</td>
                                                    </tr>
                                                    <?php
                                                    while ($del=mysqli_fetch_row($check))
                                                    {
                                                        $ttext = strip_tags($del[2]);
                                                        $ttext = str_split($ttext,50);
                                                        
                                                        echo"
                                                        <tr class= 'delOtherPanel'>
                                                            <td><input type='checkbox' name='delpost[]' id='$del[0]' value='$del[0]'>
                                                                <input type='hidden' name='deltype' value='$typedelpost'>
                                                            </td>
                                                            <td><label for='$del[0]'>$del[1]</label></td>
                                                            <td><label for='$del[0]'>$ttext[0]...</label></td>
                                                            <td><label for='$del[0]'>$del[3]</label></td>
                                                            <td><label for='$del[0]'>$del[5]</label></td>
                                                        </tr>";                                                  
                                                    }?>
                                                </table>
                                                <a class='cancel' href="adminPanel.php">Скасувати</a>
                                                <input type="submit" class="submitBtn" name="delpostresult" value="Видалити">
                                            </form>
                                            </div><?php
                                            break;
                                    }
                                }?>
                            
                            <!--text html here-->

                    </div>
                </div>
            </div>

            <div class="box-3">
                <div class="box-title">
                    <h3>Інформація про співробітників</h3>
                </div>
                <div  class="nContainer">
                    <div class="add-form">
                        <?php
                            if ($_POST['addS']) {
                                ?>
                                <form action="process_specialists.php" method="POST" enctype="multipart/form-data">
                                    <h1 class="sTitle">Додати нового співробітника</h1>
                                    
                                    <input type="text" name="lastname" placeholder="Прізвище" required class="EField"><br>
                                    <input type="text" name="firstname" placeholder="Ім'я" required class="EField"><br>
                                    <input type="text" name="secondname" placeholder="По-батькові" required class="EField"><br>
                                    <input type="text" name="position" placeholder="Посада, науковий ступінь" required class="EField"><br>

                                    <p class="subTextT">Біографія / напрямки діяльності:</p>
                                    <textarea name= "bio" id="bioS" class="textInput"></textarea><br>
                                    
                                    <input type="url" name="link" placeholder="Особистий веб-сайт" class="EField">
                                    <p class="subTextT">Контактна інформація:</p>
                                    <input type="text" name="phone" placeholder="Номер телефону" class="EField"><br>
                                    
                                    <input type="email" name="email" placeholder="Електронна пошта" required class="EField"><br>
                                    
                                    Фото: <input type="file" name="files[]"><br><br>
                                    <a class='cancel' href="adminPanel.php">Скасувати</a>
                                    <input type="submit" class="submitBtn" name="addspecialist" value=" Додати" ><br>
                                </form>
                                <?php
                            }else {
                                ?>
                                <form action="adminPanel.php" method="post">
                                    <input type="submit" class="submitBtn" name="addS" value="Додати нового співробітника">
                                </form>
                                <?php
                            }
                        ?>
                        
                    </div>
                    <div class="red-form">
                        <?php 
                            $check = mysqli_query($db, "SELECT * FROM specialists ORDER BY specialists.id");
                            
                            //chooseSpecialistsId($check);  
                            
                            //перехоплюємо тут Id через $_POST і закидуємо в останню ф-цію
                        $redSpecialistId = 0;
                        if ($_POST['redSpecialistResult']) {
                            $redSpecialistId = $_POST['redSpecialist'];

                            $getSpecialistById = getSpecialistById($redSpecialistId, $db);
                        }

                        if ($getSpecialistById) {
                            ?>
                            <form action="process_specialists.php" method="POST" enctype="multipart/form-data">
                                <h1 class="sTitle">Змінити данні про співробітника</h1>
                                <?php
                                while ($bbb=mysqli_fetch_row($getSpecialistById)) 
                                {
                                    echo "
                                    <label for='lastname'>Прізвище</label><br>
                                    <input type='text' name='lastname' id='lastname' value='$bbb[2]' required class='EField'> <br>

                                    <label for='firstname'>Ім'я</label><br>
                                    <input type='text' name='firstname' id='firstname' value='$bbb[1]' required class='EField'> <br>
                                    
                                    <label for='secondname'>По-батькові</label><br>
                                    <input type='text' name='secondname' id='secondname' value='$bbb[3]' required class='EField'> <br>
                                    
                                    <label for='position'>Посада, науковий ступінь</label><br>
                                    <input type='text' name='position' id='position' required value='$bbb[4]' class='EField'><br>
                                    ";
                                    ?>
                                    <p class="subTextT">Біографія / напрямки діяльності:</p>
                                    <textarea name= 'bio' id='bioS'> <?php echo"$bbb[5]";?></textarea><br>

                                    <?php echo"
                                        <label for='link'>Особистий веб-сайт</label><br>
                                        <input type='url' name='link' id='link' value='$bbb[6]' class='EField'>

                                        <p>Контактна інформація:</p>
                                        <label for='phone'>Номер телефону</label><br>
                                        <input type='text' name='phone' class='EField' value='$bbb[7]'><br>

                                        <label for='email'>Електронна пошта</label><br>
                                        <input type='email' name='email' required class='EField' value='$bbb[8]'><br>

                                        <input type='hidden' name='redSpecialistId' value=$redSpecialistId>
                                    "; 
                                    //декодування фотки
                                    $file = $bbb[10];
                                    $img = str_replace('data:image/png;base64,', '', $file); 
                                    $path = $bbb[9];
                                    
                                    file_put_contents("PanelAdmins/$path", base64_decode($img));             //розкодовує фотку з БД і створює файл з назвою $path .png
                                
                                    if ($file) {
                                        echo"
                                            <div class='windowRedPhoto'>
                                                <p>Завантажене фото:</p>
                                            </div>
                                            <div class='windowRedPhoto'>
                                                <img src='PanelAdmins/$path' class='sImg' id='redPhoto'>
                                            </div>
                                        
                                        ";
                                    }
                                }
                                    
                                ?>
                                <div class="windowRedPhoto">
                                <p>Завантажити нове фото:</p><br>
                                 <input type="file" name="files[]"><br><br>
                                 <a class='cancel' href="adminPanel.php">Скасувати</a>
                                <input type="submit" class="submitBtn" name="red-Specialist" value="Змінити дані співробітника">
                                </div>
                                
                            </form>
                            <?php
                        }else {
                            chooseSpecialistsId($check);  
                        }
                        ?>
                    </div>                    
                    <div class="del-form">
                        <?php
                        $check = mysqli_query($db, "SELECT * FROM specialists ORDER BY specialists.id");
                        delSpecialistsId($check);

                        ?>
                    </div>
                </div>
            </div>

        </div>
            <?php makeFooter();  //footer?>
    </div>

   
</body>
<?php
            
        
?>
<!-- <script type="text/javascript">
    function preview(){
        frame.src=URL.createObjectURL(event.target.files[0]);
    }
</script> -->

<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous">
</script>

