<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('')]
class BlogController extends AbstractController
{
    #[Route('/admin/blog', name: 'app_blog_index', methods: ['GET'])]
    public function index(BlogRepository $blogRepository): Response
    {
        return $this->render('blog/index.html.twig', [
            'blogs' => $blogRepository->findAll(),
        ]);
    }

    #[Route('/user/blog', name: 'app_user_blog_index', methods: ['GET'])]
    public function indexUser(BlogRepository $blogRepository): Response
    {
        return $this->render('blog/index.html.twig', [
            'blogs' => $blogRepository->findAll(),
        ]);
    }

    #[Route('/admin/blog/new', name: 'app_blog_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $blog = new Blog();
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($blog);
            $entityManager->flush();

            return $this->redirectToRoute('app_blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('blog/new.html.twig', [
            'blog' => $blog,
            'form' => $form,
        ]);
    }

    #[Route('/admin/blog/{id}', name: 'app_blog_show', methods: ['GET'])]
    public function show(Blog $blog): Response
    {
        return $this->render('blog/show.html.twig', [
            'blog' => $blog,
        ]);
    }

    #[Route('/admin/blog/{id}/edit', name: 'app_blog_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Blog $blog, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('blog/edit.html.twig', [
            'blog' => $blog,
            'form' => $form,
        ]);
    }

    #[Route('/admin/blog/{id}', name: 'app_blog_delete', methods: ['POST'])]
    public function delete(Request $request, Blog $blog, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blog->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($blog);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_blog_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/admin/blog/x/rest-api', name: 'REST_API_blog_get', methods: ['GET'])]
    public function REST_API_GET(BlogRepository $blogRepository)
    {
        $entity_array = $blogRepository->findAll();

        $dict_array = array_map(function($e) {
            return $e->get();
        }, $entity_array);

        return new JsonResponse(["data"=>$dict_array]);
    }

    #[Route('/admin/blog/x/rest-api/pagination', name: 'REST_API_blog_get_pagination', methods: ['GET'])]
    public function REST_API_GET_pagination(BlogRepository $blogRepository)
    {
        $current_page = 1;

        $limit_items = 10;

        $total_items = $blogRepository->count();
        
        $last_page = ceil($total_items / $limit_items);

        $skip_items = ($current_page - 1) * $limit_items;
        
        $entity_array = $blogRepository->findBy([], null, $limit_items, $skip_items);
    
        $dict_array = array_map(function($e) {
            return $e->get();
        }, $entity_array);
    
        return new JsonResponse([
            "data" => [
                "pagination"=>[
                    "current_page" => $current_page,
                    "last_page" => $last_page,
                    "limit_items" => $limit_items,
                    "skip_items" => $skip_items,
                    "total_items" => $total_items,
                ],
                "array"=>$dict_array,
            ]
        ]);
    }
}
