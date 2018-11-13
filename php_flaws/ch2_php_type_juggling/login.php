<?php

$return['status'] = "You failed!";
$FLAG = "My_name_is_REMY!";

if (isset($_POST["id"]))  { 
    $auth = json_decode($_POST["id"], true);

    shell_exec("echo '--> " . $auth['data']['password'] . "' > file.txt");
    
    if(!strcmp($auth['data']['password'], "akNJA189/AKDNKA__?A,akdd,azndzdn x jaanda cxjzkanxa981N")){
        $return['status'] = "Well done! Flag: " . $FLAG;
    }
}
print json_encode($return);

?>