<?

require_once("nicejson.php");

// Example usage (use php-cli)
$file = dirname(__FILE__).'/example.json';
$json = file_get_contents($file);
print_r(json_format($json));

