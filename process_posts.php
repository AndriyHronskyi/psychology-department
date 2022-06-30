<?php
    require 'dbconfig.php';

    /*отримати всі данні з форми */
    //add new Post
    $type = $_POST['type'];

    $newTitle = $_POST['newTitle'];
    $newText = $_POST['newText']; 

    $year = $_POST['year'];
    $hyear = $_POST['hyear'];

    $date = date("Y-m-d H:i:s");
        
    if (isset($_POST['add-post'])) {
        $targetDir = "upload/";
        switch ($type) {
            case 'news':
                $targetDir = "News/upload/";
                break;
            case 'plans':
                $targetDir = "Plans/upload/";
                break;

            case 'laws':
                $targetDir = "Laws/upload/";
                break;

            case 'info':
                $targetDir = "Info/upload/";
                break;

            case 'research':
                $targetDir = "Research/upload/";
                break;

            case 'activities':
                $targetDir = "About Us/upload/";
            break;
            default:
                $targetDir = "upload/";
                break;
        }
        
        $allowedType = array('pdf','jpeg','png');
        $successmsg = $errormsg = '';
        
        if (empty($_FILES['files']['name'])) {
            if ($type == 'basicProvisions') {
            
                $newText1 = $_POST['newText-1']; 
                $newText2 = $_POST['newText-2']; 
                $newText3 = $_POST['newText-3']; 
                $newText4 = $_POST['newText-4']; 
                $newText5 = $_POST['newText-5']; 
                $newText6 = $_POST['newText-6']; 
                $newText7 = $_POST['newText-7']; 
                $newText8 = $_POST['newText-8']; 
                $newText9 = $_POST['newText-9']; 
                $newText10 = $_POST['newText-10']; 
    
                $sqlValues = "('".$newText."','".$newText1."','".$newText2."','".$newText3."','".$newText4."','".$newText5."','".$newText6."','".$newText7."','".$newText8."','".$newText9."','".$newText10."')";           
                if (!empty($sqlValues)) {
                    $querry  = "INSERT INTO aboutus(title,li1,li2,li3,li4,li5,li6,li7,li8,li9,li10) VALUES".$sqlValues;         
                }
                if (mysqli_query($db,$querry)) {
                    //-----------
                    $successmsg .= "File ".$filename." are uploaded Successfully"."<br>";
                    header("Location: /adminPanel.php");
                }else {
                    $errormsg = " Database Error";
                }
            }
        }else {
            if (!empty(array_filter($_FILES['files']['name']))) {
                foreach ($_FILES['files']['name'] as $key => $value) {
                    $filename   = $_FILES['files']['name'][$key];   //+
                    $temLoc     = $_FILES['files']['tmp_name'][$key]; //+
                    $targetPath = $targetDir. $filename;
                    $fileType   = pathinfo($targetPath,PATHINFO_EXTENSION);
                    $date       = date('Y-m-d H:i:s');
    
                    if (in_array($fileType, $allowedType)) {
                        if (move_uploaded_file($temLoc, $targetPath)) {
                            //завантаження файлу в бд
                            $fileG = chunk_split(base64_encode(file_get_contents($targetPath)));
                            $sqlValues = "";
                            switch ($type) {
                                case 'news':
                                    $sqlValues = "('".$newTitle."','".$newText."','".$filename."','".$fileG."','".$date."')";           //to add another param copy:    ,'".$nameVariable."'
                                    break;
                                case 'plans': 
                                    $sqlValues = "('".$filename."','".$fileG."','".$year."','".$hyear."')";           //to add another param copy:    ,'".$nameVariable."'
                                    break;
                                case 'laws':
                                    $sqlValues = "('".$newTitle."','".$filename."','".$fileG."','".$date."')";           //to add another param copy:    ,'".$nameVariable."'
                                    break;
                                case 'info':
                                    $sqlValues = "('".$newTitle."','".$newText."','".$filename."','".$fileG."','".$date."')";           //to add another param copy:    ,'".$nameVariable."'
                                    break;
                                case 'research':
                                    $sqlValues = "('".$newTitle."','".$newText."','".$filename."','".$fileG."','".$date."')";           //to add another param copy:    ,'".$nameVariable."'
                                    break; 
                                case 'activities':
                                    $sqlValues = "('".$newTitle."','".$filename."','".$fileG."')";           //to add another param copy:    ,'".$nameVariable."'
                                    break; 
                            }
                        }else {
                            $errormsg = "Could not Able to Upload Files to Folder";
                        }
                    }else {
                        $errormsg = "File Type Error";
                    }
    
                    //insert into database
                    if (!empty($sqlValues)) {
                        $querry = "";
    
                        //different configuration querries
                        switch ($type) {
                            case 'news':
                                $querry = "INSERT INTO news(title,text,filename,image,date) VALUES".$sqlValues;           
                                break;
                            case 'plans':
                                $querry = "INSERT INTO plans(filename,data,syear,hyear) VALUES".$sqlValues;          
                                break;
                            case 'laws':
                                $querry = "INSERT INTO laws(title,filename,file,datetime) VALUES".$sqlValues;           
                                break;
                            case 'info':
                                $querry = "INSERT INTO info(title,text,filename,image,date) VALUES".$sqlValues;          
                                break;
                            case 'research':
                                $querry = "INSERT INTO research(title,text,filename,file,datetime) VALUES".$sqlValues;         
                                break; 
                            case 'activities':
                                $querry = "INSERT INTO aboutusph(title,filename,file) VALUES".$sqlValues;         
                                break;
                        }
    
                        if (mysqli_query($db,$querry)) {
                            //-----------
                            $successmsg .= "File ".$filename." are uploaded Successfully"."<br>";
                            header("Location: /adminPanel.php");
                        }else {
                            $errormsg = " Database Error";
                            echo $errormsg;
                        }
                    }
                }
            }
        }
    }


    /*
    тут лише відправка змін в бд
    */
    if (isset($_POST['red-post'])) {
        $newTitle = $_POST['redTitle'];
        $newText = $_POST['redText'];
        $resultId = $_POST['resultId'];

        $type = $_POST['typeredpost'];
        $targetDir = "upload/";
        switch ($type) {
            case 'news':
                $targetDir = "News/upload/";
                break;
            case 'plans':
                $targetDir = "Plans/upload/";
                break;

            case 'laws':
                $targetDir = "Laws/upload/";
                break;

            case 'info':
                $targetDir = "Info/upload/";
                break;

            case 'research':
                $targetDir = "Research/upload/";
                break;
            default:
                $targetDir = "upload/";
                break;
        }
        
        $allowedType = array('pdf','jpeg','png');
        $successmsg = $errormsg = '';
        
        //якшо багато шо міняєм, точно міняєм файли
        if (!empty(array_filter($_FILES['files']['name']))) {
            foreach ($_FILES['files']['name'] as $key => $value) {
                $filename   = $_FILES['files']['name'][$key];   //+
                $temLoc     = $_FILES['files']['tmp_name'][$key]; //+
                $targetPath = $targetDir. $filename;
                $fileType   = pathinfo($targetPath,PATHINFO_EXTENSION);

                if (in_array($fileType, $allowedType)) {
                    if (move_uploaded_file($temLoc, $targetPath)) {
                        //завантаження файлу в бд
                        $fileG = chunk_split(base64_encode(file_get_contents($targetPath)));
                        $sqlValues = "";
                        $querry = "";
                        switch ($type) {
                            case 'news':
                                //echo"id = $resultId <br> title = $newTitle <br> text = $newText <br> filename = $filename <br> image = $fileG <br> date = $date"; die;
                                $sqlValues = "title = '$newTitle' , text = '$newText' , filename = '$filename' , image = '$fileG' , date = '$date' WHERE news.id = '$resultId'";
                                $querry = "UPDATE news SET ".$sqlValues;
                                
                                break;
                            case 'plans':
                
                                $sqlValues = "filename = '$filename' , data = '$fileG' , syear = '$year' , hyear = '$hyear' WHERE plans.id = '$resultId'";
                                $querry = "UPDATE plans SET ".$sqlValues;
                                break;
                            case 'laws':
                                /*--- */
                                $sqlValues = "title = '$newTitle' , filename = '$filename' , file = '$fileG' , datetime = '$date' WHERE plans.id = '$resultId'";
                                $querry = "UPDATE laws SET ".$sqlValues;         
                                break;
                            case 'info':
                                $sqlValues = "title = '$newTitle' , text = '$newText' , filename = '$filename' , image = '$fileG' , date = '$date' WHERE info.id = '$resultId'";
                                $querry = "UPDATE info SET ".$sqlValues;
                                break;
                            case 'research':
                                $sqlValues = "title = '$newTitle' , text = '$newText' , filename = '$filename' , image = '$fileG' , date = '$date' WHERE research.id = '$resultId'";
                                $querry = "UPDATE research SET ".$sqlValues;       
                                break; 
                            case 'activities':
                                /*--- */
                                $sqlValues = "title = '$newTitle' , filename = '$filename' , file = '$fileG' , datetime = '$date' WHERE plans.id = '$resultId'";
                                $querry = "UPDATE laws SET ".$sqlValues;         
                                break;
                        }
                       
                        if(mysqli_query($db,$querry)){
                            header("Location: adminPanel.php");
                        }else {
                            echo"<p>Failed!!</p>";
                        }
                    }else {
                        $errormsg = "Could not Able to Upload Files to Folder";
                    }
                }else {
                    $errormsg = "File Type Error";
                }
            }
        }else {  //якщо немає нових файлів
            $sqlValues = "";
            $querry = "";
            $newTitle = $_POST['redText'];
            $filename = $_POST['redTitle'];
            switch ($type) {
                case 'news':
                    //echo"id = $resultId <br> title = $newTitle <br> text = $newText <br> filename = $filename <br> image = $fileG <br> date = $date"; die;
                    $sqlValues = "title = '$newTitle' , text = '$newText' , date = '$date' WHERE news.id = '$resultId'";
                    $querry = "UPDATE news SET ".$sqlValues;
                    
                    break;
                case 'plans':
                    $sqlValues = "filename = '$filename' , syear = '$year' , hyear = '$hyear' WHERE plans.id = '$resultId'";
                    $querry = "UPDATE plans SET ".$sqlValues;
                    break;
                case 'laws':
                    /*--- */
                    $sqlValues = "title = '$newTitle', filename = '$filename' , datetime = '$date' WHERE laws.id = '$resultId'";
                    $querry = "UPDATE laws SET ".$sqlValues;         
                    break;
                case 'info':
                    $sqlValues = "title = '$newTitle' , text = '$newText' , date = '$date' WHERE info.id = '$resultId'";
                    $querry = "UPDATE info SET ".$sqlValues;
                    break;
                case 'research':
                    $sqlValues = "title = '$newTitle' , text = '$newText' , date = '$date' WHERE research.id = '$resultId'";
                    $querry = "UPDATE research SET ".$sqlValues;       
                    break; 
                case 'basicProvisions':
                        $redText1 = $_POST['redText-1']; 
                        $redText2 = $_POST['redText-2']; 
                        $redText3 = $_POST['redText-3']; 
                        $redText4 = $_POST['redText-4']; 
                        $redText5 = $_POST['redText-5']; 
                        $redText6 = $_POST['redText-6']; 
                        $redText7 = $_POST['redText-7']; 
                        $redText8 = $_POST['redText-8']; 
                        $redText9 = $_POST['redText-9']; 
                        $redText10 = $_POST['redText-10']; 
                        
                    $sqlValues = "title = '$newTitle' , li1 = '$redText1' , li2 = '$redText2' , li3 = '$redText3' , li4 = '$redText4' , li5 = '$redText5' , li6 = '$redText6' , li7 = '$redText7' , li8 = '$redText8' , li9 = '$redText9' , li10 = '$redText10'  WHERE aboutus.id = '$resultId'";
                    $querry = "UPDATE aboutus SET ".$sqlValues;       
                break;
            }
            if(mysqli_query($db,$querry)){
                header("Location: adminPanel.php");
            }else {
                echo"<p>Failed!!</p>";
            }
        }
    }


