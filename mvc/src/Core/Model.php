<?php

namespace MVC\Core;

class Model
{
    public function getProperties($model)
    {
        var_dump($model);
        die;
        return get_object_vars($model);
    }
}