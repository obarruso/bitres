<?php

declare(strict_types=1);

namespace App\Bitres\User\Domain\Model\ValueObjects;

use App\Common\Domain\Exceptions\IncorrectEmailFormatException;
use App\Common\Domain\Exceptions\RequiredException;
use App\Common\Domain\ValueObject;

final class Email extends ValueObject
{
    private string $email;

    public function __construct(?string $email, $isOptional = false)
    {
        if (!$email && !$isOptional) {
            throw new RequiredException('email');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new IncorrectEmailFormatException();
        }

        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->email;
    }

    public function jsonSerialize(): string
    {
        return $this->email;
    }
}