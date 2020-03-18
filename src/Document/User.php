<?php


namespace App\Document;

use App\Entity\CartHistory;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class User
{
    /**
     * @MongoDB\Id(strategy="UUID")
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $name;

    /**
     * @var array
     * @MongoDB\Field(name="cartHistories", type="collection")
     */
    protected $cartHistoriesId;

    /**
     * @var ArrayCollection
     */
    protected $cartHistories;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->cartHistories = new ArrayCollection();
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
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCartHistories(): ArrayCollection
    {
        return $this->cartHistories;
    }

    /**
     * @param CartHistory $cartHistory
     * @return User
     */
    public function addCartHistory(CartHistory $cartHistory): self
    {
        if (! $this->cartHistories->contains($cartHistory))
        {
            $this->cartHistoriesId[] = $cartHistory;
            $this->cartHistories->add($cartHistory);
        }

        return $this;
    }

    /**
     * @param CartHistory $cartHistory
     * @return User
     */
    public function removeCartHistory(CartHistory $cartHistory): self
    {
        if ($this->cartHistories->contains($cartHistory))
        {
             $this->cartHistoriesId = array_filter($this->cartHistoriesId, function ($id) use ($cartHistory)
            {
                return $cartHistory->getId() != $id;
            });
            $this->cartHistories->remove($cartHistory);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getCartHistoriesId(): ?array
    {
        return $this->cartHistoriesId;
    }

}