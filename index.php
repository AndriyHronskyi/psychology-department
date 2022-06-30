<?php
    session_start();
    define('rootD', __DIR__);

    require ('dbconfig.php');
    include('pageParts.php');
?>
<html>
<head>
    <?php 
        $title = 'Головна';
        styleSheetConnect($title,$styleAddPath);
    ?>
</head>
<body>
    <div class="Main">
        <?php //header
        makeHeader(0,'Психологічна служба ВНТУ');?>
        <div class="container-1">
            <div class="box-1">
                <?php Sidebar(1,1,$db); //(number of active element on menu , 1-specialist widet ON, connection)?>
            </div>
            <div class="box-2">
                <div class="box-title">
                    <h3>Новини</h3>
                </div>
                <div class="nContainer">   
                    <?
                        $ph = mysqli_query($db, "SELECT * FROM news ORDER BY news.id DESC LIMIT 3");
                        $ii = 5;//кількість постів у колонкі
                        while ($bbb=mysqli_fetch_row($ph)) 
                        {
                            if ($ii>0) {
                            ?>
                            <div class='Post'>
                                <h1 class='sTitle'>
                                    <?echo "$bbb[1]";?>
                                </h1>   
                                <br>
                                <?php $DATE = DateTimeConvert($bbb[5]);
                                echo "<p class='dateT'>Опубліковано: $DATE</p>"; ?>
                                <p class="ContentPost">
                                    <?//декодування фотки
                                        $file = $bbb[4];
                                        $img = str_replace('data:image/png;base64,', '', $file); 
                                        
                                        file_put_contents("news/$bbb[3]", base64_decode($img));             //розкодовує фотку з БД і створює файл з назвою $path .png
                                    
                                        if ($file) {
                                            echo "<img src='news/$bbb[3]' class='sImg'>";
                                        }

                                        $ttext = str_split($bbb[2],900);

                                        echo "<span class='sText'> $ttext[0] "."..."."<a class='shareLink' href='../News/news.php#$bbb[0]'>детальніше</a></span>";  
                                    ?>   
                                </p>
                                
                            </div><?php 
                            }
                            $ii-=1;
                        }
                    ?>    
                </div>
            </div>
            <div class="box-3">
                <div class="box-title">
                    <h3>Корисна інформація</h3>
                </div>
                <div  class="uContainer">
                <?
                    $ph = mysqli_query($db, "SELECT * FROM info ORDER BY info.id DESC");
                    $i = 5; //кількість постів у колонкі
                    while ($bbb=mysqli_fetch_row($ph)) 
                    {
                        if ($i>0) {
                            ?>
                            <div class='Post'>
                                <h1 class='sTitle'>
                                    <?echo "$bbb[1]";?>
                                </h1>
                                <?php $DATE = DateTimeConvert($bbb[5]);
                                 echo "<p class='dateT'>Опубліковано: $DATE</p>"; ?>
                                <p class="ContentPost">
                                    <?//декодування фотки
                                        $file = $bbb[4];
                                        $img = str_replace('data:image/png;base64,', '', $file); 
                                        $path = $bbb[3];
                                        
                                        file_put_contents("info/$path", base64_decode($img));             //розкодовує фотку з БД і створює файл з назвою $path .png
                                    ?>
                                    <img src='info/<?=$path?>' class='sImg'>
                                    <?php
                                        $ttext = str_split($bbb[2],900);
                                        
                                        echo "<span class='sText'> $ttext[0] "."..."."<a class='shareLink' href='../Info/info.php#$bbb[0]'>детальніше</a></span>"; ?>                                   
                                </p>
                            </div><? 
                        }
                        $i-=1;
                    }?>
                </div>
            </div>
        </div>
        <?php 
            makeFooter();  //footer
        ?>
    </div>


</body>
</html>
<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();
?>