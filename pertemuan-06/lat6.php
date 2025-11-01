<?php 
$hobi = ["Coding", "Memasak", "Musik", "Membaca", "Traveling"]; 
 
echo "<h3>Daftar Hobi Saya:</h3>"; 
for ($i = 0; $i < count($hobi); $i++) { 
  echo ($i + 1) . ". " . $hobi[$i] . "<br>"; 
} 
 
echo "<hr>"; 
echo "<h4>Hasil print_r():</h4>"; 
echo "<pre>"; 
print_r($hobi); 
echo "</pre>"; 
 
echo "<h4>Hasil var_dump():</h4>"; 
echo "<pre>"; 
var_dump($hobi); 
echo "</pre>"; 
?> 