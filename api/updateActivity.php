<?php

// updateActivity.php
require 'includes/ActivityHandler.php';

$activityHandler = new ActivityHandler('activities/activities.txt');
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['index']) && isset($data['status'])) {
    $activities = $activityHandler->getActivities();
    $activities[$data['index']]['status'] = $data['status'];
    if ($data['status'] === 'finalizado') {
        $activities[$data['index']]['completed_at'] = date('Y-m-d H:i:s');
    }
    $activityHandler->saveActivities($activities);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
