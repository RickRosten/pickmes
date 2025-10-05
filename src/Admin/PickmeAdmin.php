<?php


namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Vich\UploaderBundle\Form\Type\VichImageType;

final class PickmeAdmin extends AbstractAdmin
{
    protected function configureBatchActions(array $actions): array
    {
        return parent::configureBatchActions([]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('group.common', ['class' => 'col-md-8', 'label' => 'Общая информация'])->end()
            ->with('group.image', ['class' => 'col-md-4', 'label' => 'Медиа'])->end();

        $form
            ->with('group.common')
                ->add('name')
                ->add('description')
                ->add('User', null, [
                    'by_reference' => false,
                    'multiple' => true,
                    'required' => false,
                ])
            ->end()
            ->with('group.image')
                ->add('profilePicFile', VichImageType::class, [
                    'required' => false,
                    'allow_delete' => true,
                ])
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('description')
            ->add('User');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('name')
            ->add('description')
            ->add('profilePicFile', null, [
                'template' => 'admin/display_profile_pic.html.twig',
            ])
            ->add('User', null, [
                'associated_property' => 'username',
            ])
            ->add('_actions', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [
                        'template' => 'admin/list__action_edit_restricted.html.twig', // просто скрывает кнопку!
                    ],
                ],
            ]);    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('description')
            ->add('User');
    }
}
