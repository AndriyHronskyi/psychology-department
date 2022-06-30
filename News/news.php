<?php
    require("../dbconfig.php");
    include('../pageParts.php');
?>
<html>
<head>
    <?php     styleSheetConnect('Дайджест подій','news.css');?>  
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
                    <h3>Новини</h3>
                </div>
                <div class="nContainer">
                    
                    <?
                    $ph = mysqli_query($db, "SELECT * FROM news ORDER BY news.id DESC");
                    while ($bbb=mysqli_fetch_row($ph)) 
                    {
                        ?>
                        <div class='Post'>
                            <h1 class='sTitle' id="<?echo"$bbb[0]";?>">
                                <?echo "$bbb[1]";?>
                            </h1>
                            <?php $DATE = DateTimeConvert($bbb[5]);
                            echo "<p class='dateT'>Опубліковано: $DATE</p>"; ?>
                            <p class="ContentPost">
                                <?//декодування фотки
                                    $file = $bbb[4];
                                    $img = str_replace('data:image/png;base64,', '', $file); 
                                    
                                    file_put_contents("$bbb[3]", base64_decode($img));             //розкодовує фотку з БД і створює файл з назвою $path .png
                                
                                    if ($file) {
                                        echo "<img src='$bbb[3]' class='sImg'>";
                                    }
                                
                                    echo "<span class='sText'>$bbb[2]</span>";  
                                ?>   
                            </p>
                        </div><?php 
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

        */
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
            
        });
    </script>
    
</body>
</html>