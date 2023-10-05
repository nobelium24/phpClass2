<?php
    require("./connection1.php");
    $id = $_GET["id"];
    $query = "DELETE FROM icecream WHERE id = $id";
    if(mysqli_query($connect, $query)){
        header("Location: icecream.php");
    }else{
        echo "Error deleting record" . mysqli_error($connect);
    }

?>