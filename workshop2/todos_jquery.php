<!DOCTYPE html>
<html>
<head>
  <title>TODOS</title>
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
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

  <br>

  Copy Cat: <span id="copy"></span>

  <script>
  function add() {
    var newTaskName = $('#task_name').val();
    $.post('persistence.php', {'to_add': newTaskName}, function (data) {
      $('#list').append('<li><span>' + newTaskName + '</span><button onclick="done(this.parentNode)">Done</button></li>');
    });
  }

  function done(listItem) {
    var taskName = $('span', listItem).text();
    $.post('persistence.php', {'to_delete': taskName}, function (data) {
      $(listItem).slideUp(function () {
        $(listItem).remove();
      });
    });
  }

  $(document).ready(function () {
    $("#task_name").change(function () {
      $("#copy").text($("#task_name").val());
    })
  });
  </script>
</body>
</html>