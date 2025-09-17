<?php
function addPoints($user_id, $points, $reason) {
    global $conn;
    $sql = "UPDATE users SET points = points + ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $points, $user_id);
    return $stmt->execute();
}

function getWeeklyTopUsers() {
    global $conn;
    $sql = "SELECT user_id, username, points FROM users ORDER BY points DESC LIMIT 10";
    return $conn->query($sql);
}
?>
