<?php

function makeHeader($image,$hTitle){
    echo"<header>
        <div class='container-0'>";
        if ($image == 1) {
            echo"<div class='Hhead'>
                <a href='adminPanel.php'>
                    <img id='HImg' src='Main/index.png'>
                </a>
            </div>";
        }
        if ($hTitle) {
            echo"<div class='Hhead'>
                <h1>$hTitle</h1>
            </div>";
        } 
        echo"</div>
    </header>";
}
?>