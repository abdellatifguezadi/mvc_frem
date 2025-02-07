<?php

namespace App\Core;

class Validator
{
    private static $errors = [];
    
    public static function validate($data, $rules)
    {
        self::$errors = [];

        foreach ($rules as $field => $fieldRules) {
            $value = $data[$field] ?? null;

            foreach ($fieldRules as $rule) {
                if ($rule === 'required') {
                    if (empty($value)) {
                        self::addError($field, 'Ce champ est obligatoire');
                    }
                }

                if ($rule === 'email') {
                    if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        self::addError($field, 'Format d\'email invalide');
                    }
                }

                if ($rule === 'password') {
                    if (!empty($value)) {
                        $errors = [];
                        
                        if (strlen($value) < 8) {
                            $errors[] = '8 caractères minimum';
                        }
                        if (!preg_match('/[A-Z]/', $value)) {
                            $errors[] = 'une lettre majuscule';
                        }
                        if (!preg_match('/[a-z]/', $value)) {
                            $errors[] = 'une lettre minuscule';
                        }
                        if (!preg_match('/[0-9]/', $value)) {
                            $errors[] = 'un chiffre';
                        }
                        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $value)) {
                            $errors[] = 'un caractère spécial (!@#$%^&*(),.?":{}|<>)';
                        }
                        
                        if (!empty($errors)) {
                            self::addError($field, 'Le mot de passe doit contenir au moins ' . implode(', ', $errors));
                        }
                    }
                }

                if ($rule === 'name') {
                    if (!empty($value) && !preg_match('/^[a-zA-Z\s]+$/', $value)) {
                        self::addError($field, 'Le nom doit contenir uniquement des lettres');
                    }
                }

                if (is_array($rule)) {
                    if ($rule[0] === 'min' && strlen($value) < $rule[1]) {
                        self::addError($field, "Le champ $field doit contenir au moins $rule[1] caractères");
                    }
                    if ($rule[0] === 'max' && strlen($value) > $rule[1]) {
                        self::addError($field, "Le champ $field ne doit pas dépasser $rule[1] caractères");
                    }
                }
            }
        }
        
        return empty(self::$errors);
    }
    
    private static function addError($field, $message)
    {
        self::$errors[$field][] = $message;
    }
    
    public static function getErrors()
    {
        return self::$errors;
    }
    
    public static function getFirstError($field)
    {
        return self::$errors[$field][0] ?? null;
    }
    
    public static function hasError($field)
    {
        return isset(self::$errors[$field]);
    }
}
