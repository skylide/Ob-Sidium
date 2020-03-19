<?php
/**
 * This php file is the property of EndMove <contact@endmove.eu>
 * © Copyrights 2020 EndMove, All Rights Reserved
 * Version: 1.0.0
 */

$_CONFIG = array(
    "ROOTlink" => "http://localhost".$ROOTfolder.'/',
    "ROOTfolder" => $_SERVER['DOCUMENT_ROOT'].$ROOTfolder,
    "sitedomaine" => "localhost",
    "sitecertificate" => "http",
    "sitetimezone" => "Europe/Paris",

    "smtpAuth" => array(                # SMTP configuration
        "smtpauthentication" => true,
        "smtpcharset" => "UTF-8",
        "smtpencryption" => "tls",
        "smtphost" => "###",
        "smtpusername" => "###",
        "smtppassword" => '###',
        "smtpport" => 587,
        "smtpsetfrom" => "###",
        "smtpsetfromname" => "###"
    ),
);