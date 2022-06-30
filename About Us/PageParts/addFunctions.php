<?php
function DateTimeConvert($str){
    //$str = "2021-07-02 01:38:39";  як приклд
    $date = str_split($str,10);   // ділимо на дві частини "2021-07-02"   і " 01:38:39"

        //time
        $date[1] = str_replace(' ', '', $date[1]);  //видаляємо пробіл спочатку
        $tBuff = str_split($date[1],5);             //відділяємо мілісекунди "01:38" і ":39" 
        $dTime = $tBuff[0];                         //обираємо "01:38"

        //date
        $date[0] = str_replace('-', '', $date[0]);  //видаляємо тире

        $year;
        $mounth;
        $day;

        $dBuff = str_split($date[0],2);  // ділимо  2021-07-02  по два символи

        for ($i = 0; $i <= 3; $i+=1){
            if($i <= 1){
                $year = $dBuff[$i];
                $year .= $dBuff[$i+1];
            }
            if($i = 2){
                $mounth= $dBuff[$i];
            }
            if($i = 3){
                $day= $dBuff[$i];
            }
        }

        //Назви місяців
        $mounths = array("01"=>"Січня", 
                        "02"=>"Лютого", 
                        "03"=>"Березня",
                        "04"=>"Квітня",
                        "05"=>"Травня",
                        "06"=>"Червня",
                        "07"=>"Липня",
                        "08"=>"Серпня",
                        "09"=>"Вересня",
                        "10"=>"Жовтня",
                        "11"=>"Листопада",
                        "12"=>"Грудня");
        foreach ($mounths as $x => $value) {
            if ($x == $mounth) {
                $mounth = $value;
                continue;
            }
        }
        if ($day != 10) {
            $day = str_replace('0', '', $day);  //видаляємо нуль з номера дня: було "01" стало "1"
        }

        $Date = $dTime.".  "."  ".$day." ".$mounth." ".$year;
        return $Date;
    }
?>