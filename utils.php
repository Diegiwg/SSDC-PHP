<?php

class Response
{
    public $Value;
    public $Err;

    public function __construct($Value, $Err)
    {
        $this->Value = $Value;
        $this->Err = $Err;
    }
}

function str_to_int(string $str)
{
    $num = is_numeric($str) ? (int) $str : null;

    if ($num == null && $num != 0) {
        return null;
    }

    return $num;
}

function get_file_content(string $path): Response
{
    if (!file_exists($path)) {
        return new Response(null, "ERROR: File $path not found");
    }

    $content = file_get_contents($path);
    if ($content === false) {
        return new Response(null, "ERROR: File $path could not be read");
    }

    return new Response($content, null);
}