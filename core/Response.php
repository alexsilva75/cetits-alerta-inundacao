<?php

namespace Core;

class Response
{

    public function html(
        string $content,
        int $status = 200
    ): void
    {
        http_response_code($status);

        header(
            'Content-Type: text/html; charset=utf-8'
        );

        echo $content;
    }

    public function json(
        array $data,
        int $status = 200
    ): void
    {
        http_response_code($status);

        header(
            'Content-Type: application/json'
        );

        echo json_encode($data);
    }

    public function redirect(
        string $url
    ): void
    {
        header("Location: {$url}");
        exit;
    }
    
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function setHeader(string $name, string $value)
    {
        header("$name: $value");
    }

    public function send(string $content)
    {
        echo $content;
    }
}