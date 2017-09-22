<?php

$base = 'E:\Dropbox\projects';

foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($base)) as $file) {
    if ($file->isDir() && (basename($file->getRealpath()) == '.git')) { 
        $gits[$file->getRealpath()] = 1;
    }
}

foreach($gits as $git => $ignore) {
	chdir("$git/..");
	$status = `git status -s`;
	
	if (!empty(trim($status))) {	
		print "Adding $git!\n";
		system(sprintf('git add -A && git commit -am "%s" && git push origin master', date('c')));
	}
}
