<?php

class ActivityHandler {
    private $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
    }

    public function getActivities() {
        if (!file_exists($this->filePath)) {
            return [];
        }
        $content = file_get_contents($this->filePath);
        return json_decode($content, true) ?? [];
    }

    public function saveActivities($activities) {
        file_put_contents($this->filePath, json_encode($activities, JSON_PRETTY_PRINT));
    }

    public function addActivity($activity) {
        $activities = $this->getActivities();

        // Verificar se $activity é um array ou um objeto
        if (is_object($activity) && method_exists($activity, 'toArray')) {
            $activity = $activity->toArray();
        }
        
        // Gerar um ID único para a nova atividade
        $activity['id'] = uniqid();
        
        $activities[] = $activity;
        $this->saveActivities($activities);
    }

    public function updateActivity($id, $updatedActivity) {
        $activities = $this->getActivities();

        // Verificar se $updatedActivity é um array ou um objeto
        if (is_object($updatedActivity) && method_exists($updatedActivity, 'toArray')) {
            $updatedActivity = $updatedActivity->toArray();
        }
        
        // Procurar a atividade pelo ID e atualizá-la
        foreach ($activities as &$activity) {
            if ($activity['id'] === $id) {
                $activity = $updatedActivity;
                $activity['id'] = $id; // Manter o mesmo ID
                break;
            }
        }
        
        $this->saveActivities($activities);
    }

    public function deleteActivity($id) {
        $activities = $this->getActivities();
        
        // Filtrar e remover a atividade com o ID correspondente
        $activities = array_filter($activities, function($activity) use ($id) {
            return $activity['id'] !== $id;
        });
        
        $this->saveActivities(array_values($activities)); // Reindexar o array
    }
}
