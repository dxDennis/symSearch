<?php


namespace App\AppBundle\Menu;


use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class MenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var UserInterface|null
     */
    private $currentUser;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory, Security $security)
    {
        $this->factory = $factory;
        $this->currentUser = $security->getUser();
    }

    /**
     * @param array $options
     * @return ItemInterface
     */
    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'navbar-nav mr-auto');

        $menu->addChild('Dashboard', ['route' => 'main']);
        $menu->addChild('Article', ['route' => 'article.view']);

        return $menu;
    }

    public function createUserMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'navbar-nav');

        $dropdown = $menu->addChild(
            $this->currentUser->getUsername(),
            [
                'attributes' => [
                    'icon' => 'fa fa-user-circle',
                    'dropdown' => true,
                ],
            ]
        );

        $dropdown->addChild(
            'Profile',
            [
                'route' => 'app_logout',
            ]
        );

        $dropdown->addChild(
            'Logout',
            [
                'route' => 'app_logout',
                'attributes' => [
                    'divider_prepend' => true,
                    'icon' => 'fa fa-sign-out',
                ],
            ]
        );

        // ... add more children
        return $menu;
    }
}