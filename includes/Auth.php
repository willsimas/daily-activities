<?php
class Auth {
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public static function login($userId) {
        $_SESSION['user_id'] = $userId;
    }

    public static function logout() {
        unset($_SESSION['user_id']);
    }
}
