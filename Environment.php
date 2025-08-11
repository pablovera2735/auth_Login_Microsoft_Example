<?php

class Environment {
    private $vars = [];

    public function __construct($path) {
        if (!file_exists($path)) {
            throw new Exception("Archivo .env no encontrado en: " . $path);
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // Ignorar comentarios
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            // Separar clave y valor
            list($name, $value) = array_map('trim', explode('=', $line, 2));
            $this->vars[$name] = $value;
        }
    }

    public function get($key, $default = null) {
        return isset($this->vars[$key]) ? $this->vars[$key] : $default;
    }
}
