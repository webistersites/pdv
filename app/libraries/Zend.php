<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *  ============================================================================== 
 *  Author	: Mian Saleem
 *  Email	: saleem@tecdiary.com 
 *  For		: Zend Library (Barcode)
 *  Web		: http://zend.com
 *  License	: New BSD License
 *  ============================================================================== 
 */

class Zend
{
    /**
     * Constructor
     *
     * @param    string $class class name
     */
    function __construct($class = NULL)
    {
        // include path for Zend Framework
        $zfpath = ini_set('include_path',
            ini_get('include_path') . PATH_SEPARATOR . APPPATH . 'third_party');
        define('EXT', '.php');
        if ($zfpath === false || $zfpath === '') {
            die("Unable to use ini_set to set path for barcode class.");
        }

        if ($class) {
            require_once (string)$class . EXT;
            log_message('debug', "Zend Class $class Loaded");
        } else {
            log_message('debug', "Zend Class Initialized");
        }
    }

    /**
     * Zend Class Loader
     *
     * @param    string $class class name
     */
    function load($class)
    {
        require_once (string)$class . EXT;
        log_message('debug', "Zend Class $class Loaded");
    }
}
