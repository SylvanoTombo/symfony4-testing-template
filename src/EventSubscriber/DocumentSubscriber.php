<?php


namespace App\EventSubscriber;


use App\Document\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Doctrine\ODM\MongoDB\Events;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class DocumentSubscriber implements EventSubscriber
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * DocumentSubscriber constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function postLoad(LifecycleEventArgs $event)
    {
        $user = $event->getDocument();
        $dm = $event->getDocumentManager();

        $cartHistoryReflProp = $dm->getClassMetadata(User::class)
                            ->reflClass->getProperty('cartHistories');
        $cartHistoryReflProp->setAccessible(true);

        $cartHistoriesId = $user->getCartHistoriesId();

        $values = [];

        if ($cartHistoriesId)
        {
            foreach ($cartHistoriesId as $cartHistoryId) {
                $values[] = $this->entityManager->getReference(User::class, $cartHistoryId);
            }
        }

        $cartHistoryReflProp->setValue($user, $values);
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