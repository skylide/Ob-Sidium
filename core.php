<?php
/**
 * This php file is the property of EndMove <contact@endmove.eu>
 * © Copyrights 2020 EndMove, All Rights Reserved
 * Version: 1.0.0
 */

session_start();

# Configuration of the complete website
$ROOTfolder = '/ob-sidium';
require($_SERVER['DOCUMENT_ROOT'].$ROOTfolder."/app/config/config.php");
$ROOTlink = $_CONFIG['ROOTlink'];

# Php preference initialization
// ini_set("display_errors", $_CONFIG['errors']['phpdisplay']);
date_default_timezone_set($_CONFIG['sitetimezone']);

/*=========================================================================*
 *                                Librarys                                 *
 *=========================================================================*/

# /!\ MySQL Library (vital for operations)
require($_CONFIG['ROOTfolder']."/app/librarys/SystemMySQL/api_sql.php");


/*=========================================================================*
 *                                  Class                                  *
 *=========================================================================*/

# Descriptif
// require($_CONFIG['ROOTfolder']."/app/class/");


/*=========================================================================*
 *                                Functions                                *
 *=========================================================================*/

# The file containing all functions
require($_CONFIG['ROOTfolder']."/app/functions/functions.php");


/*=========================================================================*
 *                      Code to execute on all pages                       *
 *=========================================================================*/
var_dump($_CONFIG);
// code