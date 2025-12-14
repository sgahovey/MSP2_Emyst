<?php

use App\Kernel;

if (!is_file(dirname(__DIR__).'/vendor/autoload_runtime.php')) {
    throw new LogicException('Symfony Runtime is missing. Try running "composer require symfony/runtime".');
}

/**
 * IMPORTANT : définir les options Runtime AVANT de require autoload_runtime.php
 * En prod, on désactive dotenv => pas de /app/.env
 */
$runtimeOptions = $_SERVER['APP_RUNTIME_OPTIONS'] ?? $_ENV['APP_RUNTIME_OPTIONS'] ?? [];

if (is_string($runtimeOptions)) {
    $decoded = json_decode($runtimeOptions, true);
    $runtimeOptions = is_array($decoded) ? $decoded : [];
} elseif (!is_array($runtimeOptions)) {
    $runtimeOptions = [];
}

// Désactive dotenv uniquement en prod
$appEnv = $_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? 'prod';
if ($appEnv === 'prod') {
    $runtimeOptions['disable_dotenv'] = true;
}

$_SERVER['APP_RUNTIME_OPTIONS'] = $runtimeOptions;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
