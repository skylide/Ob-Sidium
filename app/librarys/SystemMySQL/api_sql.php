<?php
/**
 * ==== SystemMySQL ====
 *
 * SQL management API, use PDO and MySQLi
 *
 * @package    api_sql
 * @author     Original SoftaLabs DevTeam <dev@softalabs.com>
 * @copyright  © 2019 SoftaLabs, All Rights Reserved
 * @version    Version: 1.0.0
 * @link       https://www.softalabs.com/
 *
 * Update: 12-09-2019
 */
require('config.php');
$sql_error = array();

function get_bdd($bases, $num, $var) {
    switch($var) {
        case 'status':
            return $bases[$num]['status'];
        case 'prefix':
            return $bases[$num]['prefix'];
        case 'type_string':
            return $bases[$num]['type'];
        case 'type':
            if($bases[$num]['type'] == "mysqli") {
                return false;
            }
            else{
                return true;
            }
        case 'identifiers':
            $table = array();
            $table[] = $bases[$num]['prefix'];
            $table[] = $bases[$num]['username'];
            $table[] = $bases[$num]['password'];
            $table[] = $bases[$num]['hostname'];
            $table[] = $bases[$num]['databasename'];
            $table[] = $bases[$num]['port'];
            $table[] = $bases[$num]['charset'];
            return $table;
    }
}

function add_log($msg) {
    global $logs_file;
    $file = $logs_file; 
    date_default_timezone_set('Europe/Paris');
    $date_time = date("d-m-Y H:i:s");
    try {
        if(!file_exists($_SERVER['DOCUMENT_ROOT']."/".$file)) {
            file_put_contents($_SERVER['DOCUMENT_ROOT']."/".$file, '');
            add_log("WARNING: The logs file did not exist, this one was created.");
            add_log($msg);
        }
        else{
            file_put_contents($_SERVER['DOCUMENT_ROOT']."/".$file, $msg." $date_time\r\n".file_get_contents($_SERVER['DOCUMENT_ROOT']."/".$file));
        }
    } catch (Exception $e) {
        die("<p style='text-align: center;'><span style='background-color: #ffff00; color: #ff0000;'>FATAL ERROR: $e</span></p>");
    }
}

function add_error($errors, $bases, $num) {
    $errors[] = array('base_num' => $num, 'prefix' => '$bdd_'.get_bdd($bases, $num, "prefix"), 'type' => get_bdd($bases, $num, "type_string"));
    add_log("ERROR: Failed connection to database number: $num, with: ".get_bdd($bases, $num, "type_string")." method and variable: ".get_bdd($bases, $num, "prefix").".");
    return $errors;
}

for($i = 1; $i <= count($bases_MySQL); $i++) {
    if(get_bdd($bases_MySQL, $i, "status")) {
        try {
            $secret = get_bdd($bases_MySQL,$i,"identifiers");
            if(get_bdd($bases_MySQL, $i, "type")) {
                ${'bdd_'.$secret[0]} = new PDO("mysql:host=".$secret[3].";port=".$secret[5].";dbname=".$secret[4].";charset=".$secret[6], $secret[1], $secret[2]);
            }
            else{
                ${'bdd_'.$secret[0]} = new mysqli($secret[3], $secret[1], $secret[2], $secret[4], $secret[5]);
                if(${'bdd_'.$secret[0]}->connect_errno) {
                    $sql_error = add_error($sql_error, $bases_MySQL, $i);
                }
                else{
                    ${'bdd_'.$secret[0]}->set_charset($secret[6]);
                }
            }
        }
        catch(Exception $e) {
            $sql_error = add_error($sql_error, $bases_MySQL, $i);
        }
    }
}

if(!empty($sql_error)) {
    if($error_action == 'redirect') {
        header("Location: $error_url");
    }
    else{
        foreach($sql_error as $err) {
            $msg = "Failed connection to database number: ".$err['base_num']." if this error persists contact the web master.";
            echo "<p style='text-align: center;'><span style='background-color: #ffff00; color: #ff0000;'>$msg</span></p>";
        }
    }
    die();
}



