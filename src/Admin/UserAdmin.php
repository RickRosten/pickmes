<?php


namespace App\Admin;

use App\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AdminInterface;
use Knp\Menu\ItemInterface;

final class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('username')
            ->add('pickmes', null, [
                'by_reference' => false,
                'multiple' => true,
                'required' => false,
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('username')
            ->add('roles');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('username')
            ->add('roles')
            ->add('pickmes', null, [
                'associated_property' => 'name',
            ])
            ->add('_actions', null, [
                'actions' => [
                    'edit' => [],
                    'show' => [],
                ],
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('username')
            ->add('roles')
            ->add('pickmes');
    }

    /**
     * Custom tab menu to link User -> Pickmes
     */
    protected function configureTabMenu(ItemInterface $menu, $action, AdminInterface $childAdmin = null): void
    {
        if ($action === 'list') {
            return;
        }
        /** @var User $subject */
        $subject = $this->getSubject();

        if (!$subject || null === $subject->getId()) {
            return;
        }

        $menu->addChild('Related Pickmes', [
            'route' => 'admin_app_pickme_list',
            'routeParameters' => [
                'filter[user][value]' => $subject->getId(),
            ],
        ]);
    }


}
