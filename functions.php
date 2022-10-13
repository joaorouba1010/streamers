<?php

if(!isset($_POST['function']))
    die("No function name setter");

$function_name = $_POST['function'];
$function_arg1 = '';

if(isset($_POST['arg1']))
    $function_arg1 = $_POST['arg1'];

//$function_arg2 = $_POST['arg2'];
//$function_arg3 = $_POST['arg3'];
$stms = "str.html";
$rets = '';
switch($function_name){

    case "load_html":
        $my_file = fopen($stms, "r") or die("Unable to open file!");
        $size = filesize($stms);
        if($size)
            $rets = fread($my_file, $size);
        fclose($my_file);
        echo $rets;
        return $size;
        break;    

    case "write_html":
        $my_file = fopen($stms, "w") or die("Unable to open file!");
        $rets    = fwrite($my_file, $function_arg1);
        fclose($my_file);
        return $rets;
        break;

    default:
        die("No function name compatible");
}
?>
