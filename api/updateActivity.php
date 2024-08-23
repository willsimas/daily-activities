<?php
header('Content-Type: application/json');

// Verifique se a solicitação é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $index = $data['index'] ?? null;
    $name = $data['name'] ?? null;
    $status = $data['status'] ?? null;

    if ($index !== null && $name !== null && $status !== null) {
        $filePath = '../activities/activities.txt'; // Ajuste o caminho conforme necessário

        if (file_exists($filePath)) {
            $activities = json_decode(file_get_contents($filePath), true);

            if (is_array($activities) && isset($activities[$index])) {
                // Atualizar a atividade
                $activities[$index]['name'] = $name;
                $activities[$index]['status'] = $status;

                // Salvar as alterações de volta no arquivo
                file_put_contents($filePath, json_encode($activities));

                echo json_encode(['success' => true]);
                exit;
            }
        }
    }

    echo json_encode(['success' => false, 'message' => 'Activity not found or invalid data']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

// // updateActivity.php
// require '../includes/ActivityHandler.php';

// $activityHandler = new ActivityHandler('activities/activities.txt');
// $data = json_decode(file_get_contents('php://input'), true);

// if (isset($data['index']) && isset($data['status'])) {
//     $activities = $activityHandler->getActivities();
//     $activities[$data['index']]['status'] = $data['status'];
//     if ($data['status'] === 'finalizado') {
//         $activities[$data['index']]['completed_at'] = date('Y-m-d H:i:s');
//     }
//     $activityHandler->saveActivities($activities);
//     echo json_encode(['success' => true]);
// } else {
//     echo json_encode(['success' => false]);
// }
