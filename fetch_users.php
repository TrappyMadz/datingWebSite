<?php

include 'nonAccessiblePhpPages/bdd.php';

if (isset($_GET['search'])) {

    $search = $_GET['search'] . '%';
    $query = "SELECT pseudo FROM utilisateurs WHERE pseudo LIKE ? LIMIT 5";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $search);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row['pseudo'];
    }
    echo json_encode($users);
} else {
    echo json_encode(array());
}
?>
