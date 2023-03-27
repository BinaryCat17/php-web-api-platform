<?php

namespace App\Controller;

use App\Entity\Pool;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

#[AsController]
class PostPoolController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private LoggerInterface $logger
    ) {
        $this->logger->info('PostPoolController here');
    }

    public function __invoke(Pool $pool): Pool
    {
        $this->em->persist($pool);
        $this->em->flush();
        return $pool;
    }
}
