<?php

namespace App\Controller;

use App\Entity\Pool;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

#[AsController]
class GetCollectionPoolController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private LoggerInterface $logger
    ) {
        $this->logger->info('GetCollectionPoolController here');
    }

    public function __invoke(): iterable |null
    {
        $poolRepo = $this->em->getRepository('App\Entity\Pool');
        return $poolRepo->findAll();
    }
}
