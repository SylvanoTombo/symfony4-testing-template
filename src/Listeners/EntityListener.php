<?php


namespace App\Listeners;


use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\Event\LifecycleEventArgs;

class EntityListener
{
    /**
     * @var DocumentManager
     */
    private $documentManager;

    /**
     * EntityListener constructor.
     * @param DocumentManager $documentManager
     */
    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
    }

}