if (isset($_POST['delpostresult'])) {
    $successmsg = $errormsg = '';
    
    $id =  $_POST['delpost'];
    $Id;                        //ініціалізація

    //Перевірка $id, чи вибрано декілька елементів. Якщо обрати один елемент, то без цього буде помилка: "Parameter must be an array or an object that implements Countable"
    if (is_array($id)) {                 
        $Id = count($id);
    }else {
        $Id = $id;
    }
    
    $querry = "";
        for ($i=0; $i < $Id; $i++) { 
            //different configuration querries
            switch ($_POST['deltype']) {
                case 'news':
                    $iD = " news.id = ".$id[$i].";";
                    $querry = "DELETE FROM news WHERE".$iD;      
                    break;
                case 'plans':
                    /* TT56*/
                    $iD = " plans.id = ".$id[$i].";";
                    $querry = "DELETE FROM plans WHERE".$iD;        
                    break;
                case 'laws':
                    $iD = " laws.id = ".$id[$i].";";
                    $querry = "DELETE FROM laws WHERE".$iD;          
                    break;
                case 'info':
                    $iD = " info.id = ".$id[$i].";";
                    $querry = "DELETE FROM info WHERE".$iD;         
                    break;
                case 'research':
                    $iD = " research.id = ".$id[$i].";";
                    $querry = "DELETE FROM research WHERE".$iD;         
                    break; 
                case 'basicProvisions':
                    $iD = " aboutus.id = ".$id[$i].";";
                    $querry = "DELETE FROM aboutus WHERE".$iD;         
                    break;
                case 'activities':
                    $iD = " aboutusph.id = ".$id[$i].";";
                    $querry = "DELETE FROM aboutusph WHERE".$iD;         
                    break;
            }
        }
                

                if (mysqli_query($db,$querry)) {
                    //-----------
                    $successmsg .= "Post ".$filename." are delete Successfully"."<br>";
                    header("Location: /adminPanel.php");
                }else {
                    $errormsg = " Database Error";
                }
            
        
    
}


    /*
    if (!empty($successmsg)) {
       echo $successmsg; die;
    }elseif (!empty($errormsg)){
        echo $errormsg; die;
    }
     */  

?>


<script>
    //var form = document.forms[0]; // находим первую форму на странице
    //form.submit(); // вызываем её метод сабмит

</script>