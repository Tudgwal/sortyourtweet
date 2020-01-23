<?php
function parse_file($line, $result)
{
    if ($line[0] == '#')
        return $result;

    $cline = substr($line, 0, strpos($line, "="));
    $data = substr($line, strpos($line, "\"") + 1);
    $data = substr($data, 0, strpos($data, "\""));
    switch ($cline) {
        case "DBSERVER":
            $result[0] = $data;
            break;
        case "DBNAME":
            $result[1] = $data;
            break;
        case "DBUSER":
            $result[2] = $data;
            break;
        case "DBPASSWORD":
            $result[3] = $data;
            break;
        case "consumer_key":
            $result[4] = $data;
            break;
        case "consumer_secret":
            $result[5] = $data;
            break;
      case "URL":
            $result[6] = $data;
            break;
    }
    return $result;
}

function get_file_data($filename)
{
    $data = array("dbserver", "dbname", "dbuser", "dbpassword", "consumer_key", "consumer_secret");
    $result[] = array();
    $file = fopen($filename, "r");
    while (!feof($file)) {
        $line = fgets($file);
        $result = parse_file($line, $result);
    }
    fclose($file);
    $data = array(
        "dbserver" => $result[0],
        "dbname" => $result[1],
        "dbuser" => $result[2],
        "dbpassword" => $result[3],
        "consumer_key" => $result[4],
        "consumer_secret" => $result[5],
        "url" => $result[6]
    );
    return $data;
}

function get_data()
{
    $result;
    if (file_exists("./config.php.env"))
        $result = get_file_data("./config.php.env");
    else if (file_exists("./config.php"))
        $result = get_file_data("./config.php");
    return $result;
}
