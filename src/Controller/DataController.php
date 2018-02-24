<?php
/**
 * Created by PhpStorm.
 * User: dimon
 * Date: 17.02.18
 * Time: 14:33
 */

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DataController extends Controller
{

    public function menu(Request $request)
    {

        $menu = [
            'News',
            'Products',
            'About'
        ];
        return $this->render('data/menu.html.twig', [
            'menu' => $menu
        ]);
    }


    /**
     * @Route ("/index", name="index")
     * @return string
     */
    public function index(Request $request)
    {

        $product = new Product();
        $product->setName('BMW X5');
        $product->setDescription('New car');
        $product->setPrice(50000);
        $product->setCreatedAt(new \DateTime());
        $product->setUpdatedAt(new \DateTime());

        $category = new Category();
        $category->setName('Auto');

        $product->setCategory($category);

        $manager = $this->getDoctrine()->getManager();

        $manager->persist($product);
        $manager->persist($category);
        $manager->flush();

        $title = 'News';

        return $this->render(
            'data/index.html.twig',
            [
                'title_test' => $title
            ]
        );
    }

    /**
     * @Route ("/hi", name="hi")
     * @return string
     */
    public function hi()
    {
        return $this->render('data/hi.html.twig');
    }


    public function demo(
        Request $request,
        SessionInterface $session)
    {
        //$session->set('userId', '1');

        echo $session->get('userId', '1');

        die('demo');
      return $this->redirect('http://google.com');
    }

    /**
     * @Route("/", name="data_test_1")
     */
    public function test()
    {
        return new Response('lalala');
    }

    /**
     * @Route(
     *     "/hello/{name}",
     *     name="hello",
     *     methods={"GET", "POST"},
     *     requirements={"name"="[a-z]+"}
     *     )
     */
    public function hello($name)
    {
        return new JsonResponse([
            'greeting' => "Hello $name"
        ]);
    }

    /**
     * @Route(
     *     "/hello/{name}",
     *     name="hello_int",
     *     methods={"GET", "POST"},
     *     requirements={"name"="\d+"}
     * )
     */
    public function helloInt($name)
    {
        return new JsonResponse([
            'greeting' => "Hello from int $name"
        ]);
    }
}