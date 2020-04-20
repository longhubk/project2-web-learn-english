<?php 

//array data name start oder by alphabet
$a[] = "Anh hung";
$a[] = "Bac si";
$a[] = "Cong an";
$a[] = "Danh thue";
$a[] = "Em gai nuoi";
$a[] = "Fe Fa";
$a[] = "Gunny Army";
$a[] = "Heculus";
$a[] = "Ich loi";
$a[] = "Join Group";
$a[] = "Kiss me";
$a[] = "Lao dong";
$a[] = "Ninja";
$a[] = "Opera mini";
$a[] = "Penta kill";
$a[] = "Queen benh dich";
$a[] = "Soi hoan da";
$a[] = "Thanh pho buon";
$a[] = "Web hoc TA";

$suggest = "";

//looking all the suggest from array above if($q) query is same of differen

$q = $_REQUEST['q'];

if($q !== ""){
  $q = strtolower($q);
  $length = strlen($q);
  foreach($a as $sug){
    if(stristr($q, substr($sug, 0, $length))){
      if($suggest === ""){
        $suggest = $sug;
      }else{
        $suggest .= ", $sug";
      }
    }
  }
}

echo $suggest === "" ? "no suggestion" : $suggest;
?>