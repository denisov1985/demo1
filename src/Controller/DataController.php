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
use App\Entity\Tags;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DataController extends Controller
{

    /**
     * @Route ("/form", name="form")
     * @return string
     */
    public function form(Request $request)
    {
        $product = new Product();

        $form = $this->createFormBuilder($product)
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('createdAt', DateType::class)
            ->add('Save Product', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($product);
            $manager->flush();
        }

        dump($product);

        return $this->render(
            'data/form.html.twig',
            [
                'form1' => $form->createView()
            ]
        );
    }


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
        $tag = new Tags();
        $tag->setName("cars");

        $manager = $this->getDoctrine()->getManager();
        for ($i = 1; $i < 100; $i++) {
            $product = new Product();
            $product->setName('BMW X5');
            $product->setDescription('New car');
            $product->setPrice(50000);
            $product->setCreatedAt(new \DateTime());
            $product->setUpdatedAt(new \DateTime());
            $manager->persist($product);
        }

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
    public function hi(ProductRepository $repo)
    {

        $product = $repo->findByCustom('Audi');

        dump($product);



        return $this->render('data/index.html.twig');
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