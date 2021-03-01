<?php


namespace app\controller;


class Validation
{
    private $password;

    public function ifEmptyErrorsArray($errorsArr)
    {
        // check if all values of array is empty`1
        foreach ($errorsArr as $error) {
            if (!empty($error)) {
                return false;
            }
        }
        return true;
    }

    public function ifEmptyUserFieldWithReference(&$data, $field, $fieldDisplayName)
    {
        $fieldError = $field . "Err";
        if (empty($data[$field])) {
            // empty field
            $data['errors'][$fieldError] = "Please enter your $fieldDisplayName";
        }
    }

    public function validateEmpty($field, $msg): string
    {
        //        return empty($field) ? $msg : '';
        if (empty($field)) {
            return $msg;
        }
        return '';
    }

    public function validateName($field, $max): string
    {
        if (empty($field)) {
            // empty field
            return "Please enter your Name";
        }
        if (strlen($field) > $max) {
            return "Name must be less $max characters length";
        }
        if (!preg_match("/^[a-z ,.'-]+$/i", $field)) {
            return "Name must only contain Name characters";
        }
        //falsy
        return '';
    }

    public function validateSurname($field, $max): string
    {
        if (empty($field)) {
            // empty field
            return "Please enter your Surname";
        }
        if (!preg_match("/^[a-z ,.'-]+$/i", $field)) {
            return "Surname must only contain Name characters";
        }
        if (strlen($field) <= $max) {
            return "Surname must be less $max characters length";
        }

        //falsy
        return '';
    }

    public function validateEmail($field, &$userModel = null)
    {
        //validate empty
        if (empty($field)) {
            return "Please enter Your Email";
        }
        //check email format
        if (filter_var($field, FILTER_VALIDATE_EMAIL) === false) {
            return 'Please check Your Email';
        }
        if ($userModel !== null) {
            // if email already exists
            if ($userModel->findUserByEmail($field)) {
                return 'Email already taken';
            }
        }
        return '';
    }

    function isValidTelephoneNumber($phoneNumber, $minDigits, $maxDigits)
    {
        if (!preg_match('/^[0-9]{' . $minDigits . ',' . $maxDigits . '}\z/', $phoneNumber)) {
            return 'Please check Your Phone Number';
        }
        return '';
    }

    function validateAddress($address, $max)
    {
        if (strlen($address) <= $max) {
            return "Address must be less $max characters length";
        }
    }


    public function validatePassword($passwordField, $min, $max)
    {
        //validate empty
        if (empty($passwordField)) {
            return "Please enter a Password";
        }
        //save password for later
        $this->password = $passwordField;
        //if password lenght is less then min
        if (strlen($passwordField) < $min) {
            return "Password must be more $min characters length";
        }
        //if password lenght is mores then max
        if (strlen($passwordField) > $max) {
            return "Password must be less $max characters length";
        }
        //check password strength
        if (!preg_match("#[0-9]+#", $passwordField)) {
            return "Password must contain at least one number!";
        }
        if (!preg_match("#[a-z]+#", $passwordField)) {
            return "Password must include at least one letter!";
        }
        if (!preg_match("#[A-Z]+#", $passwordField)) {
            return "Password must include at least one Capital letter!";
        }
        //        if (!preg_match("#\W+#", $passwordField)) return "Password must include at least one symbol!";
        return '';
    }

    public function validateConfirmPassword($confirmPassword)
    {
        if (empty($confirmPassword)) {
            return "Please repeat a password";
        }
        if (!$this->password) {
            return "No password saved";
        }
        if ($confirmPassword !== $this->password) {
            return "Password must match";
        }
        return '';
    }


}