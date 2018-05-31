<?php
namespace helpers;
class Validator
{
    public static function exists($input)
    {
        if ($input) {
            return true;
        }
        
        return false;
    }

    public static function isValidStartDate($date)
    {
        $current_date = date("Y-m-d");
        if($date < $current_date) 
        {
            return false;
        }

        return true;
    }

    public static function isValidEndDate($end_date, $start_date)
    {
        $current_date = date("Y-m-d");
        if($end_date < $start_date || $end_date < $current_date) 
        {
            return false;
        }

        return true;
    }

    public static function arePasswordsEqual($password, $repeated_password)
    {
        if($password == $repeated_password)
        {
            return true;
        }

        return false;
    }

    public static function isValidEmail($email)
    {
        $pattern = "/^(.*)+@(.*)+.(.*)+$/";

        if(preg_match($pattern, $email))
        {
            echo "5";
            return true;
        }  

        return false;
    }
}
?> 