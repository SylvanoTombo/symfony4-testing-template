<?php

namespace App\Tests;

use App\Entity\Voucher;
use App\Services\CartService;

class CartServiceTest extends TestCase
{

    /**
     * 
     */
    protected $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->entityManager->getRepository(Voucher::class);

    }

    public function testSomething()
    {
        // Arrange
        $cartService = self::$container->get(CartService::class); 

        $voucher = new Voucher();
        $voucher->setName('La vache qui rit');
        $cartService->setVoucher($voucher);

        // Act
        $cartService->historize();

        // Assert
        $voucherHistories = $this->repository->findAll();

        $this->assertCount(1, $voucherHistories);
    }
}
