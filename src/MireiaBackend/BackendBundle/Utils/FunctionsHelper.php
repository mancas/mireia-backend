<?php
namespace MireiaBackend\BackendBundle\Util;

class FunctionsHelper
{
    public static function isClass($obj, $className)
    {
        if (strpos(get_class($obj), ucfirst($className)) !== false) {
            return true;
        }

        return false;
    }
}