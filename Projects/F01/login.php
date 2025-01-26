<?php
session_start();
include("connection.php");
include("functions.php");

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $userName = trim($_POST['username']);
    $userPassword = trim($_POST['password']);

    if (!empty($userName) && !empty($userPassword)) {
        // Prepared statements to prevent SQL injection
        $query = $con->prepare("SELECT * FROM users WHERE username = ?");
        $query->bind_param("s", $userName);
        $query->execute();
        $result = $query->get_result();

        if ($result && $result->num_rows > 0) {
            $userData = $result->fetch_assoc();

            if ($userPassword === $userData['password']) {
                $_SESSION['username'] = $userData['username'];
                header("Location: home.php");
                exit();
            } else {
                $errorMessage = "Wrong password.";
            }
        } else {
            $errorMessage = "User not found.";
        }
    } else {
        $errorMessage = "Please enter both username and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>The Olympians</title>
    <link rel="icon" href="assets/imgs/tab-Icon.png" type="image/x-icon" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="assets/account_registration_style.css" rel="stylesheet">
</head>

<body>
    <div class="registration">
        <div class="container registrationContainer">
            <div class="row g-3">
                <div class="col-lg-6 col-sm-12 d-flex align-items-center">
                    <div class="p-3">
                        <img src="assets/imgs/landingPage-Icon.png" class="img-fluid profileImg" alt="Profile Image">
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 d-flex align-items-center justify-content-center p-3">
                    <div class="form-box">
                        <form action="" method="post">
                            <h1>Login</h1>

                            <!-- Error Message -->
                            <?php if (!empty($errorMessage)): ?>
                                <div class="error-message show">
                                    <?= htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'); ?>
                                </div>
                            <?php endif; ?>

                            <div class="input-box">
                                <input type="text" name="username" placeholder="Username" required autocomplete="off">
                                <i class='bx bxs-user'></i>
                            </div>
                            <div class="input-box">
                                <input type="password" name="password" placeholder="Password" required
                                    autocomplete="new-password">
                                <i class='bx bxs-lock'></i>
                            </div>
                            <button type="submit" class="btn">Log In</button>

                            <div class="register">
                                <p>Don't have an account? <a href="register.php">Register</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>