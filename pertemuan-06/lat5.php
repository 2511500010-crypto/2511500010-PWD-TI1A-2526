<?php 
$a = 100; 
$b = "100"; 
$c = 0; 
$d = false; 
 
echo "<h3>Perbandingan == dan ===</h3>"; 
echo "\$a == \$b : "; var_dump($a == $b); 
echo "\$a === \$b : "; var_dump($a === $b); 
echo "\$c == \$d : "; var_dump($c == $d); 
echo "\$c === \$d : "; var_dump($c === $d); 
?>

<?php 
$nilai = 80; 
 
if ($nilai >= 90) { 
  echo "A"; 
} elseif ($nilai >= 80) { 
  echo "B"; 
} else { 
  echo "C"; 
} 
?> 