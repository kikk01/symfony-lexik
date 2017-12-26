<?php

namespace Lexik\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Group_name
 *
 * @ORM\Table(name="group_name")
 * @ORM\Entity(repositoryClass="Lexik\TestBundle\Repository\Group_nameRepository")
 */
class Group_name
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=30, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Lexik\TestBundle\Entity\User", mappedBy="userGroup")
     */
    private $users;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Group_name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \Lexik\TestBundle\Entity\User $user
     *
     * @return Group_name
     */
    public function addUser(\Lexik\TestBundle\Entity\User $user)
    {
        $this->users[] = $user;
        // user link to group
        $user->setUserGroup($this);

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Lexik\TestBundle\Entity\User $user
     */
    public function removeUser(\Lexik\TestBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
