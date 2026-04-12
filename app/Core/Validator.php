<?php

class Validator {
    private array $data;
    private array $errors = [];

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function errors() {
        return $this->errors;
    }

    public function required(string $field): static {
        $value = trim($this->data[$field]);
        if ($value === "") {
            $this->errors[] .= "Поле $field обязательно для заполнения";
        }
        return $this;
    }
 
    public function minLength(string $field, int $min): static {
        if (strlen($this->data[$field]) < $min) {
            $this->errors[] .= "Поле $field должно быть не меньше $min символов";
        }
        return $this;
    }

    public function email(string $field): static {
        if (!filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] .= "Поле $field должно быть типа email";
        }
        return $this;
    }

    public function fails() {
        return !empty($this->errors);
    }
}