<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoucherRepository")
 */
class Voucher
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VoucherHistory", mappedBy="voucher", orphanRemoval=true)
     */
    private $voucherHistories;

    public function __construct()
    {
        $this->voucherHistories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|VoucherHistory[]
     */
    public function getVoucherHistories(): Collection
    {
        return $this->voucherHistories;
    }

    public function addVoucherHistory(VoucherHistory $voucherHistory): self
    {
        if (!$this->voucherHistories->contains($voucherHistory)) {
            $this->voucherHistories[] = $voucherHistory;
            $voucherHistory->setVoucher($this);
        }

        return $this;
    }

    public function removeVoucherHistory(VoucherHistory $voucherHistory): self
    {
        if ($this->voucherHistories->contains($voucherHistory)) {
            $this->voucherHistories->removeElement($voucherHistory);
            // set the owning side to null (unless already changed)
            if ($voucherHistory->getVoucher() === $this) {
                $voucherHistory->setVoucher(null);
            }
        }

        return $this;
    }
}
