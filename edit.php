<?php
require("./connection1.php");
$id = $_GET['id'];
$query = "SELECT * FROM icecream WHERE id = $id";
$result = mysqli_query($connect, $query);
if (!$result) {
    echo "Error: " . mysqli_error($connect);
} else {
    $icecream = mysqli_fetch_assoc($result);
}

print_r($icecream);

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
<body?>
<form action="icecreamupdate.php" method="post" class="container card shadow-lg mx-auto p-5">
        <h6 class="text-center text-muted display-6">Ice-Cream</h6>
        <input name="icecream" placeholder="icecream" type="text" value="<?php echo $icecream["icecream"] ?>" class="form-control mb-3">


        <input name="ingredients" placeholder="ingredients" type="text" value="<?php echo $icecream["ingredients"] ?>" class="form-control mb-3">


        <input name="flavor" placeholder="flavor" type="text" value="<?php echo $icecream["flavor"] ?>" class="form-control mb-3">
        <input name="id" placeholder="flavor" type="hidden" value="<?php echo $icecream["id"] ?>" class="form-control mb-3">



        <div>
            <button class="btn btn-dark">Submit</button>
        </div>
    </form>
</body>
</html>