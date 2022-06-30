<?php
// [] - приклад вхідних данних

function styleSheetConnect($title,$styleAddPath){
    //$title - заголовок сторінки    [Дайджест подій]
    //$styleAddPath - додатковий CSS-файл (для всіх окрім index.php, де тільки index.css) [News/news.css]
    
    echo"
    <meta charset='UTF-8'>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    
    ";

    if ($styleAddPath) {
            echo"
            <link rel='shortcut icon' href='../Main/LogoPsy.png' type='image/png'>
            <link href='../Main/index.css' type='text/css' rel='stylesheet'>
            <title>$title | Психологічна служба ВНТУ</title>
            <link href='$styleAddPath' type='text/css' rel='stylesheet'>";?>
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <?php
        }else {
        echo"
        <link rel='shortcut icon' href='Main/LogoPsy.png' type='image/png'>
        <link href='Main/index.css' type='text/css' rel='stylesheet'>
        <title>$title | Психологічна служба ВНТУ</title>"; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <?php
    }
    
}

function makeHeader($image,$hTitle){
    echo"<header>
        <div class='container-0'>";
        if ($image == 0) {
            echo"<div class='Hhead'>
                <a href='login.php'>
                    <img id='HImg' src='../Main/LogoPsy.png'>
                </a>
            </div>";
        }elseif ($image == 1) {
            echo"<div class='Hhead'>
                <a href='../login.php'>
                    <img id='HImg' src='../Main/LogoPsy.png'>
                </a>
            </div>";
        }elseif ($image == 2) {
            echo"
            <div class='Hhead'>
                <a href='index.php' id='linkIndex'>
                    <img id='arrow' src='../Main/ArrowLeft.png' class='linkCls'>
                    <h1 id='textLink' class='linkCls'>Головна</h1>
                </a>
            </div>
            ";
        }

        if ($hTitle) {
            echo"<div class='Hhead'>
                <h1>$hTitle</h1>
            </div>";
        } 
        echo"</div>
    </header>";
}

function Sidebar($active,$numb,$db){
    echo"<div class='Menu'>
        <ul>";
        
        $First = "<li><a href='../index.php' 123 ><p>Головна</p></a></li>";
        $Second ="<li><a href='../News/news.php' 123><p>Дайджест подій</p></a></li>";
        $Third ="<li><a href='../Plans/plans.php' 123 ><p>Плани заходів служби</p></a></li>";
        $Fourth ="<li><a href='../laws/laws.php' 123 ><p>Нормативні документи</p></a></li>";//*
        $Fiveth ="<li><a href='../Info/info.php' 123><p>Корисна інформація</p></a></li>";
        $Sixth ="<li><a href='../Research/research.php' 123 ><p>Наукові дослідження</p></a></li>";//*
        $Seven ="<li><a href='mailto:skrinkadovirivntu@gmail.com' 123 ><p>Запитання до практичного психолога</p></a></li>";//*

        $Active = "id= 'Active'";
        switch ($active) {
            case '1':
                $First = str_replace('123' , $Active , $First);
            break;
            case '2':
                $Second = str_replace('123', $Active , $Second);
            break;
            case '3':
                $Third = str_replace('123', $Active , $Third);
            break;
            case '4':
                $Fourth = str_replace('123', $Active , $Fourth);
            break;
            case '5':
                $Fiveth = str_replace('123' , $Active , $Fiveth);
            break;
            case '6':
                $Sixth = str_replace('123' , $Active , $Sixth);
            break;
            case '7':
                $Seven = str_replace('123' , $Active , $Seven);
            break;
            default:
            
            break;
        }
        
            echo $First.$Second.$Third.$Fourth.$Fiveth.$Sixth.$Seven;
        echo"</ul>
    </div>";
    if ($numb == 1) {
        ?>
        <div class='Updates'>
            <div class='UTitle'>
                <a href='../Specialists/specialists.php'><h3>Співробітники</h3></a>
            </div>
            <div class='uPost'>

                <div class='contacts'>
                    <?
                        $ph = mysqli_query($db, "SELECT * FROM specialists ORDER BY specialists.id");
                        while ($bbb=mysqli_fetch_row($ph)) 
                        {
                    ?>
                            <div class="contact">
                                <ul>
                                    <li> <h4><? echo"$bbb[4]";?></h4> </li>
                                    <li class="name"> 
                                        <?php echo"<a href='../Specialists/specialists.php#$bbb[0]'>";?>
                                            <? echo"$bbb[2] <br> $bbb[1] $bbb[3]";?>
                                        </a>
                                    </li>
                                    <li class="pNumb">
                                        <p>тел: <a href="tel:<?=$bbb[7]?>">
                                            <?echo"$bbb[7]";?></a>
                                        </p>
                                        
                                    </li>
                                    <li class="mail">
                                        <p>E-mail: 
                                            <a href="mailto:<?=$bbb[8]?>"><?echo"$bbb[8]";?></a>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                    <?
                        }
                    ?>                
                </div>
            </div>
        </div>
        <?php
    }
}

