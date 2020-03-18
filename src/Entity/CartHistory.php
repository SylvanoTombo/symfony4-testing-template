<?php

namespace App\Entity;

use App\Document\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartHistoryRepository")
 */
class CartHistory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $usersId = [];

    /**
     * @var ArrayCollection|User[]
     */
    private $users;

    /**
     * CartHistory constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return  string[]
     */
    public function getUsersId()
    {
        return $this->usersId;
    }

    /**
     * @param User $user
     * @return CartHistory
     */
    public function addUser(User $user):self
    {
        if (!$this->users->contains($user))
        {
            $this->usersId[] = $user->getId();
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user))
        {
            $this->usersId = array_filter($this->usersId, function ($id) use ($user)
            {
                return $user->getId() != $id;
            });
            $this->users->remove($user);
        }

        return $this;
    }

    /**
     * @return User[]|ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

}
