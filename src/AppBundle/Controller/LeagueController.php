<?php

namespace AppBundle\Controller;


use AppBundle\Entity\League;
use AppBundle\Manager\LeagueManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LeagueController extends Controller
{
    /**
     * @var LeagueManager
     */
    private $leagueManager;

    /**
     * LeagueController constructor.
     * @param LeagueManager $leagueManager
     */
    public function __construct(LeagueManager $leagueManager)
    {
        $this->leagueManager = $leagueManager;
    }

    /**
     * @Route("/leagues/{id}", name="show_league")
     * @Method("GET")
     *
     * @param int $id
     * @return JsonResponse
     */
    public function showLeagueAction(int $id): JsonResponse
    {
        $league = $this->leagueManager->find($id);
        
        return new JsonResponse($league->getData());
    }

    /**
     * @Route("/leagues", name="list_league")
     * @Method("GET")
     *
     * @return JsonResponse
     */
    public function listLeagueAction(): JsonResponse
    {
        $leagues = $this->leagueManager->findAll();
        $result = [];
        foreach ($leagues as $league) {
            $result[] = $league->getData();
        }
        
        return new JsonResponse($result);
    }

    /**
     * @Route("/leagues", name="create_league")
     * @Method("POST")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createLeagueAction(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $league = new League();
        $league->setData($data);

        $this->leagueManager->save($league);

        return new JsonResponse($league->getData());
    }

    /**
     * @Route("/leagues/{id}", name="update_league")
     * @Method("PUT")
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateLeagueAction(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        /** @var League $league */
        $league = $this->leagueManager->find($id);
        $league->setData($data);

        $this->leagueManager->save($league);

        return new JsonResponse($league->getData());
    }

    /**
     * @Route("/leagues/{id}", name="delete_league")
     * @Method("DELETE")
     *
     * @param int $id
     * @return JsonResponse
     */
    public function deleteLeagueAction(int $id): JsonResponse
    {
        /** @var League $league */
        $this->leagueManager->delete($id);

        return new JsonResponse(['success' => true]);
    }
}