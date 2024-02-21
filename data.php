<?php

require_once("utils.php");

class Starship
{
    public string $Name;
    public string $MGLT;
    public string $Consumables;

    public function __construct(string $Name, string $MGLT, string $Consumables)
    {
        $this->Name = $Name;
        $this->MGLT = $MGLT;
        $this->Consumables = $Consumables;
    }

    public static function from_json(string $json): Starship
    {
        $json = json_decode($json, true);
        return new Starship($json["name"], $json["MGLT"], $json["consumables"]);
    }

    public function consume_calc(): int|null
    {
        $elements = explode(" ", $this->Consumables);
        if (count($elements) != 2) {
            return null;
        }

        $value = str_to_int($elements[0]);
        if ($value == null) {
            return null;
        }

        $unit = $elements[1];
        if ($unit == "") {
            return null;
        }
        if ($unit[strlen($unit) - 1] == 's') {
            $unit = substr($unit, 0, strlen($unit) - 1);
        }

        switch ($unit) {
            case "year":
                return 8760 * $value;

            case "month":
                return 730 * $value;

            case "week":
                return 168 * $value;

            case "day":
                return 24 * $value;

            default:
                return 1;
        }

    }

    public function stops_calc(int $distance): int|null
    {
        // Formula
// distance / (consumables%toHours * MGLT)

        $consume = $this->consume_calc();
        if ($consume == null) {
            return null;
        }

        return (int) ($distance / ($consume * $this->MGLT));
    }
}

class StarshipData
{
    public array $Properties;
    public static function from_json(string $json): StarshipData
    {
        $data = json_decode($json, true);

        $obj = new StarshipData();
        $obj->Properties = $data["properties"];

        return $obj;
    }
}

class StarshipResponse
{
    public array $Result;

    public static function from_json(string $json): StarshipResponse
    {
        $data = json_decode($json, true);

        $obj = new StarshipResponse();
        $obj->Result = $data["result"];

        return $obj;
    }
}

class StarshipInfo
{
    public string $UID;

    public static function from_json(string $json): StarshipInfo
    {
        $data = json_decode($json, true);

        $obj = new StarshipInfo();
        $obj->UID = $data["uid"];

        return $obj;
    }
}

class GeneralResponse
{
    public int $TotalRecords;
    public array $Results;

    public static function from_json(string $json): GeneralResponse
    {
        $json = json_decode($json, true);
        // TODO: Check if is a valid JSON for GeneralResponse

        $obj = new GeneralResponse();
        $obj->TotalRecords = $json["total_records"];
        $obj->Results = $json["results"];

        return $obj;
    }
}