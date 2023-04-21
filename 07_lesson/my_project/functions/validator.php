<?php

function validate(array $fields, array $rules): array|bool
{
    $errors = [];

    if (!$rules) {
        return false;
    }

    $rulesArray = processingRules($rules);

    foreach ($rulesArray as $fieldName => $arrayRules) {
        foreach ($arrayRules as $rule) {

            //Required Rule
            if ($rule === 'required') {
                if (!required($fields[$fieldName])) {
                    $errors[$fieldName][] = "Field $fieldName is required!";
                }
            }

            //Min Length Rule
            if (mb_strpos($rule, 'min_length') !== false) {
                preg_match("/\[(\d+)\]/", $rule, $matches);
                $length = $matches[1];
                if (!minLength($fields[$fieldName], $length)) {
                    $errors[$fieldName][] = "Field $fieldName must be biggest than $length!";
                }
            }

            //Max Length Rule
            if (mb_strpos($rule, 'max_length') !== false) {
                preg_match("/\[(\d+)\]/", $rule, $matches);
                $length = $matches[1];
                if (!maxLength($fields[$fieldName], $length)) {
                    $errors[$fieldName][] = "Field $fieldName must be not biggest than $length!";
                }
            }

            //Email
            if ($rule === 'email') {
                if (!validateEmail($fields[$fieldName])) {
                    $errors[$fieldName][] = "The $fieldName field is invalid!";
                }
            }

            //Password
            if ($rule === 'password') {
                if (!password($fields[$fieldName])) {
                    $errors[$fieldName][] = "The $fieldName field is invalid!";
                }
            }

            //Password Confirm
            if ($rule === 'password_confirm') {
                if ($fields[$fieldName] !== $_POST['password']) {
                    $errors[$fieldName][] = "The $fieldName field is invalid!";
                }
            }

        }
    }
    return $errors;
}

/**
 * Process array with rules
 * @param array $rules
 * @return array
 */
function processingRules(array $rules): array
{
    $rulesArray = [];
    foreach ($rules as $fieldName => $ruleString) {
        $rulesArray[$fieldName] = explode('|', $ruleString);
    }

    return $rulesArray;
}

/**
 * Check if value exists
 * @param string $value
 * @return bool
 */
function required(string $value): bool
{
    if ($value) {
        return true;
    }
    return false;
}

/**
 * Check min length
 * @param string $string
 * @param int $length
 * @return bool
 */
function minLength(string $string, int $length): bool
{
    return mb_strlen($string) > $length;
}

/**
 * Check max length
 * @param string $string
 * @param int $length
 * @return bool
 */
function maxLength(string $string, int $length): bool
{
    return mb_strlen($string) < $length;
}

/**
 * Check email for validity
 * @param string $email
 * @return bool
 */
function validateEmail(string $email): bool
{
    if (!is_string($email)) {
        return false;
    }

    $email = trim($email); // Удаляем начальные и конечные пробелы

    if (empty($email)) {
        return false;
    }

    if (!preg_match("/^[A-Za-z0-9][A-Za-z0-9\.\-_]*[A-Za-z0-9]*@([A-Za-z0-9]+([A-Za-z0-9-]*[A-Za-z0-9]+)*\.)+[A-Za-z]*$/",
        $email)) {
        return false;
    }

    return true;
}

/**
 * Check password for validity
 * @param string $password
 * @return bool
 */
function password(string $password): bool
{
    $pattern = '/^[a-zA-Zа-яА-Я\d]{6,}$/';
    return preg_match($pattern, $password);
}

///**
// * Сheck the mail for existence
// * @param string $email
// * @return bool
// */
//function existEmail(string $email): bool
//{
//    return "SELECT count(*) FROM `users` WHERE `email` = $email" ?? false;
//}