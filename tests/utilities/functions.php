<?php

function create($class, $attributes = [], $nb = null)
{
    return factory($class, $nb)->create($attributes);
}

function make($class, $attributes = [], $nb = null)
{
    return factory($class, $nb)->make($attributes);
}

function raw($class, $attributes = [], $nb = null)
{
    return factory($class, $nb)->raw($attributes);
}

function webformat($string){
  //  return htmlentities($string, ENT_QUOTES);
    return $string;
}