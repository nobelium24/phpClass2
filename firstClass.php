<?php
//Variable declaration in php
$name = "waleGigs";
echo "<h1>" . $name . "</h1>";
$arr1 = [1, 2, 3, 4, 5, 6, 7, 8, 9];
echo $arr1[3];
print_r($arr1);

echo "<br>";

$arr2 = array("name" => "WaleGigs", "age" => 1111, "color" => ["Black", "Green", "Blue"], "club" => "Barca", "isSingle" => true);
print_r($arr2);

echo "<br>";
$color = $arr2["color"];
print_r($color);

$stringOne = "TestRam";

echo "<br>";

echo strlen($stringOne);

echo "<br>";

$stringTwo = "My AY is a considerate man";
echo str_word_count($stringTwo);

echo "<br>";

$name2 = "Lawal";
echo strrev($name2);

echo "<br>";

$sentence = "This here is our PHP class";
echo "The position of 'PHP' is " . strpos($sentence, "PHP");

function test()
{
    global $arr2;

    $arr3 = [3, 4, 5];
}

echo "<br>";

define("arr4", [1, 2, 3, 4, 5,]);
print_r(arr4);
echo "<br>";



$arr3 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
for ($i = 0; $i < count($arr3); $i++) {
    $prod = $arr3[$i] * 7;
    echo "$arr3[$i] X 7 = $prod <br>";
}

$arr4 = ["Wole", "Haity hait", "WaleGigs", "Samad", "Love"];
for ($i = 0; $i < count($arr4); $i++) {
    echo "My name is $arr4[$i], I am a member of SQI <br>";
}

$num1 = 0;
while ($num1 <= 100) {
    echo "$num1 <br>";
    $num1 += 10;
}


$num2 = 0;
do {
    echo "$num2 <br>";
    $num2 += 10;
} while ($num2 <= 100);

$ages = array("WaleGigs" => 21, "Samad" => 16, "Haity hait" => 26, "Love" => 17, "Anu" => 15);
foreach ($ages as $name => $age) {
    echo "$name is $age years old <br>";
}


function operations(int $a, int $b) {
    $add = $a + $b;
    $subtract = $a - $b;
    $divide = $a / $b;
    $multiply = $a * $b;
    $modulo = $a % $b;
    return [$add, $subtract, $divide, $multiply, $modulo];
}

$arr5 = operations(10, 5);
print_r($arr5);

    ?>

