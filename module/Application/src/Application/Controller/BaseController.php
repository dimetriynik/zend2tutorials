<?php

namespace Application\Controller;

use \Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\MvcEvent;

class BaseController extends AbstractActionController
{

    protected $entityManager;

    /**
     * @param MvcEvent $e
     * @return mixed
     */
    public function onDispatch(MvcEvent $e)
    {

        $this->setEntityManager($this->getServiceLocator()->get(EntityManager::class));
        return parent::onDispatch($e); // TODO: Change the autogenerated stub
    }

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {

        return $this->entityManager;

    }


}