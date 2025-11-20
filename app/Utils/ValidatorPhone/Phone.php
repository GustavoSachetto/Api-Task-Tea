<?php

namespace App\Utils\ValidatorPhone;

class Phone
{
    protected string $value;

    /**
     * set phone value.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = preg_replace('/\D/', '', $value); 
    }

    /**
     * Check if it is a valid phone number
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return strlen($this->value) === 10 || strlen($this->value) === 11;
    }

    /**
     * Format phone number
     *
     * @return string|false
     */
    public function format()
    {
        if (!$this->isValid()) {
            return false;
        }

        // Formats (XX) XXXXX-XXXX or (XX) XXXX-XXXX
        if (strlen($this->value) === 11) {
            // Format for numbers with DDD and 11 digits
            return '('.substr($this->value, 0, 2).') '.substr($this->value, 2, 5).'-'.substr($this->value, 7, 4);
        } else {
            // Format for numbers with DDD and 10 digits
            return '('.substr($this->value, 0, 2).') '.substr($this->value, 2, 4).'-'.substr($this->value, 6, 4);
        }
    }
}
