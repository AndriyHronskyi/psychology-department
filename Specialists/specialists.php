<?php
    require("../dbconfig.php");
    include('../pageParts.php');
?>
<html>
<head>
    <?php     styleSheetConnect('Співробітники','specialists.css');?>  
</head>
<body>
    <div class="Main">
        <?php //header
            makeHeader(1,'Психологічна служба ВНТУ');?>
        <div class="container-1">
            <div class="box-1" id="sidebar">
                <?php Sidebar(0,0,$db); //(number of active element on menu , 1-specialist widet ON, connection)?>
            </div>
            <div class="box-2">
                <div class="box-title">
                    <h3>Співробітники</h3>
                </div>
                <div class="nContainer">
                    
                    <?
                        $ph = mysqli_query($db, "SELECT * FROM specialists ORDER BY specialists.id");
                        while ($bbb=mysqli_fetch_row($ph)) 
                        {
                    ?>
                    <div class='Post'>
                        
                        <div class="leftText">

                                <?//декодування фотки
                                    $file = $bbb[10];
                                    $img = str_replace('data:image/png;base64,', '', $file); 
                                    $path = $bbb[9];
                                    
                                    file_put_contents("$path", base64_decode($img));             //розкодовує фотку з БД і створює файл з назвою $path .png
                                    if ($file && $path) {
                                        echo"<div class='lText'>
                                                <img src='$path' class='sImg'>
                                            </div>";
                                    }
                                ?>   
                            
                            <div class="lText">
                                <?php echo"<p id='sTitle'> $bbb[2] <br> $bbb[1] $bbb[3]</p>";?>
                                    <br>
                                <p class='sPositionName'><?php echo"$bbb[4]";?></p>
                            </div>
                        </div>

                        <div class="rightText">
                            <ul class='sText'>
                                <li>
                                    <?php echo"<p class='listTitle' id=$bbb[0]>Біографія/Напрямки роботи</p>";?>
                                    <div class="mainText">
                                        <p><?php echo"$bbb[5]"; //тут бажано зробити так, щоб цей текст построчно виставлявся?> </p>
                                    </div>
                                </li>
                                <li>
                                    <a href="<?=$bbb[6]?>" class='listTitle'>Особистий веб-сайт</a>
                                </li>
                                <li>
                                    <p class='listTitle'>Контактна інформація</p>
                                    <ol>
                                        <li class='contactInfo'>
                                            <p>
                                                Номер телефону: <a href="tel:<?=$bbb[7]?>"><?echo"$bbb[7]";?></a>
                                            </p>
                                            
                                        </li>
                                        <li class='contactInfo'>
                                            <p class='listTitle'>Електронна пошта: 
                                                <a href="mailto:<?=$bbb[8]?>"><?echo"$bbb[8]";?></a>
                                            </p >
                                        </li>
                                        <li class='contactInfo'>
                                           <a href="mailto:skrinkadovirivntu@gmail.com"><p>Запитанння до практичного психолога</p></a>
                                        </li>
                                    </ol>
                                </li>
                            </ul>
                        </div>
                    </div><?php 
                    }?>
                        
                </div>
            </div>
            
        </div>
        <?php makeFooter();  //footer?>

    </div>



    <script>
        /*

        setTimeout(function() {
            location.reload();
        }, 3000);

        */
        $(window).scroll(function() {
            if ($(this).scrollTop() > 450) {
            $('.box-1').css({
                    'display': 'none'
                    
                }); 
            }
            
            
            if ($(this).scrollTop() < 450) {
                $('.box-1').css({
                    'display': 'block'
                });
                
            }
            
        });
        $(window).scroll(function() {
            if ($(this).scrollTop() > 450) {
            $('.box-2').css({
                    'margin': ' 0% 10%'
                    
                }); 
            }
            
            
            if ($(this).scrollTop() < 450) {
                $('.box-2').css({
                    'margin': '0% 2.5%'
                });
                
            }
            
        });
    </script>
    
</body>
</html>