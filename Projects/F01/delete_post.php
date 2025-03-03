<?php
include("connection.php");
include("functions.php");

session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] === 'guest') {
    go_to_login();
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $postId = isset($_POST['postId']) ? $_POST['postId'] : null;

        // Directly delete the post from the posts table
        $deletePostQuery = "DELETE FROM posts WHERE id = '$postId'";
        $resultPosts = mysqli_query($con, $deletePostQuery);

        if ($resultPosts) {
            echo json_encode(['success' => true, 'message' => 'Post deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error deleting post from posts table']);
        }
    }
}
?>

