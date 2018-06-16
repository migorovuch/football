<?php

namespace AppBundle\Manager;

use AppBundle\Entity\League;
use Doctrine\ORM\EntityManager;

/**
 * Class LeagueManager
 * @package AppBundle\Manager
 */
class LeagueManager
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * LeagueManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param League $league
     */
    public function save(League $league)
    {
        $this->entityManager->persist($league);
        $this->entityManager->flush();
    }

    /**
     * @param $id
     * @return null|League
     */
    public function find(int $id)
    {
        /** @var League $league */
        $league = $this->entityManager->find(League::class, $id);

        return $league;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->entityManager->getRepository(League::class)->findAll();
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        /** @var League $league */
        $league = $this->entityManager->find(League::class, $id);
        $this->entityManager->remove($league);
        $this->entityManager->flush();
    }
}
