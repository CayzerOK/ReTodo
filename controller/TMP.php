<?php
class TMP {

    static private $links;

    static function add($template, $content = null) {
        $modelName = 'tmp_'.$template;
        $template = $modelName.'.php';
        $path = $_SERVER['DOCUMENT_ROOT']."/template/site/";
        $tmpPath = $path.$template;
        if(file_exists($tmpPath)) {
            if (file_exists($path.$modelName.'.css')) {
                self::$links .= "<link rel='stylesheet' href='/template/site/".$modelName.".css' type=\"text/css\">";
            }
            if (file_exists($path.$modelName.'.js')) {
                self::$links .= "<script type='application/javascript' src='/template/site/".$modelName.".js'></script>";
            }

            include($tmpPath);
        }
    }

    static function exec() {
        $content = ob_get_clean();
        ob_start();
        TMP::add('mainHeader');
        $header = ob_get_clean();
        ob_start();
        TMP::add('mainFooter');
        $footer = ob_get_clean();

        $jsmain = scandir($_SERVER['DOCUMENT_ROOT']."/assets/js/");
        for($i = 2, $iMax = count($jsmain); $i < $iMax; $i++) {
            self::$links = "<script type='application/javascript' src='/assets/js/".$jsmain[$i]."'></script>".self::$links;
        }

        $links = self::$links;


        include_once($_SERVER['DOCUMENT_ROOT']."/template/layout.php");
    }
}