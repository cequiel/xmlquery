<?php
/**
 * This file contains an autoload function.
 * 
 * PHP Version 5.3
 * 
 * @category XML
 * @package  XmlQuery
 * @author   Gonzalo Chumillas <gonzalo@soloproyectos.com>
 * @license  https://raw.github.com/soloproyectos/core/master/LICENSE BSD 2-Clause License
 * @link     https://github.com/soloproyectos/core
 */
use com\soloproyectos\common\sys\file\SysFileHelper;
use com\soloproyectos\common\text\TextHelper;

require_once __DIR__ . "/sys/file/sys-file-helper.php";
require_once __DIR__ . "/text/text-helper.php";

spl_autoload_register(
    function ($classname) {
        if (preg_match_all("/[A-Z][a-z,0-9]*/", $classname, $matches)) {
            // script filename
            $dir = __DIR__;
            $name = "";
            $items = $matches[0];
            foreach ($items as $item) {
                $item = strtolower($item);
                $d = SysFileHelper::concat($dir, $item);
                if (is_dir($d)) {
                    $dir = $d;
                }
                $name = TextHelper::concat("-", $name, $item);
            }
            $filename = SysFileHelper::concat($dir, "$name.php");
            
            if (!is_file($filename)) {
                throw new Exception("Script not found: $filename");
            }
            
            include_once $filename;
        }
    }
);
