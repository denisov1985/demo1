<?php
/**
 * Created by PhpStorm.
 * User: dimon
 * Date: 17.02.18
 * Time: 14:33
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class DataController
{
    public function demo()
    {
        die('it works');
    }

    /**
     * @Route("/", name="data_test")
     */
    public function test()
    {
        die('it works test');
    }
}