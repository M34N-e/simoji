<?php

function simojiName($name, $data, $className = 'simoji-'): ?string
{
    $join = '';
    $name = strtolower(trim($name));
    if (is_array($data) && (count($data) > 0)) {
        foreach ($data as $datum){
            if ($name !== $datum) {
                $join .= "$datum-";
            }
        }
    }

    return str_replace('_', '-', rtrim( ($className.$name.'-'.$join), '-'));
}

function generateSimojiMaps($filePath){
    $json  = file_get_contents($filePath);
    if ($json) {

        $array = json_decode( $json, true );
        $html = '$simoji-map: (
                ';
        foreach ($array as $k => $item){
            $name  = simojiName($item['name'], $item['alt_names'], '');
            $html .= '"'.str_replace('--', '-', $name).'" : "'.$item['file'].'",
                     ';
        }

        $html .= ');';

        return $html;
    }
    return false;
}

echo '<pre>';
echo (generateSimojiMaps(__DIR__.'/emoji.json'));
echo '</pre>';

?>
