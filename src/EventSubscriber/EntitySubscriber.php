<?php

namespace App\EventSubscriber;


use App\Document\User;
use App\Entity\CartHistory;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\EventSubscriber;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use function Sodium\add;

class EntitySubscriber implements EventSubscriber
{
    /**
     * @var DocumentManager
     */
    private $documentManager;

    /**
     * EntitySubscriber constructor.
     * @param DocumentManager $documentManager
     */
    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    public function postLoad(LifecycleEventArgs $event)
    {
        $cartHistory = $event->getEntity();
        $em = $event->getEntityManager();

        $userReflProp = $em->getClassMetadata(CartHistory::class)
                            ->reflClass->getProperty('users');
        $userReflProp->setAccessible(true);

        $usersId = $cartHistory->getUsersId();

        $values = [];

        foreach ($usersId as $userId) {
            $values[] = $this->documentManager->getReference(User::class, $userId);
        }

        $userReflProp->setValue($cartHistory, $values);
    }

    public function prePersit(LifecycleEventArgs $eventArgs)
    {

    }

    /**
     * @inheritDoc
     */
    public function getSubscribedEvents()
    {
        return [
            Events::postLoad,
            Events::prePersist
        ];
    }
}
