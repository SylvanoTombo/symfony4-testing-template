<?php

namespace App\Services;

use App\Entity\Voucher;
use App\Entity\VoucherHistory;
use Doctrine\ORM\EntityManagerInterface;

class CartService
{
    protected $cart;

    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->cart = collect();
        $this->entityManager = $entityManager;
    }

    public function setVoucher(Voucher $voucher): self
    {
        if (! $this->cart->contains($voucher))
        {
            $this->cart->add($voucher);
        }

        return $this;
    }

    public function historize(): self
    {
        $this->cart->each(function (Voucher $voucher) {

            $voucherHistory = new VoucherHistory();
            $voucherHistory->setVoucher($voucher);

            $this->entityManager->persist($voucherHistory);
            $this->entityManager->flush();

        });

        return $this;
    }
}