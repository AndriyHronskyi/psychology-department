<?php
    require("../dbconfig.php");
    include('../pageParts.php');
?>
<html>
<head>
    <?php     styleSheetConnect('Нормативні документи','laws.css');?>  
</head>
<body>
    <div class="Main">
        <?php //header
            makeHeader(1,'Психологічна служба ВНТУ');?>
        <div class="container-1">
            <div class="box-1" id="sidebar">
                <?php Sidebar(4,1,$db); //(number of active element on menu , 1-specialist widet ON, connection)?>
            </div>

            <!-- Відредагувати. вставити посилання на файли. І якось прикрутити переглядання файлів -->
            <div class="box-2">
                <div class="box-title">
                    <h3>Нормативні документи</h3>
                </div>
                <div class="nContainer">
                    
                    <?
                    $ph = mysqli_query($db, "SELECT * FROM laws ORDER BY laws.id DESC");
                    while ($bbb=mysqli_fetch_row($ph)) 
                    {
                        ?>
                        <div class='Post'>
                        <?      //декодування файлу
                                $file = $bbb[3];
                                $document = str_replace('data:application/pdf;base64,', '', $file); 
                                
                                $path = "upload/".$bbb[2];   //назва файлу
                                
                                file_put_contents("$path", base64_decode($document));
                                
                                //формування заголовку
                                $Title = str_replace('pdf' , "" , $bbb[2]);
                                $Title = str_replace('-' , " " , $Title);
                                $DATE = DateTimeConvert($bbb[4]);           //форматування дати
                                if ($file) {
                                    echo "<a class='fileLink' href='$path'>
                                        <h1 class='sTitle' id='$bbb[0]'>$Title</h1>
                                        <p class='ContentPost'>
                                            <span class='sText'>$bbb[1]</span><br><br>
                                            <p class='dateT'>Опубліковано: $DATE</p> 
                                        </p>   
                                    

                                    </a>";
                                }
                            ?>   
                        </div>
                        
                        <?php 
                    }
                    ?>
                        
                </div>
            </div>

        </div>
        <?php 
            makeFooter();  //footer
        ?>

    </div>

    


    <script>
        /*

        setTimeout(function() {
            location.reload();
        }, 3000);

        */
        /*$(window).scroll(function() {
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