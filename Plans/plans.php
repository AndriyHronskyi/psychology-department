<?php
    require("../dbconfig.php");
    include('../pageParts.php');
?>
<html>
<head>
    <?php     styleSheetConnect('Плани заходів','plans.css');?>  
</head>
<body>
    <div class="Main">
        <?php //header
            makeHeader(1,'Психологічна служба ВНТУ');?>
        <div class="container-1" id="Cont1">
            <div class="box-1">
                <?php Sidebar(3,1,$db); //(number of active element on menu , 1-specialist widet ON, connection)?>
            </div>
            <div class="box-2">
                <div class="box-title">
                    <h3>Плани заходів служби</h3>
                </div>
                <div class="nContainer">
                    <?
                        $ph = mysqli_query($db, "SELECT * FROM plans ORDER BY plans.id DESC");
                        
                        while ($bbb=mysqli_fetch_row($ph)) 
                        {
                            echo"<a href='plans.php?fileId=$bbb[0]'>"; 
                            ?>
                            <div class='Post'>
                                <h1 class='sTitle' id='<?echo"$bbb[0]";?>'>
                                    <?
                                    $Title = str_replace('pdf' , '' , $bbb[1]);
                                    $Title = str_replace('-' , ' ' , $Title);
                                    echo $Title;
                                    ?>
                                </h1>
                                <p class='ContentPost'>
                                    <?
                                        $nextY = $bbb[3];
                                        $nextY += 1;
                                        if ($bbb[4] == 1) {
                                            $pYear = 'перше';
                                        }else {
                                            $pYear = 'друге';
                                        }
                                        $subTitle = "На: $pYear півряччя<br> $bbb[3]/$nextY року";
                                        echo $subTitle;
                                    ?>  
                                </p>
                            </div>
                            </a>
                            <?php 
                        }
                    ?>   
                </div>

            </div>
            <div class="box-3">
                <div class="box-title">
                    <h3>Вікно перегляду</h3>
                </div>
                <div  class="uContainer">
                    <div class="FRAME">
                    <?php
                    if ($_GET["fileId"]) {
                        $ph = mysqli_query($db, "SELECT * FROM plans ORDER BY plans.id DESC");
                        while ($bbb=mysqli_fetch_row($ph)) 
                        {     
                            if ($bbb[0] == $_GET["fileId"]) {
                                //декодування файлу
                                $file = $bbb[2];
                                $document = str_replace('data:application/pdf;base64,', '', $file); 
                                    $path = "download/".$bbb[1];   //назва файлу
                                file_put_contents("$path", base64_decode($document));
                                if ($file) {
                                    echo"<iframe src='$path' scrolling='no'></iframe>";
                                }
                            }                                                         
                        }
                    }
                    ?>   
                    </div>
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