<?php


namespace App\Controller;


use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/posts", name="app_posts")
     * @author Stefan Stanic <stefan.stanic@infostud.com>
     */
    public function posts()
    {
        $posts = $this->entityManager->getRepository(Post::class)->getAllPosts();

        return $this->render('components/posts/posts.html.twig', [
            'posts' => $posts
        ]);
    }


    /**
     * @Route("/posts/{id}")
     * @author Stefan Stanic <stefan.stanic@infostud.com>
     */
    public function nesto($id)
    {

    }
}