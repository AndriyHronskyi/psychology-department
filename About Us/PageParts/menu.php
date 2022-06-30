<?php
function Sidebar($active,$numb,$db){
    echo"<div class='Menu'>
        <ul>";
        
        $First = "<li><a href='index.php' 123 ><p>Головна</p></a></li>";
        $Second ="<li><a href='news.php' 123><p>Дайджест подій</p></a></li>";
        $Third ="<li><a href='plans.php' 123 ><p>Плани заходів служби</p></a></li>";
        $Fourth ="<li><a href='laws.php' 123 ><p>Нормативні документи</p></a></li>";//*
        $Fiveth ="<li><a href='info.php' 123><p>Корисна інформація</p></a></li>";
        $Sixth ="<li><a href='research.php' 123 ><p>Наукові дослідження</p></a></li>";//*
        $Seven ="<li><a href='questions.php' 123 ><p>Запитання до практичного психолога</p></a></li>";//*

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
                <a href='specialists.php'><h3>Співробітники</h3></a>
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
                                        <?php echo"<a href='https://psychology.depart/specialists.php#$bbb[0]'>";?>
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
?>
