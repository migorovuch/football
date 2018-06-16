<?php

namespace AppBundle\Manager;


use AppBundle\Entity\League;
use AppBundle\Entity\Team;
use Doctrine\ORM\EntityManager;

/**
 * Class TeamManager
 * @package AppBundle\Manager
 */
class TeamManager
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * TeamManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Team $team
     */
    public function save(Team $team)
    {
        $this->entityManager->persist($team);
        $this->entityManager->flush();
    }

    /**
     * @param $id
     * @return null|Team
     */
    public function find(int $id)
    {
        /** @var Team $team */
        $team = $this->entityManager->find(Team::class, $id);

        return $team;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->entityManager->getRepository(Team::class)->findAll();
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        /** @var Team $team */
        $team = $this->entityManager->find(Team::class, $id);
        $this->entityManager->remove($team);
        $this->entityManager->flush();
    }

    /**
     * @param Team $team
     * @param array $jsonData
     * @return Team
     */
    public function setTeamData(Team $team, array $jsonData): Team
    {
        $team->setName($jsonData['name']);
        $team->setStrip($jsonData['strip']);
        $league = $this->entityManager->find(League::class, $jsonData['id_league']);
        $team->setLeague($league);

        return $team;
    }
}