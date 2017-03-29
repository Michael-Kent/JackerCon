<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->model('Validator'); 
$this->load->model('Account'); 

class AccountValidator extends $this->Validator
{
    public function validate($this->Account $account)
    {
        if (!$account instanceof $this->Account) {
            throw new ValidationException('Cannot validate object of type %s', get_class($account));
        }
 
        $errors = array();
 
        if (!$this->isValidInteger($account->getId())) {
            $errors[] = 'ID is not an integer dufus';
        }
        if (!$this->isValidEmail($account->getEmail())) {
            $errors[] = 'ID is not an integer dufus';
        }
 
        return $errors;
    }
/*	
    public function isValidEmail($property)
    {
		return preg_match('/.+@.+\..+/',$property);
    }
	
	public isValidPhoneNumber($property){
		$property = str_replace(array("+44","(",")","+","-"," "), "", $property);
		return true;//probably    (8<=strlen($property)&&strlen($property)<=15);
	}*/
	
}