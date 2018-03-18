<?php
/**
 * Created by PhpStorm.
 * User: dimon
 * Date: 03.03.18
 * Time: 18:01
 */

namespace App\Services;

class TextFormatter implements TextFormatterInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function formatText($text) {

        sleep(3);

        $text = str_ireplace('[', '<b>', $text);
        $text = str_ireplace(']', '</b>', $text);

        $this->logger->log($text);

        return $text;
    }
}