<?php
defined('BASEPATH') OR exit('No direct script access allowed');
abstract class Validator extends CI_Model
{
    abstract public function validate(CI_Model $model);
 
    public function isValidInteger($property)
    {
        return is_int($property);
    }
    public function isValidString($property)
    {
        return is_string($property);
    }
}