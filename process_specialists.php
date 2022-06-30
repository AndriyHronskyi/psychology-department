<?php
    require 'dbconfig.php';

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $secondname = $_POST['secondname'];
    $position = $_POST['position'];
    $bio = $_POST['bio'];
    $link = $_POST['link'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $date = date("Y-m-d H:i:s");
    
    $addspecialist = $_POST['addspecialist'];   //submit
    
        
if (isset($_POST['addspecialist'])) {
    $targetDir = "Specialists/Upload/";
    
    $allowedType = array('jpeg','png');
    $successmsg = $errormsg = '';
    
    if (!empty(array_filter($_FILES['files']['name']))) {
        foreach ($_FILES['files']['name'] as $key => $value) {
            $filename   = $_FILES['files']['name'][$key];   //+
            $temLoc     = $_FILES['files']['tmp_name'][$key]; //+
            $targetPath = $targetDir. $filename;
            $fileType   = pathinfo($targetPath,PATHINFO_EXTENSION);
            $sqlValues = "";

            if (in_array($fileType, $allowedType)) {
                if (move_uploaded_file($temLoc, $targetPath)) {
                    //завантаження файлу в бд
                    $fileG = chunk_split(base64_encode(file_get_contents($targetPath)));
                    //запит в бд
                    $sqlValues = "('".$firstname."','".$lastname."','".$secondname."','".$position."','".$bio."','".$link."','".$phone."','".$email."','".$filename."','".$fileG."')";
                    //$sqlValuesS = "('".$filename."','".$fileG."')";  // для usersPortret - таблиці з іконками спеціалістів/юзерів у чаті для запитань
                }else {
                    $errormsg = "Could not Able to Upload Files to Folder";
                }
            }else {
                $errormsg = "File Type Error";
            }

            //insert into database
            if (!empty($sqlValues)) {
                $querry = "";

                $querry = "INSERT INTO specialists(firstname,lastname,secondname,position,bio,link,phone,email,filename,photo) VALUES".$sqlValues; 
                //$usersPortret = "INSERT INTO usersportret(filename_s,photo_s) VALUES".$sqlValuesS; // для usersPortret - таблиці з іконками спеціалістів/юзерів у чаті для запитань
                if (mysqli_query($db,$querry)) {  

                    // для usersPortret - таблиці з іконками спеціалістів/юзерів у чаті для запитань
                    //mysqli_query($db,$usersPortret);

                    //-----------
                    $successmsg .= "File ".$filename." are uploaded Successfully"."<br>";
                    header("Location: ../adminPanel.php");
                }else {
                    $errormsg = " Database Error";
                }
            }
        }
    }
}


/*
тут лише відправка змін в бд
*/
if (isset($_POST['red-Specialist'])) {

    $redSpecialistId = $_POST['redSpecialistId'];
    $targetDir = "Specialists/Upload/";
    
    $allowedType = array('jpeg','png');
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

                    $sqlValues = "firstname = '$firstname' , lastname = '$lastname' , secondname = '$secondname' , position = '$position' , bio = '$bio' , link = '$link' , phone = '$phone' , email = '$email' , filename = '$filename' , photo = '$fileG' WHERE specialists.id = '$redSpecialistId'";
                    $querry = "UPDATE specialists SET ".$sqlValues;
                    
                    if(mysqli_query($db,$querry)){
                        header("Location: ../adminPanel.php");
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
        $sqlValues = "firstname = '$firstname' , lastname = '$lastname' , secondname = '$secondname' ,";
        $sqlValues .= " position = '$position' , bio = '$bio' , link = '$link' , phone = '$phone' , email = '$email' WHERE specialists.id = '$redSpecialistId'";
        $querry = "UPDATE specialists SET ".$sqlValues;
        
        if(mysqli_query($db,$querry)){
            header("Location: ../adminPanel.php");
        }else {
            echo"<p>Failed!!</p>";
        }
    }
}


if (isset($_POST['delSpecialistResult'])) {
    $successmsg = $errormsg = '';
    
    $id =  $_POST['delSpecialist'];

    $querry = "DELETE FROM specialists WHERE specialists.id = ".$id;      
    if (mysqli_query($db,$querry)) {
        //-----------
        $successmsg .= "Post ".$filename." are uploaded Successfully"."<br>";
        header("Location: ../adminPanel.php");
    }else {
        $errormsg = " Database Error";
    }
}      
?>


<script>
    //var form = document.forms[0]; // находим первую форму на странице
    //form.submit(); // вызываем её метод сабмит

</script>