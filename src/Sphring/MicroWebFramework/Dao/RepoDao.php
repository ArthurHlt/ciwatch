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


use Doctrine\ORM\Query\Expr\Join;
use Sphring\MicroWebFramework\Model\Repo;
use Sphring\MicroWebFramework\Model\User;
use Sphring\MicroWebFramework\Model\UserRepo;

class RepoDao extends AbstractDao
{
    public function findRepoWatched(User $user)
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('r')
            ->from(Repo::class, 'r')
            ->join(UserRepo::class, 'ur', Join::WITH, 'ur.repo = r')
            ->where('ur.user = ?1')
            ->andWhere('ur.watch = ?2')
            ->setParameter(1, $user)
            ->setParameter(2, true);
        $q = $qb->getQuery();
        return $q->getResult();
    }

}