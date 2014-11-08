<!DOCTYPE html>
<html>
<body>

<h1>TODOs:</h1>

<div>
  <ul>
  <?php

if (isset($_POST["to_delete"])) {
  $to_delete = $_POST["to_delete"];

  deleteLineInFile("todos", $to_delete);
}

if (isset($_POST["task_name"])) {
  $task_name = $_POST["task_name"];

  // open a file
  $fh = fopen("todos", "a");

  // what to write?
  $stringData = "$task_name\n";

  // write
  fwrite($fh, $stringData);

  // close file
  fclose($fh);
}

$handle = fopen("todos", "r");
while (($line = fgets($handle)) !== false) {
  $line = trim($line);
  echo "<li><form method=\"POST\" action=\"\"><input name=\"to_delete\" type=\"hidden\" value=\"$line\"> $line <button>Delete</button> </form></li>\n";
}
fclose($handle);

  ?>
  </ul>
</div>

<div>
  <form method="POST" action="">
    New Task Name: <input name="task_name" type="text" /> <button>Add Task</button>
  </form>
</div>

</body>
</html>

<?php

function deleteLineInFile($file,$string)
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