//конвертує англійські, скорочені назви розділів в нормальні назви
function sectionNameConvert($type){
    $sectionName;
    switch ($type) {

        case 'news':
            $sectionName = 'Дайджест подій';
        break;
        case 'plans':
            $sectionName = 'Плани заходів';
        break;
        case 'laws':
            $sectionName = 'Нормативна база';
        break;
        case 'info':
            $sectionName = 'Корисна інформація';
        break;
        case 'research':
            $sectionName = 'Наукові дослідження';
        break;
        case 'basicProvisions':
            $sectionName = 'Про нас | Основні положення';
        break;
        case 'activities':
            $sectionName = 'Про нас | Напрямки роботи';
        break;
    }
    echo $sectionName;
}

function DateTimeConvert($str){
    //$str = "2021-07-02 01:38:39";  як приклд
    $date = str_split($str,10);   // ділимо на дві частини "2021-07-02"   і " 01:38:39"

        //time
        $date[1] = str_replace(' ', '', $date[1]);  //видаляємо пробіл спочатку
        $tBuff = str_split($date[1],5);             //відділяємо мілісекунди "01:38" і ":39" 
        $dTime = $tBuff[0];                         //обираємо "01:38"

        //date
        $date[0] = str_replace('-', '', $date[0]);  //видаляємо тире

        $year;
        $mounth;
        $day;

        $dBuff = str_split($date[0],2);  // ділимо  2021-07-02  по два символи

        for ($i = 0; $i <= 3; $i+=1){
            if($i <= 1){
                $year = $dBuff[$i];
                $year .= $dBuff[$i+1];
            }
            if($i = 2){
                $mounth= $dBuff[$i];
            }
            if($i = 3){
                $day= $dBuff[$i];
            }
        }

        //Назви місяців
        $mounths = array("01"=>"Січня", 
                        "02"=>"Лютого", 
                        "03"=>"Березня",
                        "04"=>"Квітня",
                        "05"=>"Травня",
                        "06"=>"Червня",
                        "07"=>"Липня",
                        "08"=>"Серпня",
                        "09"=>"Вересня",
                        "10"=>"Жовтня",
                        "11"=>"Листопада",
                        "12"=>"Грудня");
        foreach ($mounths as $x => $value) {
            if ($x == $mounth) {
                $mounth = $value;
                continue;
            }
        }
        if ($day != 10) {
            $day = str_replace('0', '', $day);  //видаляємо нуль з номера дня: було "01" стало "1"
        }

        $Date = $dTime.".  "."  ".$day." ".$mounth." ".$year;
        return $Date;
}

function makeFooter(){
    echo "
    <div class='footer'>
        <div class='container-2'>
            
            <div class='aboutUs'>
                <ul>
                    <li>
                        <p>
                        Психологічна служба допомогає у вирішенні 
                        психологічних проблем та сприяє створенню
                        сприятливого психологічного клімату для 
                        всіх учасників освітнього процесу
                        </p>
                    </li>
                    <li>
                        <!--
                            Посилання на список співробітників
                            або на напрями роботи
                        -->
                        <div class='btn-aboutUs'>
                            <a href='/About Us/aboutUs.php'>
                                <h4>Про нас</h4>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class='copyright'>
            <p>
                ВНТУ © 2021 - Усі права захищені
            </p>
        </div>
    </div>
    ";
}


?>