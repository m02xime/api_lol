<?php

namespace App\Controller;

use App\Entity\Project;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api')]
class ProjectController extends AbstractController
{
    #[Route('/project', name: 'app_project', methods: ['GET'])]
    public function index(ManagerRegistry $doctrine): JsonResponse
    {
        $project = $doctrine->getRepository(Project::class)->findall();
        $data = array();

        foreach ($project as $projects) {
            $data[] = [
                'id' => $projects->getId(),
                'name' => $projects->getName(),
                'description' => $projects->getDescription(),
            ];
        }
        return $this->json($data);
    }

    #[Route('/project/{id}', name: 'one_project', methods: ['GET'])]
    public function getbyid(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $project = $doctrine->getRepository(Project::class)->find($id);
        $data = [
            'id' => $project->getId(),
            'name' => $project->getName(),
            'description' => $project->getDescription(),
        ];
        return $this->json($data);
    }

    #[Route('/project', name: 'add_project', methods: ['POST'])]
    public function push(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $entityManager = $doctrine->getManager();

        $project = new Project();
        $project->setName($request->get('name'));
        $project->setDescription($request->get('description'));

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($project);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->json('Saved new product with id ' . $project->getId());
    }

    #[Route('/project/{id}', name: 'edit_project', methods: ['POST'])]
    public function edit(ManagerRegistry $doctrine, Request $request, int $id): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $project = $entityManager->getRepository(Project::class)->find($id);

        if (!$project) {
            return $this->json('No project found for id ' . $id, 404);
        }

        $project->setName($request->get('name'));
        $project->setDescription($request->get('description'));
        $entityManager->persist($project);
        $entityManager->flush();

        $data =  [
            'id' => $project->getId(),
            'name' => $project->getName(),
            'description' => $project->getDescription(),
        ];

        return $this->json($data);
    }

    #[Route('/project/{id}', name: 'delete_project', methods: ['DELETE'])]
    public function delete(ManagerRegistry $doctrine, int $id): JsonResponse
    {

        $entityManager = $doctrine->getManager();
        $project = $entityManager->getRepository(Project::class)->find($id);

        if (!$project) {
            return $this->json('No project found for id ' . $id, 404);
        }


        $entityManager->remove($project);
        $entityManager->flush();

        return $this->json('Deleted product with id ' . $id);
    }
}
