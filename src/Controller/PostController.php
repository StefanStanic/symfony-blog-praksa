<?php


namespace App\Controller;


use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

        return $this->render('components/posts/posts_wrapper.html.twig', [
            'posts' => $posts
        ]);
    }


    /**
     * @Route("/post/delete", name="app_delete_post", methods={"POST"})
     * @author Stefan Stanic <stefan.stanic@infostud.com>
     */
    public function deletePost(Request $request)
    {
        $postId = $request->get('postId');
        if (empty($postId)) {
            return false;
        }

        //delete object by id
        $post = $this->entityManager->getRepository(Post::class)->find($postId);
        if (empty($post)) {
            return false;
        }

        $post->setDeleted(1);
        $this->entityManager->persist($post);
        $this->entityManager->flush();

        $posts = $this->entityManager->getRepository(Post::class)->getAllPosts();
        $html = $this->render('components/posts/posts.html.twig', [
            'posts' => $posts
        ])->getContent();

        return new JsonResponse([
            'status' => 'ok',
            'html' => $html
        ]);
    }
}