<?php 
/**
 * Init admin area
 * Load common files
 * Declare variables
 * Load admin configurations and option
 */

// Initialize session
session_start();
if (!isset($_SESSION['is_logged_in'])){ $_SESSION['is_logged_in'] = false; }

// Load initial files and class
require_once '../config.php';
require_once '../include/class.database.php';
require_once 'classes/class.user.php';

// Absolute path to admin folder
define('ADMINPATH', ABSPATH.'admin/');

// CMS Tiele
define('SITETITLE', 'The Pure CMS');

// Language object
require_once 'classes/class.language.php';
$language = new language;