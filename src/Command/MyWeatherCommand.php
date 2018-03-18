<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MyWeatherCommand extends Command
{
    protected static $defaultName = 'my:weather';

    protected function configure()
    {
        $this
            ->setDescription('Get weather in Kiev')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $ch = \curl_init();
        // set url
        \curl_setopt($ch, CURLOPT_URL, "http://api.wunderground.com/api/c7ec54915c546019/forecast/lang:UA/q/UA/Kiev.json");
        //return the transfer as a string
        \curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // $output contains the output string
        $output = \curl_exec($ch);
        // close curl resource to free up system resources
        \curl_close($ch);
        dump(json_decode($output));
    }
}
