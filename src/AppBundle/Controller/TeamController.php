<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Team;
use AppBundle\Manager\TeamManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TeamController extends Controller
{
    /**
     * @var TeamManager
     */
    private $teamManager;

    /**
     * LeagueController constructor.
     * @param TeamManager $teamManager
     */
    public function __construct(TeamManager $teamManager)
    {
        //TODO: чого воно тут є?
        $this->teamManager = $teamManager;
    }

    /**
     * @Route("/{id}/team", name="show_team")
     * @Method("GET")
     *
     * @param int $id
     * @return JsonResponse
     */
    public function showTeamAction(int $id): JsonResponse
    {
        $team = $this->teamManager->find($id);

        return new JsonResponse($team->getData());
    }

    /**
     * @Route("/teams", name="list_team")
     * @Method("GET")
     *
     * @return JsonResponse
     */
    public function listTeamAction(): JsonResponse
    {
        $teams = $this->teamManager->findAll();
        $result = [];
        foreach ($teams as $team) {
            $result[] = $team->getData();
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/team", name="create_team")
     * @Method("POST")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createTeamAction(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        /** @var Team $team */
        $team = new Team();
        $team = $this->teamManager->setTeamData($team, $data);
        $this->teamManager->save($team);

        return new JsonResponse($team->getData());
    }

    /**
     * @Route("/{id}/team", name="update_team")
     * @Method("PUT")
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateTeamAction(Request $request, int $id): JsonResponse
    {
        //TODO: чого іd перед Request?
        $data = json_decode($request->getContent(), true);
        /** @var Team $team */
        $team = $this->teamManager->find($id);
        $team = $this->teamManager->setTeamData($team, $data);
        $this->teamManager->save($team);

        return new JsonResponse($team->getData());
    }

    /**
     * @Route("/{id}/team", name="delete_team")
     * @Method("DELETE")
     *
     * @param int $id
     * @return JsonResponse
     */
    public function deleteTeamAction(int $id): JsonResponse
    {
        /** @var Team $team */
        $this->teamManager->delete($id);

        return new JsonResponse(['success' => true]);
    }
}