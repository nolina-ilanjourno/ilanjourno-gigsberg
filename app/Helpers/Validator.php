<?php

namespace App\Helpers;

class Validator {
    private array $errors = [];

    public function validate(array $data, array $rules): bool {
        foreach ($rules as $field => $ruleSet) {
            $ruleSet = explode('|', $ruleSet);
            foreach ($ruleSet as $rule) {
                $this->applyRule($field, $data[$field] ?? null, $rule);
            }
        }
        return empty($this->errors);
    }

    private function applyRule(string $field, $value, string $rule): void {
        [$ruleName, $ruleParams] = array_pad(explode(':', $rule, 2), 2, null);
        $methodName = 'validate' . ucfirst($ruleName);
        if (method_exists($this, $methodName)) {
            $this->{$methodName}($field, $value, $ruleParams);
        } else {
            throw new \Exception("Validation rule {$ruleName} not found.");
        }
    }

    private function validateRequired(string $field, $value): void {
        if (empty($value)) {
            $this->errors[$field][] = "{$field} is required";
        }
    }

    private function validateLetters(string $field, $value): void {
        if (!preg_match('/^[a-zA-Z]+$/', $value)) {
            $this->errors[$field][] = "{$field} must contain only letters";
        }
    }

    private function validateEmail(string $field, $value): void {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = "{$field} must be a valid email address";
        }
    }

    private function validatePassword(string $field, $value): void {
        if (strlen($value) < 8 || 
            !preg_match('/[a-z]/', $value) || 
            !preg_match('/[A-Z]/', $value) || 
            !preg_match('/[\W_]/', $value)) {
            $this->errors[$field][] = "{$field} must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, and one special character";
        }
    }

    private function validateDate(string $field, $value): void {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $value) || !strtotime($value)) {
            $this->errors[$field][] = "{$field} must be a valid date in YYYY-MM-DD format";
        }
    }

    private function validateUrl(string $field, $value): void {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            $this->errors[$field][] = "{$field} must be a valid URL";
        }
    }

    private function validatePhone(string $field, $value): void {
        if (!preg_match('/^\d{10,}$/', $value)) {
            $this->errors[$field][] = "{$field} must be a valid phone number with at least 10 digits";
        }
    }

    public function getErrors(): array {
        return $this->errors;
    }
}
