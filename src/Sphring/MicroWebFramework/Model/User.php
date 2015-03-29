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
     * @var Repo[]
     * @ManyToMany(targetEntity="Repo", inversedBy="users")
     * @Type("array<Sphring\MicroWebFramework\Model\Repo>")
     */
    private $repos = [];
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
     * @return Repo[]
     */
    public function getRepos()
    {
        return $this->repos;
    }

    /**
     * @param Repo[] $repos
     */
    public function setRepos($repos)
    {
        foreach ($repos as $repo) {
            $this->addRepo($repo);
        }
    }

    public function addRepo(Repo $repo)
    {
        if (is_array($this->repos) && in_array($repo, $this->repos)) {
            return;
        }
        $this->repos[] = $repo;
        $repo->addUser($this);
    }

    public function delRepo(Repo $repo)
    {
        if (is_array($this->repos) && !in_array($repo, $this->repos)) {
            return;
        }
        $repo->delUser($this);
        unset($this->repos[array_search($repo, $this->repos)]);
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
    
}
