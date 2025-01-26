<?php
function get_user_data($con, $userName)
{
    $query = "SELECT * FROM Users WHERE username = '$userName'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
        return $userData;
    }

    $_SESSION['error_message'] = "User not found.";
    header("Location: login.php");
    die;
}

function check_login($con, $userName, $password)
{
    if (isset($_SESSION['username'])) {
        $userName = $_SESSION['username'];
        $userData = get_user_data($con, $userName);

        if ($userData) {
            return $userData;
        }
    }
    header("Location: login.php");
    die;
}

function go_to_login() {
    echo '<div style="text-align: center; margin-top: 50px;">';
    echo '<p>You need to be logged in to continue.</p>';
    echo '<button onclick="window.location.href = \'login.php\';">Login</button>';
    echo '<button onclick="continueScrolling();">Continue Scrolling</button>';
    echo '</div>';
    echo '<script>';
    echo 'function continueScrolling() {';
    echo '    window.location.href = \'home.php\';';
    echo '}';
    echo '</script>';
}
?>
