<?php

$descriptorspec = array(
   0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
   1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
   2 => array("file", "error-output.txt", "a") // stderr is a file to write to
);
$time = time();
$process = proc_open("programe.exe", $descriptorspec, $pipes);
fwrite($pipes[0], '5');
    while($s= fgets($pipes[1], 1024)) 
	{
		echo $s;
	
		if(time()-$time>5){
			proc_close($process);
			system("taskkill /im programe.exe /f");
			die("Timeout");
		}
	}
proc_close($process);
system("taskkill /im programe.exe /f");
die("i cant read from the sheel");

?>