<?php

namespace App\Services\OrderService\Models;

class Customer
{
    public function __construct(
        public string $name,
        public string $email,
        public string $phone
    )
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }
}
