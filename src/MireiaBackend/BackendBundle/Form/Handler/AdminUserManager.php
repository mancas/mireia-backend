<?php

namespace MireiaBackend\BackendBundle\Form\Handler;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use MireiaBackend\BackendBundle\Entity\AdminUser;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;

class AdminUserManager
{
    private $entityManager;
    private $encoderFactory;

    public function __construct(EntityManager $entityManager, EncoderFactory $encoderFactory)
    {
        $this->entityManager = $entityManager;
        $this->encoderFactory = $encoderFactory;
    }

    public function save(AdminUser $user, $updatePwd = false)
    {
        if (!$user->getSalt()) {
            $user->setSalt(md5(time() . AdminUser::AUTH_SALT));
        }

        if ($updatePwd) {
            $encoder = $this->encoderFactory->getEncoder($user);
            $passwordEncoded = $encoder->encodePassword($user->getPassword(), $user->getSalt());
            $user->setPassword($passwordEncoded);
        }
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}