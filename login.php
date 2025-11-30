<?php
include("config/connect.php");
session_start();

$error = "";

if (isset($_POST['loginButton'])) {

    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $username = str_replace("'", "", $username);
    $password = str_replace("'", "", $password);

    $_SESSION['username'] = "";
    $_SESSION['password'] = "";
    $_SESSION['userID'] = "";
    $_SESSION['userlevel'] = "";


    $loginUserQuery = "SELECT * FROM users 
                       WHERE username = '$username' 
                       AND password = '$password' 
                       AND isActive = 'YES'";

    $userResult = executeQuery($loginUserQuery);

    if (mysqli_num_rows($userResult) > 0) {

        while ($userRows = mysqli_fetch_assoc($userResult)) {
            $_SESSION['username'] = $userRows['username'];
            $_SESSION['password'] = $userRows['password'];
            $_SESSION['userID'] = $userRows['userID'];
            $_SESSION['userlevel'] = $userRows['userlevel'];

            $userlevel = $userRows['userlevel'];
        }

        if ($userlevel == "customer") {
            header("Location: User/concept.php");
        } else {
            header("Location: Admin/motorcycle_concept_shop.php");
        }
        exit();

    } else {
        $error = "Invalid Credentials";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="row w-100">
            <div class="col-md-4 mx-auto">
                <div class="card shadow p-4 login-box">
                    <h2 class="text-center mb-3">Login</h2>

                    <?php if ($error != "") { ?>
                        <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                    <?php } ?>

                    <form method="post">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>

                        <button type="submit" name="loginButton" class="btn btn-primary w-100">Login</button>

                        <p class="text-center mt-3">
                            Don't have an account?
                            <a href="signup.html">Sign Up</a>
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </div>

</body>

</html>