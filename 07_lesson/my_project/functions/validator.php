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
            if (str_contains($rule, 'required')) {
                if (!required($fields[$fieldName])) {
                    $errors[$fieldName][] = "Field $fieldName is required!";
                }
            }

            //Min Length Rule
            if (str_contains($rule, 'min_length')) {
                preg_match("/\[(\d+)\]/", $rule, $matches);
                $length = $matches[1];
                if (!minLength($fields[$fieldName], $length)) {
                    $errors[$fieldName][] = "Field $fieldName must be biggest than $length!";
                }
            }

            //Max Length Rule
            if (str_contains($rule, 'max_length')) {
                preg_match("/\[(\d+)\]/", $rule, $matches);
                $length = $matches[1];
                if (!maxLength($fields[$fieldName], $length)) {
                    $errors[$fieldName][] = "Field $fieldName must be not biggest than $length!";
                }
            }

            //Email Rule
            if (str_contains($rule, 'email')) {
                if (!validateEmail($fields[$fieldName])) {
                    $errors[$fieldName][] = "The $fieldName field is invalid!";
                }
            }

            //Password Rule
            if (str_contains($rule, 'password')) {
                if (!password($fields[$fieldName])) {
                    $errors[$fieldName][] = "The $fieldName must be at least 5 characters long, include 1 char A-Z,
                    1 char a-z, 1 char 0-9!";
                }
            }

            //Password Confirm Rule
            if (str_contains($rule, 'confirm')) {
                if ($fields[$fieldName . '_confirm'] !== $fields[$fieldName]) {
                    $errors[$fieldName . '_confirm'][] = "Password should be matches!";
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
 *
 * @param string $password
 * @return bool
 */
function password(string $password): bool
{
    $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]{5,}$/';

    return preg_match($pattern, $password);
}

/**
 * set validation errors
 * @param array $errors
 * @return void
 */
function setValidationErrors(array $errors): void
{
    $_SESSION['validation_errors'] = $errors;
}

/**
 * get validation errors
 * @param $key
 * @return array
 */
function getValidationErrors($key): array
{
    $errors = $_SESSION['validation_errors'][$key] ?? [];

    unset($_SESSION['validation_errors'][$key]);

    return $errors;
}



