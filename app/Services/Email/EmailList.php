<?php


namespace App\Services\Email;


class EmailList
{
    /**
     * @var Email[]
     */
    private $emails = [];

    /**
     * @var string
     */
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addEmail(Email $email)
    {
        $this->emails[] = $email;
    }

    public function toArray(): array
    {
        $arr = [];
        foreach ($this->emails as $email)
        {
            $domain = $email->getDomain();
            $text = sprintf('<%s>', $email);
            if (array_key_exists($domain, $arr)) {
                $arr[$domain] .= $text;
            } else {
                $arr[$domain] = $text;
            }
        }
        return $arr;
    }
}
