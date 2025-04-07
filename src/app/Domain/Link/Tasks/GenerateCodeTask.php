<?php

namespace App\Domain\Link\Tasks;

class GenerateCodeTask
{
    private string $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    private int $length = 6;

    public function __invoke(): string
    {
        $chars = str_shuffle($this->chars);
        $chars = str_split($chars);

        $code = '';

        for ($i = 0; $i < $this->length; $i++) {
            $code .= $chars[rand(0, count($chars) - 1)];
        }

        $currentPartition = config('link.current_partition');

        return $currentPartition . $code;
    }
}
