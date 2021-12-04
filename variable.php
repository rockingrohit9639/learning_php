<?php 

    ECHO "Declaring variables in PHP<br>";
    
    // Creating variables
    $name = "Rohit";
    $year = 3;

    echo "I am $name and I am studying in $year year.";

    // Data types in PHP
    /* 
        1. String
        2. Integer
        3. Float
        4. Boolean
        5. Object
        6. Array
        7. NULL
    */

    echo "<br>"; echo var_dump($name); // prints the variable value and its type 

    $arr = array("rohit", "lalit", "khushi");

    // echo var_dump($arr);

    // String functions in PHP
    $str = "String";

    echo "<br>";
    echo "Length of string is " . strlen($str); // string length
    echo "<br>";
    
    $str1 = "This is string to count wordds";
    
    echo "No. of words in str1 are : " . str_word_count($str1); // word count
    echo "<br>";
    
    echo strrev($name); // string reverse
    echo "<br>";
    
    echo strpos($name, "i"); // find substring
    echo "<br>"; 
    
    echo str_replace("i", "I", $name); // string replace
    echo "<br>"; 

    echo str_repeat($name, 5); // repeat string
    echo "<br>"; 

    // Operators in PHP
    /*
        1. Arithmetic Operators
        2. Assignment Operators
        3. Comparison Operators
        4. Logical Operators 
    */

    // if-elseif-else statements
    $age = 7;

    if ($age < 18) {
        echo "Baccha h re tu";
    }
    elseif($age > 18 and $age < 40) {
        echo "Admi bn gaya re";
    }
    else {
        echo "Jaldi hi budapa bhi chala jayega";
    }

    // Switch Statements
    echo "<br>";
    $charcater = "A";
    switch($charcater) {
        case "C":
            echo "Character is C";
            break;
        case "D":
            echo "Character is D";
            break;
        default:    
            echo "Character is neither C not D";
    }
    echo "<br>";

    // While loops
    // $num = 0;

    // while($num <= 10){
    //     echo $num;
    //     echo "<br>";
    //     $num += 1;
    // }

    // For loop
    // for($i =0; $i<=10; $i +=1){
    //     echo "I = " . $i;
    //     echo "<br>";
    // }

    // Do while loop
    // $do_while_num = 0;
    // do {
    //     echo "This will run";
    // }
    // while($do_while_num != 0);

    // For each
    // $arr1 = array("Rohit", "Lalit", "Khushi");
    $arr1 = ["Rohit", "Lalit", "Khushi"];

    foreach($arr1 as $val){
        echo "$val <br>";
    }

    // Functions in PHP
    function getSum($ar) {
        $sum = 0;
        foreach($ar as $val) {
            $sum += $val;
        }
        return $sum;
    }

    $marks = array(5, 6, 7, 8);
    $total = getSum($marks);
    echo "<br> Total : $total <br>";

    // Handling Date in PHP
    $d = date("M d Y l");
    echo "Today's date is $d";


    // Associative Arrays
    $details = array(
        "name" => "Rohit",
        "age" => 21,
    );

    echo $details['name'];

    foreach($details as $key => $val){
        echo "<br>$key : $val";
    }
?> 