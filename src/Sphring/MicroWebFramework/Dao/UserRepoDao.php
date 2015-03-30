<?php
/**
 * Copyright (C) 2015 Arthur Halet
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 30/03/2015
 */


namespace Sphring\MicroWebFramework\Dao;


use Sphring\MicroWebFramework\Model\Repo;
use Sphring\MicroWebFramework\Model\User;
use Sphring\MicroWebFramework\Model\UserRepo;

class UserRepoDao extends AbstractDao
{
    /**
     * @param User $user
     * @param Repo $repo
     * @return UserRepo
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByUserRepo(User $user, Repo $repo)
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('ur')
            ->from(UserRepo::class, 'ur')
            ->where('ur.user = ?1')
            ->andWhere('ur.repo = ?2')
            ->setParameter(1, $user)
            ->setParameter(2, $repo);
        $q = $qb->getQuery();
        return $q->getSingleResult();
    }
}