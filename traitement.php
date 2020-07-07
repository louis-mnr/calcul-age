<?php
 function calcul_age (){
   if(isset($_POST['birthdate'])){
     $birthdate=strtotime($_POST['birthdate']);
     $day_birthday=date('d', $birthdate);
     $month_birthday=date('m', $birthdate);
     $year_birthday=date('Y', $birthdate);

     $day_today=date('d');
     $month_today=date('m');
     $year_today=date('Y');
     // var_dump($day);
     if($day_birthday>$day_today&&$month_birthday>=$month_today){
       $age=($year_today-$year_birthday)-1;
     }else {
      $age=($year_today-$year_birthday);
     }
   }else {
     echo  "<p> Vous n'avez pas écris de date.</p>"   ;
   }
   echo "Vous avez ".$age. " ans.";
 }
calcul_age();
