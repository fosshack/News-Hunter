<?php 

$command = escapeshellcmd('tweets.py cnn');
$output = shell_exec($command);
echo $output;
?>