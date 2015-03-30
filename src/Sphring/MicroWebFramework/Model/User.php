<?php
/**
 * Copyright (C) 2014 Arthur Halet
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 28/03/2015
 */

namespace Sphring\MicroWebFramework\Model;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use JMS\Serializer\Annotation\Type;

/**
 * @package Sphring\MicroWebFramework\Model
 * @Entity()
 * @Table(name="users")
 */
class User
{
    /**
     * @var integer $id
     * @Id()
     * @Column(type="integer")
     * @Type("integer")
     */
    protected $id;
    /**
     * @var string
     * @Column(type="string", nullable=true)
     * @Type("string")
     */
    protected $name;

    /**
     * @var string
     * @Column(type="string")
     * @Type("string")
     */
    protected $email;
    /**
     * @var string
     * @Column(type="string")
     * @Type("string")
     */
    protected $nickname;


    /**
     * @var string
     * @Column(type="string", nullable=true)
     * @Type("string")
     */
    protected $imageUrl;

    /**
     * @var UserRepo[]
     * @OneToMany(targetEntity="UserRepo", mappedBy="user")
     */
    protected $userRepos = [];
    /**
     * @var string
     * @Column(type="string", nullable=true)
     * @Type("string")
     */
    protected $scrutinizerToken;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getScrutinizerToken()
    {
        return $this->scrutinizerToken;
    }

    /**
     * @param string $scrutinizerToken
     */
    public function setScrutinizerToken($scrutinizerToken)
    {
        $this->scrutinizerToken = $scrutinizerToken;
    }

    /**
     * @return UserRepo[]
     */
    public function getUserRepos()
    {
        return $this->userRepos;
    }

    /**
     * @param UserRepo[] $userRepos
     */
    public function setUserRepos($userRepos)
    {
        $this->userRepos = $userRepos;
    }

    /**
     * @param UserRepo $userRepo
     * @return $this
     */
    public function addUserRepoAssociation(UserRepo $userRepo)
    {
        $this->userRepos[] = $userRepo;

        return $this;
    }

    public function removeUserRepoAssociation(UserRepo $userRepo)
    {
        $this->userRepos->removeElement($userRepo);
    }
}
