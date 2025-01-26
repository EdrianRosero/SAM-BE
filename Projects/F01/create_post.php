<?php
include("connection.php");
include("functions.php");

session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] === 'guest') {
    go_to_login();
} else {
    $userName = $_SESSION['username'];
    $userData = get_user_data($con, $userName);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $displayName = isset($_POST['displayname']) ? $_POST['displayname'] : 'Anonymous';
        $anonymous = isset($_POST['anonymous']) ? 'Y' : 'N';
        $text = isset($_POST['text']) ? $_POST['text'] : '';

        // Insert the post with the user_id in the posts table
        $insertPostQuery = "INSERT INTO posts (timestamp, anonymous, text, likecount, user_id) VALUES (CURRENT_TIMESTAMP, '$anonymous', '$text', 0, '{$userData['id']}')";
        $result = mysqli_query($con, $insertPostQuery);

        if ($result) {
            echo '<meta http-equiv="refresh" content="2;url=home.php">';
            echo '<p>Post successful! Redirecting...</p>';
            exit();
        } else {
            echo "Error inserting into posts table: " . mysqli_error($con);
        }
    }
}
mysqli_close($con);
?>
