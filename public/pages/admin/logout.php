<?php

declare(strict_types=1);
require_once dirname(__DIR__, 2) . '/config.php';

$error = null;

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

unset($_SESSION['is_admin']);
session_destroy();

header('Location: /');
exit;

?>