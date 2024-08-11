<?php

if (!function_exists("pr")) {
    function pr($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}

if (!function_exists("printQuery")) {
    function printQuery($model, bool $format = true, bool $returnOption = false)
    {
        $sql = $model->toSql();
        $bindings = $model->getBindings();

        foreach ($bindings as $binding) {
            $value = is_numeric($binding) ? $binding : "'" . $binding . "'";
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }
        if($returnOption){
            return $sql;
        } else {
            if ($format) echo \SqlFormatter::format($sql);
            else echo $sql;
        }
    }
}

if (!function_exists('encryptPassword')) {
    function encryptPassword($password)
    {
        $loginKey = env('LOGIN_KEY');
        return strtoupper(sha1(hex2bin(sha1($loginKey . $password))));
    }
}