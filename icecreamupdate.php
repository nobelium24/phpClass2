<?php
require("./connection1.php");
$icecream = $_POST["icecream"];
$ingredients = $_POST["ingredients"];
$flavor = $_POST["flavor"];
$id = $_POST['id'];

$query = "UPDATE icecream SET icecream = '$icecream', ingredients = '$ingredients', flavor = '$flavor' WHERE id = '$id'";
$result = mysqli_query($connect, $query);
if (!$result) {
    echo "Error " . mysqli_error($connect);
} else {
    header("Location: icecream.php");
}
?>