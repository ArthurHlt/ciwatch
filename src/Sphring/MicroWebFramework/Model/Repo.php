<?php
namespace Sphring\MicroWebFramework\Model;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use JMS\Serializer\Annotation\Type;


/**
 * @Entity()
 */
class Repo
{
    /**
     * @var UserRepo[]
     * @OneToMany(targetEntity="UserRepo", mappedBy="repo")
     */
    protected $userRepos;
    /**
     * @Id()
     * @Column(type="integer")
     * @Type("integer")
     */
    private $id;
    /**
     * @Column(type="string", nullable=true)
     * @Type("string")
     */
    private $name;
    /**
     * @Column(type="string", nullable=true)
     * @Type("string")
     */
    private $full_name;
    /**
     * @var string
     * @Column(type="string")
     * @Type("string")
     */
    private $branch;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * @param mixed $full_name
     */
    public function setFullName($full_name)
    {
        $this->full_name = $full_name;
    }


    /**
     * @return string
     */
    public function getBranch()
    {
        return $this->branch;
    }

    /**
     * @param string $branch
     */
    public function setBranch($branch)
    {
        $this->branch = $branch;
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