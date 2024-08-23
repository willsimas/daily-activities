<?php
header('Content-Type: application/json');

// Verifique se a solicitação é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'] ?? null;

    if ($id !== null) {
        $filePath = '../activities/activities.txt'; // Ajuste o caminho conforme necessário

        if (file_exists($filePath)) {
            $activities = json_decode(file_get_contents($filePath), true);

            if (is_array($activities)) {
                $initialCount = count($activities);

                // Filtrar e remover a atividade com o ID correspondente
                $activities = array_filter($activities, function($activity) use ($id) {
                    return $activity['id'] !== $id;
                });

                $activities = array_values($activities); // Reindexar o array

                if (count($activities) < $initialCount) {
                    // Salvar as alterações de volta no arquivo
                    file_put_contents($filePath, json_encode($activities, JSON_PRETTY_PRINT));
                    echo json_encode(['success' => true]);
                    exit;
                }
            }
        }
    }

    echo json_encode(['success' => false, 'message' => 'Invalid ID or activity not found']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
