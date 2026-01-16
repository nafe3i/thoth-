<?php

// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'thoth_lms');
define('DB_USER', 'root');
define('DB_PASS', 'amine@2002@N');

// Chemins de l'application
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('PUBLIC_PATH', ROOT_PATH . '/public');

// Configuration de la session
define('SESSION_LIFETIME', 3600); // 1 heure

// URL de base (à adapter selon votre configuration)
define('BASE_URL', '/thoth2/public');
 