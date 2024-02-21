<?php

require_once("utils.php");
require_once("data.php");

function local_general_data(): GeneralResponse
{
    $content = get_file_content("./api/general.json");
    if ($content->Err) {
        return $content->Err;
    }

    return GeneralResponse::from_json($content->Value);
}

function local_starship_data(string $uid): StarshipResponse
{
    $content = get_file_content("./api/starships/$uid.json");
    if ($content->Err) {
        return $content->Err;
    }

    return StarshipResponse::from_json($content->Value);
}

/**
 * Process the data from GeneralResponse and return an array of Starship objects.
 *
 * @param GeneralResponse $data The data to be processed
 * @return array<Starship> Array of Starship objects
 */
function local_process_data(GeneralResponse $data): array
{
    $result = []; // arr<Starship>

    foreach ($data->Results as $el) {
        $starship_data = (local_starship_data($el["uid"]))->Result["properties"];
        $starship = new Starship($starship_data["name"], $starship_data["MGLT"], $starship_data["consumables"]);
        array_push($result, $starship);
    }

    return $result;
}

function local(int $distance)
{
    $data = local_general_data();
    $starships = local_process_data($data);

    foreach ($starships as $starship) {
        if ($starship->MGLT == "unknown") {
            continue;
        }

        echo $starship->Name . ": " . $starship->stops_calc($distance) . "\n";
    }
}