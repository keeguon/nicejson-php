<?
/**
* Formate a flat JSON string to make it more human-readable
*
* @param string $json The original JSON string to process
* @return string Indented version of the original JSON string
*/
function json_format($json)
{
  $result = '';
  $pos = 0;
  $strLen = strlen($json);
  $indentStr = ' ';
  $newLine = "\n";
  $prevChar = '';
  $outOfQuotes = true;
  
  for ($i = 0; $i <= $strLen; $i++) {
    // Grab the next character in the string
    $char = substr($json, $i, 1);
    
    // Are we inside a quoted string?
    if ($char == '"' && $prevChar != '\\') {
      $outOfQuotes = !$outOfQuotes;
    }
    // If this character is the end of an element, 
    // output a new line and indent the next line
    else if(($char == '}' || $char == ']') && $outOfQuotes) {
      $result .= $newLine;
      $pos--;
      for ($j=0; $j<$pos; $j++) {
        $result .= $indentStr;
      }
    }
    // Add the character to the result string
    $result .= $char;

    // If the last character was the beginning of an element, 
    // output a new line and indent the next line
    if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
      $result .= $newLine;
      if ($char == '{' || $char == '[') {
        $pos++;
      }
      for ($j = 0; $j < $pos; $j++) {
        $result .= $indentStr;
      }
    }
    $prevChar = $char;
  }

  return $result;
}

// Example usage (use php-cli)
$file = dirname(__FILE__).'/example.json';
$json = file_get_contents($file);
print_r(json_format($json));
