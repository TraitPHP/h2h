<?php

namespace App\EventSubscriber;

use App\Entity\FormData;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Service\FormDataService;

class FormDataSubscriber implements EventSubscriberInterface
{
    /**
     * @var FormDataService
     */
    private $dataService;

    public function __construct(FormDataService $dataService)
    {
        $this->dataService = $dataService;
    }

    public function onPostPersist(LifecycleEventArgs $args)
    {
        $obj = $args->getObject();
        if ($obj instanceof FormData) {
            $this->dataService->sendFormDataMail($obj);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'postPersist' => 'onPostPersist',
        ];
    }
}
