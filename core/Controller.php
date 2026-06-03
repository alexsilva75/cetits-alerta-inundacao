<?php

namespace Core;

class Controller
{
    protected function view(
        string $template,
        array $data = []
    )
    {
        View::render(
            $template,
            $data
        );
    }
}