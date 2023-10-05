<?php
require("./connection1.php");
session_start();


$email = $password = "";
$errors = ["email" => "", "password" => ""];

if (isset($_POST)) {
    print_r($_POST);
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
        $email = $_POST["email"];
        // $password = password_hash($_POST["password"], $result["password"]);
        
        $query1 = "SELECT * FROM users WHERE email = '$email'";
        $testUser = mysqli_query($connect, $query1);
        $result = mysqli_fetch_assoc($testUser);
        print_r($result);
        if (!$result) {
            echo "You do not have an account with us";
        } else{
            print_r(password_verify($_POST["password"], $result["password"]));
            if(!password_verify($_POST["password"], $result["password"])){
                echo "Invalid password";
            }else{
                $_SESSION["user_id"] = $result["id"];
                setcookie($user_id, $result["id"], time()+86400);
                header("Location: icecream.php");
                //To delete a session, use unset($_SESSION["user_id"])
                //To clear all sessions, use session_unset()
                //To clear all cookies, use session_destroy()
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
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" class="container card shadow-lg mx-auto p-5">
        <h6 class="text-center text-muted display-6">Login</h6>
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