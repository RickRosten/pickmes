<?php

namespace App\Controller;

use App\Entity\Pickme;
use App\Entity\User;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CustomCRUDController extends CRUDController
{
    const deniedMessage = "Куда лезешь малютка Пыкми";
    private Security $security;

    public function __construct(Security $security){
        $this->security = $security;
    }

    protected function preEdit(Request $request, object $object): ?Response
    {
        if ($object instanceof User) {
            if (!$this->security->isGranted('ROLE_SUPER_ADMIN') &&
                $this->security->getUser()->getId() != $object->getId()) {
                throw new AccessDeniedException(self::deniedMessage);
            }
        } elseif ($object instanceof Pickme) {
            if (!$this->security->isGranted('ROLE_SUPER_ADMIN')) {
                $userIds = [];
                foreach($object->getUser() as $user) {
                    $userIds[] = $user->getId();
                }
                if (!empty($userIds) && !in_array($this->security->getUser()->getId(), $userIds)) {
                throw new AccessDeniedException(self::deniedMessage);
            }
            }
        }

        return null;
    }
}
