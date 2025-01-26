<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = json_decode(file_get_contents('php://input'), true);
    $postId = $requestData['postId'];
    $isLiked = $requestData['isLiked'];

    // Prepared statement to prevent SQL injection
    if ($isLiked) {
        $sql = "UPDATE posts SET likecount = likecount - 1 WHERE id = ? AND likecount > 0";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('i', $postId);  // 'i' means integer
    } else {
        $sql = "UPDATE posts SET likecount = likecount + 1 WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('i', $postId);  // 'i' means integer
    }

    // Execute and check for success
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error: ' . $stmt->error;
    }

    // Close the prepared statement and connection
    $stmt->close();
} else {
    echo 'error: Unsupported request method';
}

$con->close();
?>
