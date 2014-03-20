<?php
namespace CASEBase\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\EventManager\EventManagerAwareInterface;

class UserService implements ServiceLocatorAwareInterface, EventManagerAwareInterface
{
    use \Zend\EventManager\EventManagerAwareTrait;
    use \Zend\ServiceManager\ServiceLocatorAwareTrait;


    /**
     * 
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;
    
    /**
     *
     * @param unknown $entityManager
     */
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function setEntityManager($entityManager){
    	$this->entityManager = $entityManager;
    }

    /**
     *
     * @return CASEBase\Entity\User
     */
    public function create()
    {
        return $this->getServiceLocator()->get('CASEBase\Entity\User');
    }

    /**
     *
     * @param User $User
     */
    public function persist($User)
    {
        $this->entityManager->persist($User);
        $this->entityManager->flush();
    }

    /**
     * (non-PHPdoc)
     * @see \CASECommon\Service\EntityServiceInterface::findBy()
     * @return Firm[]
     */
    public function findBy(array $conditions, array $order = [],  $limit = null, $offset = null)
    {
        $entities = $this->entityManager->getRepository('CASEBase\Entity\User')->findBy($conditions, $order, $limit, $offset);
        return $entities;

    }

   
    public function delete($entity){

    }
}
