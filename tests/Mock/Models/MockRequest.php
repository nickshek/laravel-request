<?php

namespace LaravelRequest\Test\Mock\Models;

class MockRequest
{
    private static $request = array();

    public static function clear()
    {
        self::$request = array();
    }

    public static function getAllRecords(){
      return self::$request;
    }

    public function save()
    {
        array_push(self::$request,$this);
    }
}
