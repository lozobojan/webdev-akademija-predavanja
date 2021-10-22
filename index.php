<?php 

    $a = 10.50; // float
    $b = 25; // int
    $c = "435345345345345"; // string
    $cond = true; // bool
    $n = "null";

    // var_dump($cond);
    // echo $a + $b ;

    // echo "<h1>Test stranica.  B: $b </h1>";

    // php v<7.0
    // $arr = array();
    // array_push($arr, $a);

    // $arr = []; // skraceno array()
    // $arr[0] = $a; // skraceno array_push
    // $arr[1] = $c; // moze i bez [0] samo $arr[]

    // php v >= 7.0
    $arr = []; 
    $arr["price"] = $a;
    $arr["code"] = $c;

    $str = "The quick brown fox";
    $length = strlen($str);
    $words_cnt = str_word_count($str);

    $str = str_replace("fox", "dog", $str);
    $substr = substr($str, 0);
    $upper = strtoupper($str);
    // var_dump($upper);
   
?>