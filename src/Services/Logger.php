<?php
/**
 * Created by PhpStorm.
 * User: dimon
 * Date: 03.03.18
 * Time: 18:25
 */

namespace App\Services;


class Logger implements LoggerInterface
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function log($text)
    {
        echo $text . ' ' . $this->path;
    }
}