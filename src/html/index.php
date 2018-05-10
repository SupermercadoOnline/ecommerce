<?php
$mysqli = new mysqli('mysql', 'root', '');
$databases = $mysqli->query("SHOW DATABASES");
while($row = $databases->fetch_row())
    echo $row[0] . '<br>';

phpinfo();