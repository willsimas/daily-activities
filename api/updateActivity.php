<?php
header('Content-Type: application/json');

// Verifique se a solicitação é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'] ?? null;
    $name = $data['name'] ?? null;
    $status = $data['status'] ?? null;

    if ($id !== null && $name !== null && $status !== null) {
        $filePath = '../activities/activities.txt'; // Ajuste o caminho conforme necessário

        if (file_exists($filePath)) {
            $activities = json_decode(file_get_contents($filePath), true);

            if (is_array($activities)) {
                $found = false;

                // Atualizar a atividade com o ID correspondente
                foreach ($activities as &$activity) {
                    if ($activity['id'] === $id) {
                        $activity['name'] = $name;
                        $activity['status'] = $status;
                        if ($status === 'finalizado') {
                            $activity['completed_at'] = date('Y-m-d H:i:s');
                        }
                        $found = true;
                        break;
                    }
                }

                if ($found) {
                    // Salvar as alterações de volta no arquivo
                    file_put_contents($filePath, json_encode($activities, JSON_PRETTY_PRINT));
                    echo json_encode(['success' => true]);
                    exit;
                }
            }
        }
    }

    echo json_encode(['success' => false, 'message' => 'Activity not found or invalid data']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
