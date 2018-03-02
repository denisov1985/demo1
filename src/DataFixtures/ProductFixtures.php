<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Loader\NativeLoader;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $loader = new NativeLoader();
        $objectSet = $loader->loadData([
            Product::class => [
                'product{1..10}' => [
                    'name' => '<username()>',
                    'description' => '<firstName()> <lastName()>',
                    'createdAt' => '<date_create()>',
                    'updatedAt' => '<date_create()>',
                    'price' => '<numberBetween(1, 200)>',
                ],
            ]
        ]);

        foreach ($objectSet->getObjects() as $key => $value) {
            $manager->persist($value);
        }

        $manager->flush();
    }
}
