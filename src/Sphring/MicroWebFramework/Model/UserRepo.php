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


namespace Sphring\MicroWebFramework\Model;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * Class UserRepo
 * @package Sphring\MicroWebFramework\Model
 * @Entity()
 * @Table(name="users_repos")
 */
class UserRepo
{
    /**
     * @var int
     * @Id()
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="userRepos")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @var Repo
     * @ManyToOne(targetEntity="Repo", inversedBy="userRepos")
     * @JoinColumn(name="repo_id", referencedColumnName="id")
     */
    private $repo;
    /**
     * @var boolean
     * @Column(type="boolean", nullable=false, options={"default":false})
     */
    private $watch;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return Repo
     */
    public function getRepo()
    {
        return $this->repo;
    }

    /**
     * @param Repo $repo
     */
    public function setRepo(Repo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return mixed
     */
    public function getWatch()
    {
        return $this->watch;
    }

    /**
     * @param mixed $watch
     */
    public function setWatch($watch)
    {
        $this->watch = (boolean)$watch;
    }


}