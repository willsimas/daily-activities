<?php
// delete_activity.php
include_once '../includes/ActivityHandler.php'; // Ajuste o caminho conforme necessário
// include_once '../session/session.php';

// if (!isLoggedIn()) {
//     header('HTTP/1.1 403 Forbidden');
//     echo json_encode(['success' => false, 'message' => 'Unauthorized']);
//     exit;
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = isset($_POST['index']) ? intval($_POST['index']) : -1;

    if ($index < 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid index']);
        exit;
    }

    $result = deleteActivity($index);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete activity']);
    }

    exit;
}

function deleteActivity($index) {
    $filename = '../activities/activities.txt'; // Ajuste o caminho conforme necessário

    if (!file_exists($filename)) {
        return false;
    }

    $activities = json_decode(file_get_contents($filename), true);

    if (isset($activities[$index])) {
        array_splice($activities, $index, 1);
        file_put_contents($filename, json_encode($activities));
        return true;
    }

    return false;
}
?>
