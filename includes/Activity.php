<?php

class Activity {
    public $name;
    public $status;
    public $created_at;
    public $completed_at;

    public function __construct($name, $status = 'aberto', $created_at = null, $completed_at = null) {
        $this->name = $name;
        $this->status = $status;
        $this->created_at = $created_at ?? date('Y-m-d H:i:s');
        $this->completed_at = $completed_at;
    }

    public function toArray() {
        return [
            'name' => $this->name,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'completed_at' => $this->completed_at,
        ];
    }
}
