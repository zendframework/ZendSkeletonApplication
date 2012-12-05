<?php

namespace Application\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\SchemaValidator;

class Schema implements ServiceLocatorAwareInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * Returns a list of all entity classes found in
     * the Entity directory.
     *
     * @return array
     */
    public function getEntityClasses()
    {
        $nsArr     = explode('\\', __NAMESPACE__);
        $namespace = array_shift($nsArr);
        $entityNs  = sprintf('%s\\Entity', $namespace);
        $entityDir = __DIR__ . '/../Entity';
        $files     = scandir($entityDir);
        $classes   = array();
        foreach ($files as $file) {
            if (preg_match('/^(?<name>[A-Za-z]+)\.php$/', $file, $match)) {
                $className = sprintf('%s\\%s', $entityNs, $match['name']);
                if (class_exists($className)) {
                    $classes[] = $className;
                }
            }
        }
        return $classes;
    }

    /**
     * Returns an array containing the meta data for each entity
     *
     * @return array
     */
    public function getEntityMetaData()
    {
        /** @var $em \Doctrine\ORM\EntityManager */
        $entityManager = $this->getEntityManager();
        $entityArr     = $this->getEntityClasses();
        $entityMetaArr = array();
        foreach ($entityArr as $entityClass) {
            $entityMetaArr[] = $entityManager->getClassMetadata($entityClass);
        }
        return $entityMetaArr;
    }

    /**
     * Returns the SQL statements that will be used to create the db schema
     *
     * @return array
     */
    public function getSchemaSql()
    {
        $entityManager = $this->getEntityManager();
        $schemaTool    = new SchemaTool($entityManager);
        $entityMeta    = $this->getEntityMetaData();
        $schema        = $schemaTool->getCreateSchemaSql($entityMeta);
        return $schema;
    }

    public function getUpdateSchemaSql()
    {
        $entityManager = $this->getEntityManager();
        $schemaTool    = new SchemaTool($entityManager);
        $entityMeta    = $this->getEntityMetaData();
        $schema        = $schemaTool->getUpdateSchemaSql($entityMeta);
        return $schema;
    }

    /**
     * Rebuild the schema.
     */
    public function updateSchema()
    {
        $entityManager = $this->getEntityManager();
        $schemaTool    = new SchemaTool($entityManager);
        $entityMeta    = $this->getEntityMetaData();
        $schemaTool->updateSchema($entityMeta);
    }

    /**
     * Adds an administrator
     */
    public function addDefaultUser()
    {
        $entityManager = $this->getEntityManager();
        $admin = new Administrator();

    }

    /**
     * @return bool
     */
    public function validateSchema()
    {
        $entityManager   = $this->getEntityManager();
        $schemaValidator = new SchemaValidator($entityManager);

        $entityMeta = $this->getEntityMetaData();
        foreach ($entityMeta as $meta) {
            $ce = $schemaValidator->validateClass($meta);
            if (!empty($ce)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return array|\Doctrine\ORM\EntityManager|object
     */
    public function getEntityManager()
    {
        if (!$this->entityManager) {
            $this->entityManager = $this->getServiceLocator()->get('EntityManager');
        }
        return $this->entityManager;
    }

    /**
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}