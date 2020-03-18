<?php

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\NullOutput;

class TestCase extends KernelTestCase
{

    /**
     * @var Application
     */
    protected $console;

    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $entityManager;

    public function setUp(): void
    {
        parent::setUp();

        $kernel = self::bootKernel();

        $this->console = new Application($kernel);

        $this->createSchema();

        $this->entityManager = $kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    public function createSchema()
    {
        $command = new ArrayInput([
            'command' => 'doctrine:schema:create'
        ]);

        $output =  new BufferedOutput();

        $this->console->doRun($command, $output);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
    }
}