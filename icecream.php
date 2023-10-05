<?php
require("./connection1.php");
session_start();
print_r($_SESSION);

$icecream = $ingredients = $flavor = "";
$errors = ["icecream" => "", "ingredients" => "", "flavor" => ""];

if (isset($_POST)) {
    print_r($_POST);
    if (empty($_POST["icecream"])) {
        $errors["icecream"] = "Ice cream name is required";
    } else {
        if (!preg_match('/^[a-zA-Z\s]+$/', $_POST["icecream"])) {
            $errors["icecream"] = "Ice cream must be alphabets only";
        }
    }
    if (empty($_POST["ingredients"])) {
        $errors["ingredients"] = "Ingredients are required";
    } else {
        if (!preg_match('/^([a-zA-Z\s]+)(,[a-zA-Z\s]*)*$/', $_POST["ingredients"])) {
            $errors["ingredients"] = "Ingredients must be alphabets only";
        }
    }
    if (empty($_POST["flavor"])) {
        $errors["flavor"] = "Flavor name is required";
    } else {
        if (!preg_match('/^[a-zA-Z\s]+$/', $_POST["flavor"])) {
            $errors["flavor"] = "Flavor must be alphabets only";
        }
    }

    if (array_filter($errors)) {
        echo ("Errors in all inputs");
    } else {
        $icecream = $_POST["icecream"];
        $ingredients = $_POST["ingredients"];
        $flavor = $_POST["flavor"];
        $user_id = $_SESSION["user_id"];
        if(!$user_id){
            echo"Unauthorized";
            header("Location:signup.php");
        }else{
            $query = "INSERT INTO icecream (icecream, ingredients, flavor, user_id) VALUES('$icecream', '$ingredients', '$flavor', '$user_id')";
            if (mysqli_query($connect, $query)) {
                echo ("Data added successfully");
            } else {
                echo "Connection error" . mysqli_error($connect);
            }
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <form action="icecream.php" method="post" class="container card shadow-lg mx-auto p-5">
        <h6 class="text-center text-muted display-6">Ice-Cream</h6>
        <input name="icecream" placeholder="icecream" type="text" class="form-control mb-3">
        <p class="text-danger"><?php echo $errors["icecream"] ?></p>

        <input name="ingredients" placeholder="ingredients" type="text" class="form-control mb-3">
        <p class="text-danger"><?php echo $errors["ingredients"] ?></p>

        <input name="flavor" placeholder="flavor" type="text" class="form-control mb-3">
        <p class="text-danger"><?php echo $errors["flavor"] ?></p>

        <div>
            <button class="btn btn-dark">Submit</button>
        </div>
    </form>
    <div class="card shadow-lg container mx-auto">
        <h6 class = "display-6 text-muted text-center">Ice cream orders</h6>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Ice cream name</th>
                    <th>Ingredients</th>
                    <th>Flavor</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM icecream";
                $result = mysqli_query($connect, $query);
                $icecreams = mysqli_fetch_all($result, MYSQLI_ASSOC);
                foreach ($icecreams as $icecream) {
                    echo "<tr>";
                    echo "<td>" . $icecream["id"] . "</td>";
                    echo "<td>" . $icecream["icecream"] . "</td>";
                    echo "<td>" . $icecream["ingredients"] . "</td>";
                    echo "<td>" . $icecream["flavor"] . "</td>";
                    echo "<td><a href='delete.php?id=" . $icecream["id"] . "' class='btn btn-dark'>Delete</a></td>";
                    echo "<td><a href='edit.php?id=" . $icecream["id"] . "' class='btn btn-dark'>Edit</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>