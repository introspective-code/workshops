<!DOCTYPE html>
<html>
<head>
  <title>TODOS</title>
</head>
<body>
  <h1>TODOS</h1>

  <ul id="list">
    <?php
      $handle = fopen("todos", "r");
      while (($line = fgets($handle)) !== false) {
        $line = trim($line);
        echo "<li><span>$line</span><button onclick='done(this.parentNode)'>Done</button></li>\n";
      }
      fclose($handle);
    ?>
  </ul>

  New Task Name: <input id="task_name" type="text" /> <button onclick="add()">Add Task</button>

  <script>
  function add() {
    // CALL PERSISTENCE.PHP to ADD
    var newTaskName = document.getElementById('task_name').value;
    var params = "to_add=" + newTaskName;

    var http = new XMLHttpRequest();
    http.open("POST", "persistence.php", true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    http.onreadystatechange = function() {
      if(http.readyState == 4 && http.status == 200) {
        var listItem = document.createElement('li');
        var list = document.getElementById('list');
        listItem.innerHTML = newTaskName + ' <button onclick="done(this.parentNode)">Done</button>';
        document.getElementById('list').appendChild(listItem);
      }
    }

    http.send(params);
  }

  function done(listItem) {
    // CALL PERSISTENCE.PHP to REMOVE
    var taskName = listItem.childNodes[0].innerHTML;
    var params = "to_delete=" + taskName;

    var http = new XMLHttpRequest();
    http.open("POST", "persistence.php", true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    http.onreadystatechange = function() {
      if(http.readyState == 4 && http.status == 200) {
        var list = document.getElementById('list');
        list.removeChild(listItem);
      }
    }

    http.send(params);
  }
  </script>
</body>
</html>