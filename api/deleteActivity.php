<?php

// deleteActivity.php
require '../includes/ActivityHandler.php';

$activityHandler = new ActivityHandler('activities/activities.txt');
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['index'])) {
    $activityHandler->deleteActivity($data['index']);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
