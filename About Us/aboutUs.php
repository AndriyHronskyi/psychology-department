<?php
    require("../dbconfig.php");
    include('../pageParts.php');
?>
<html>
<head>
    <?php     styleSheetConnect('Про нас','aboutUs.css');?>  
</head>
<body>
    <div class="Main">
        <?php //header
            makeHeader(1,'Психологічна служба ВНТУ');?>
        <div class="container-1">
            <div class="box-1" id="sidebar">
                <?php Sidebar(2,1,$db); //(number of active element on menu , 1-specialist widet ON, connection)?>
            </div>
            <div class="box-2">
                <div class="box-title">
                    <h3>Основні положення</h3>
                </div>
                <div class="nContainer">
                    
                    <?
                    $ph = mysqli_query($db, "SELECT * FROM aboutus ORDER BY aboutus.id DESC");
                    while ($bbb=mysqli_fetch_row($ph)) 
                    {
                        ?>
                        <div class='Post'>
                            <?php
                                if ($bbb[1]) {
                                    echo"
                                    <p class='sText'>$bbb[1]</p>
                                    ";
                                }
                             ?>
                            <ul>
                                <?php
                                for ($i=2; $i < 3; $i++) { 
                                    while ($bbb[$i]) {

                                        //при завершенні формування бд. Видалити цей if()
                                        if ($i != 4) {
                                            echo"
                                            <li><span class='sText'>$bbb[$i]</span></li>
                                            ";
                                        } 
                                        $i+=1;
                                    }
                                }
                                ?>  
                            </ul>  
                        </div><?php 
                    }?>
                        
                </div>
            </div>
            <div class="box-3">
                <div class="box-title">
                    <h3>Напрямки роботи</h3>
                </div>
                <div  class="uContainer">
                <?
                    $ph = mysqli_query($db, "SELECT * FROM aboutusph ORDER BY aboutusph.id DESC");
                    while ($bbb=mysqli_fetch_row($ph)) 
                    {                           
                        //декодування фотки
                        $file = $bbb[3];
                        $img = str_replace('data:image/png;base64,', '', $file); 
                        $path = "download/".$bbb[2];
                        
                        file_put_contents($path, base64_decode($img));             //розкодовує фотку з БД і створює файл з назвою $path .png
                    
                        if ($file) {
                            echo"<div class='Post'><p class='sTitle'>$bbb[1]</p><img src='$path' class='BImg'></div";
                        }
                    }?>
                </div>
            </div>
        </div>
    </div>

    <?php 
    makeFooter();  //footer
    ?>


    <script>
        /*

        setTimeout(function() {
            location.reload();
        }, 3000);

        * /
        $(window).scroll(function() {
            if ($(this).scrollTop() > 1050) {
            $('.box-1').css({
                    'display': 'none'
                    
                }); 
            }
            
            
            if ($(this).scrollTop() < 1050) {
                $('.box-1').css({
                    'display': 'block'
                });
                
            }
            
        });
        $(window).scroll(function() {
            if ($(this).scrollTop() > 1050) {
            $('.container-1').css({
                    'padding': '10%'
                    
                }); 
            }
            
            
            if ($(this).scrollTop() < 1050) {
                $('.container-1').css({
                    'padding': '0%'
                });
                
            }
            
        });*/
    </script>
    
</body>
</html>