<?php

class Auth
{

    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function login($student)
    {
        if (!isset($student['id']) || !isset($student['name']) || !isset($student['email'])) {
            throw new InvalidArgumentException("Données utilisateur invalides");
        }
        $_SESSION['student_id'] = $student['id'];
        $_SESSION['student_name'] = $student['name'];
        $_SESSION['student_email'] = $student['email'];
        $_SESSION['logged_in'] = true;
    }

    public static function logout()
    {
        session_unset();
        session_destroy();
    }

    public static function isLoggedIn()
    {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    public static function getUserId()
    {
        return $_SESSION['student_id'] ?? null;
    }

    public static function getUserName()
    {
        return $_SESSION['student_name'] ?? null;
    }

    public static function protect()
    {
        if (!self::isLoggedIn()) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    public static function escape($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}
