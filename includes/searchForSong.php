<?php

require_once('../classes/Song_class.php');

$value = Song::searchSong($_GET['currentSearch']);

$sValue = json_encode($value);

echo '{"status": 1, "items": ' . $sValue . '}';
