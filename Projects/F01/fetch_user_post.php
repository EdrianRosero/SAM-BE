<?php
session_start();
include 'connection.php';
include 'functions.php';

$userData = get_user_data($con, $_SESSION['username']);
$userName = $userData['username'];

$query = "SELECT posts.id, posts.anonymous, users.displayname, posts.text, posts.likecount, CAST(posts.timestamp AS CHAR) AS timestamp
          FROM posts
          INNER JOIN users ON posts.user_id = users.id
          WHERE users.username = '$userName'
          ORDER BY posts.timestamp DESC";

$result = mysqli_query($con, $query);

if ($result) {
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($posts);
} else {
    echo json_encode(['error' => 'Failed to fetch data']);
}
?>