<?php

namespace Core;

abstract class Form
{
    protected array $attributes = [];
    protected array $errors = [];

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function failed()
    {
        return !empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function error($field, $message): static
    {
        $this->errors[$field] = $message;

        return $this;
    }

}