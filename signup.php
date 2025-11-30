<?php
include("config/connect.php");

session_start();

$_SESSION['userID'] = "";
$_SESSION['firstname'] = "";
$_SESSION['lastname'] = "";
$_SESSION['username'] = "";

$error = "";

if (isset($_POST['btnSignUp'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $cpnumber = $_POST['cpnumber'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // remove apostrophes
    $firstname = str_replace("'", "", $firstname);
    $lastname = str_replace("'", "", $lastname);
    $age = str_replace("'", "", $age);
    $address = str_replace("'", "", $address);
    $cpnumber = str_replace("'", "", $cpnumber);
    $username = str_replace("'", "", $username);
    $password = str_replace("'", "", $password);
    $confirmPassword = str_replace("'", "", $confirmPassword);

    // check if username already exists
    $checkQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $error = "USERNAME_EXISTS";

    } elseif ($password == $confirmPassword) {

        // insert user
        $insertUser = "INSERT INTO users 
        (firstname, lastname, age, address, cpnumber, username, password, userlevel, isActive)
        VALUES 
        ('$firstname', '$lastname', '$age', '$address', '$cpnumber', '$username', '$password', 'customer', 'YES')";

        mysqli_query($conn, $insertUser);

        $lastID = mysqli_insert_id($conn);

        $_SESSION['userID'] = $lastID;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['username'] = $username;

        header("Location: login.php?signup=success");
        exit();

    } else {
        $error = "PASSWORD_MISMATCH";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <div class="login-bg-cover d-flex align-items-center justify-content-center" style="min-height:100vh;">
        <div class="container mt-4 pt-4">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="text-white p-4 rounded-4" style="background-color: #007bff;">

                        <div class="text-center mb-4">
                            <h1 class="fw-bold">Sign Up</h1>
                        </div>

                        <?php if ($error == "USERNAME_EXISTS") { ?>
                            <div class="alert alert-warning text-center mb-3">Username already exists.</div>
                        <?php } elseif ($error == "PASSWORD_MISMATCH") { ?>
                            <div class="alert alert-danger text-center mb-3">Passwords do not match.</div>
                        <?php } ?>

                        <form method="POST" action="signup.php">

                            <div class="row mb-2">
                                <div class="col-12 col-md-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="firstname" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lastname" required>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Age</label>
                                    <input type="number" class="form-control" name="age" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" name="cpnumber" required>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col mx-auto d-grid mb-3">
                                <button type="submit" name="btnSignUp"
                                    class="btn btn-light text-primary fw-semibold rounded-3">Sign Up</button>
                            </div>
                        </form>

                        <p class="text-center mb-1">
                            Already have an account?
                            <a href="login.php" class="text-white fw-semibold">Login here</a>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
