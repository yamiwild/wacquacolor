<?php
/*
* ------------------------------------------------------------------
* Este arquivo não pode ser acessado diretamente
* ------------------------------------------------------------------
*/
if (!defined('ENG_BASEPATH')) exit(utf8_decode('Você não pode acessar este arquivo diretamente diretamente.'));

Abstract class WeAutoload
{
    // array contem as classes-extensões
    private static $_exts = array();

    //Singleton
    public static function getInstance($object) {
        $class = $object;
        if (!in_array($class, self::$_exts)) {
            self::$_exts[] = $class;
        }
        return self::$_exts;
    }

    public function addExt($object)
    {
        if(!empty($object)){
            return self::getInstance($object);
        }
    }

    //Método mágico __get
    public function __get($varname)
    {
        foreach(self::$_exts as $ext)
        {
            if(property_exists($ext,$varname))
            return $ext->$varname;
        }
    }

    //Método mágico __call
    public function __call($method,$args)
    {
        foreach(self::$_exts as $ext)
        {
            if(method_exists($ext,$method))
            return @call_user_func_array(array($ext,$method),$args);
        }
        throw new Exception("Este Metodo {$method} nao existe!");
    }
}
?>