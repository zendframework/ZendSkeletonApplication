<?php
namespace CASEBase\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\EventManager\EventManagerAwareInterface;

class RoleService implements ServiceLocatorAwareInterface, EventManagerAwareInterface
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
     * @return CASEBase\Entity\Role
     */
    public function create()
    {
        return $this->getServiceLocator()->get('CASEBase\Entity\Role');
    }

    /**
     *
     * @param Role $role
     */
    public function persist($role)
    {
        $this->entityManager->persist($role);
        $this->entityManager->flush();
    }

    /**
     * (non-PHPdoc)
     * @see \CASECommon\Service\EntityServiceInterface::findBy()
     * @return Firm[]
     */
    public function findBy(array $conditions = [], array $order = [],  $limit = null, $offset = null)
    {
        $entities = $this->entityManager->getRepository('CASEBase\Entity\Role')->findBy($conditions, $order, $limit, $offset);
        return $entities;

    }

    public function findByRoleName($rolName)
    {
        $roles = $this->findBy(array('roleId' => $rolName));
        return current($roles);
    }
    
    public function delete($entity){

    }
}
