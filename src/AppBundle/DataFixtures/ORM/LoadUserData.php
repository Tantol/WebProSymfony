<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Group;

class LoadUserData implements FixtureInterface, ContainerAwareInterface {
    
    private $container;
    
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        
        $group = new Group();
        $group->setName('User');
        $group->setRole('ROLE_USER');
        
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@admin.com');
        $user->addGroup($group);
        
        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, 'admin');
        $user->setPassword($password);
        
        $manager->persist($group);
        $manager->persist($user);
        $manager->flush();
    }

    /**
     * Sets the container.
     *  
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

}
