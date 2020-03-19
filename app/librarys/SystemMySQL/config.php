<?php
/**
 * ==== SystemMySQL ====
 *
 * SQL management API, use PDO and MySQLi
 *
 * @package    config
 * @author     Original SoftaLabs DevTeam <dev@softalabs.com>
 * @copyright  © 2019 SoftaLabs, All Rights Reserved
 * @version    Version: 1.0.0
 * @link       https://www.softalabs.com/
 *
 * Update: 12-09-2019
 */
$error_action = "load";                     // In case of error: (1: redirection http 'redirect', 2: display error 'load')
$error_url = "";                            // Url for http redirection in case of error (only in redirect mode)

$logs_file = "ob-sidium/app/librarys/SystemMySQL/logs/api_sql.log";            // Log file path from the root of the website

$bases_MySQL = [                            // List of MySQL databases
    1 => [
        "status" => true,
        "prefix" => "site",
        "type" => "pdo",
        "charset" => "utf8",
        "username" => "root",
        "password" => "",
        "hostname" => "localhost",
        "databasename" => "ob_sidium",
        "port" => 3306
    ]
];