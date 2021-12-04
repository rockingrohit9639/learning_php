<?php

    echo "<h1>Working with files.</h1><br>";

    // $a = readfile("testfile.txt");
    // echo $a; this will also print the numbers of characters read

    // readfile("testfile.txt"); // will automatically give output

    $fptr = fopen("testfile.txt", "r+");
    $content = fread($fptr, filesize("testfile.txt")); // read content of length
    
    fwrite($fptr, "This is inserted from the php.\nAnd this is new line.");
    fclose($fptr);

?>