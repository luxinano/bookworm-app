<?php


namespace App\Services\Email;


use InvalidArgumentException;
use JsonSerializable;

class Email implements JsonSerializable
{
    public const MAX_SUBJECT_LENGTH = 10;
    public const SUBJECT_PAD_STRING = '*';

    protected const GMAIL_DOMAIN = 'gmail.com';
    protected const YAHOO_DOMAIN = 'yahoo.com';
    protected const FACEBOOK_DOMAIN = 'facebook.com';
    protected const NASHTECH_DOMAIN = 'nashtechglobal.com';

    private $address;

    private $subject;

    private $body;

    public function __construct(string $address, string $subject)
    {
        $this->ensureIsValidEmailAddress($address);
        $this->address = $address;
        $this->subject = $this->formatSubject($subject);
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getDomain()
    {
        list($addressName, $addressDomain) = explode('@', $this->getAddress());
        switch ($addressDomain) {
            case self::GMAIL_DOMAIN:
                return 'Google';
            case self::YAHOO_DOMAIN:
                return 'Yahoo';
            case self::FACEBOOK_DOMAIN:
                return 'Facebook';
            case self::NASHTECH_DOMAIN:
                return 'Nash Tech';
        }
        return $addressName;
    }

    public function __toString(): string
    {
        return $this->getAddress() . '|' . $this->getSubject();
    }

    public function jsonSerialize(): string
    {
        return $this->__toString();
    }

    private function ensureIsValidEmailAddress(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" is not a valid email address',
                    $email
                )
            );
        }
    }

    private function formatSubject(string $subject): string
    {
        if (strlen($subject) > self::MAX_SUBJECT_LENGTH) {
            return substr($subject, 0, self::MAX_SUBJECT_LENGTH);
        } elseif (strlen($subject) < self::MAX_SUBJECT_LENGTH) {
            return str_pad($subject, self::MAX_SUBJECT_LENGTH, self::SUBJECT_PAD_STRING, STR_PAD_RIGHT);
        } else {
            return $subject;
        }
    }


}
