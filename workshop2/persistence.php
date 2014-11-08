<?php

// for deletion
if (isset($_POST["to_delete"])) {
  $to_delete = $_POST["to_delete"];

  echo("Successfully removed: $to_delete");

  deleteLineInFile("todos", $to_delete);
}

// for addition
if (isset($_POST["to_add"])) {
  $to_add = $_POST["to_add"];

  // open a file
  $fh = fopen("todos", "a");

  // what to write?
  $stringData = "$to_add\n";

  // write
  fwrite($fh, $stringData);

  // close file
  fclose($fh);

  echo("Successfully added: $to_add");
}

function deleteLineInFile($file, $string)
{
  $i=0;$array=array();

  $read = fopen($file, "r") or die("can't open the file");
  while(!feof($read)) {
    $array[$i] = fgets($read);
    ++$i;
  }
  fclose($read);

  $write = fopen($file, "w") or die("can't open the file");
  foreach($array as $a) {
    if(!strstr($a,$string)) fwrite($write,$a);
  }
  fclose($write);
}

?>
