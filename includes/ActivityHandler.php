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
        $activities[] = $activity->toArray();
        $this->saveActivities($activities);
    }

    public function updateActivity($index, $updatedActivity) {
        $activities = $this->getActivities();
        $activities[$index] = $updatedActivity;
        $this->saveActivities($activities);
    }

    public function deleteActivity($index) {
        $activities = $this->getActivities();
        array_splice($activities, $index, 1);
        $this->saveActivities($activities);
    }
}
