<?php
namespace Sphring\MicroWebFramework\Model;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use JMS\Serializer\Annotation\Type;


/**
 * @Entity()
 */
class Repo
{
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
     * @Column(type="boolean", nullable=false, options={"default":false})
     * @Type("boolean")
     */
    private $watch;

    /**
     * @var User[]
     * @ManyToMany(targetEntity="User", inversedBy="repos")
     * @JoinTable(
     *     name="User_To_Repo",
     *     joinColumns={@JoinColumn(name="repo_id", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@JoinColumn(name="user_id", referencedColumnName="id", nullable=false)}
     * )
     * @Type("array<Sphring\MicroWebFramework\Model\User>")
     */
    private $users = [];
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
        $this->watch = $watch;
    }

    /**
     * @return User
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param User[] $users
     */
    public function setUsers($users)
    {
        foreach ($users as $user) {
            $this->addUser($user);
        }
    }

    public function addUser(User $user)
    {
        if (is_array($this->users) && in_array($user, $this->users)) {
            return;
        }
        $this->users[] = $user;
        $user->addRepo($this);
    }

    public function delUser(User $user)
    {
        if (is_array($this->users) && !in_array($user, $this->users)) {
            return;
        }
        $user->delRepo($this);
        unset($this->users[array_search($user, $this->users)]);
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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

}