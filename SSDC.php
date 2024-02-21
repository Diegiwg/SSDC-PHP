<?php

require_once("utils.php");
require_once("data.php");
require_once("local.php");

function parse_cmd(int $argc, array $argv)
{
    if ($argc < 1) {
        return "please specify a command";
    }

    $cmd = $argv[0];
    switch ($cmd) {
        case "local":
            if ($argc < 2) {
                return "please specify a distance";
            }

            $distance = str_to_int($argv[1]);
            if (is_null($distance)) {
                return "the distance must be a number";
            }

            if ($distance <= 0) {
                return "the distance must be positive and non-zero";
            }

            local($distance);
            break;
        default:
            return "Unknown command: " . $cmd;
    }

}

$PROG = $argv[0];
unset($argv[0]);
$argc = count($argv);

$err = parse_cmd($argc, array_values($argv));
if (!is_null($err)) {
    echo "ERROR: $err\n";
}

