<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use App\Services\TextFormatter;
use App\Services\TextFormatterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class BlogController extends Controller
{
    /**
     * @Route("/post/{post}", name="post")
     */
    public function post($adminEmail, Post $post, PostRepository $postRepository)
    {
        dump($adminEmail);
        die();

        $p = $postRepository->find(1);

        dump($p);

        dump($post);

        die('ok');

    }

    /**
     * @Route("/blog", name="blog")
     */
    public function index(
        TextFormatterInterface $formatter,
        AdapterInterface $cache,
        \Doctrine\ORM\EntityManagerInterface $manager
    )
    {


        $formatter->formatText('hello');

        die();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }
}
