<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\SectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CoucouController extends AbstractController
{
    public function __construct(
        private SectionRepository $sectionRepository
    ) {
    }

    #[Route('/', name: 'coucou')]
    public function index(EntityManagerInterface $em): Response
    {
        $posts = $em->getRepository(Post::class)->findByTitlteDesc();
        return $this->render('coucou/index.html.twig', [
            'title' => 'Coucou',
            'posts' => $posts
        ]);
    }

    #[Route('/section/{id}', name: 'section')]
    public function section(int $id): Response
    {
        $section = $this->sectionRepository->findOneBy(['id' => $id]);
        return $this->render('coucou/section.html.twig', [
            'title' => $section->getSectionTitle(),
            'section' => $section,
        ]);
    }
}
