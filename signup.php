<?php
$testEmail = "ogunbaja07@gmail.com";
print_r(filter_var($testEmail, FILTER_VALIDATE_EMAIL));


require("./connection1.php");


$first_name = $last_name = $email = $password = "";
$errors = ["first_name" => "", "last_name" => "", "email" => "", "password" => ""];

if (isset($_POST)) {
    print_r($_POST);
    if (empty($_POST["first_name"])) {
        $errors["first_name"] = "First name name is required";
    } else {
        if (!preg_match('/^[a-zA-Z\s]+$/', $_POST["first_name"])) {
            $errors["first_name"] = "First name must be alphabets only";
        }
    }
    if (empty($_POST["last_name"])) {
        $errors["last_name"] = "Last name are required";
    } else {
        if (!preg_match('/^[a-zA-Z\s]+$/', $_POST["last_name"])) {
            $errors["last_name"] = "Last name must be alphabets only";
        }
    }
    if (empty($_POST["email"])) {
        $errors["email"] = "Email name is required";
    } else {
        if (!preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $_POST["email"])) {
            $errors["email"] = "Email is not valid";
        }
    }
    if (empty($_POST["password"])) {
        $errors["password"] = "Password name is required";
    } else {
        if (!preg_match('/^[a-zA-Z\s]+$/', $_POST["password"])) {
            $errors["password"] = "Password must be alphabets only";
        }
    }

    if (array_filter($errors)) {
        echo ("Errors in all inputs");
    } else {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $query1 = "SELECT * FROM users WHERE email = '$email'";
        $testUser = mysqli_query($connect, $query1);
        $result = mysqli_fetch_assoc($testUser);
        if ($result) {
            echo "Email already in use";
        } else {
            $query = "INSERT INTO users (first_name, last_name, email, password) VALUES('$first_name', '$last_name', '$email', '$password')";
            if (mysqli_query($connect, $query)) {
                echo ("Data added successfully");
                header("Location: signin.php");
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
    <form action="signup.php" method="post" class="container card shadow-lg mx-auto p-5">
        <h6 class="text-center text-muted display-6">Ice-Cream</h6>
        <input name="first_name" placeholder="first_name" type="text" class="form-control mb-3">
        <p class="text-danger"><?php echo $errors["first_name"] ?></p>

        <input name="last_name" placeholder="last_name" type="text" class="form-control mb-3">
        <p class="text-danger"><?php echo $errors["last_name"] ?></p>

        <input name="email" placeholder="email" type="email" class="form-control mb-3">
        <p class="text-danger"><?php echo $errors["email"] ?></p>

        <input name="password" placeholder="password" type="password" class="form-control mb-3">
        <p class="text-danger"><?php echo $errors["password"] ?></p>

        <div>
            <button class="btn btn-dark">Submit</button>
        </div>
    </form>

</body>
</html>