<?php

namespace App\Controller;

use App\Entity\Pool;
use App\Exception\PoolNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

#[AsController]
class DeletePoolController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private LoggerInterface $logger
    ) {
        $this->logger->info('DeletePoolController here');
    }

    public function __invoke($id)
    {
        $entity = $this->em->find('App\Entity\Pool', $id);
        if (isset($entity))
        {
            $this->em->remove($entity);
            $this->em->flush();
        }
        else
        {
            throw new PoolNotFoundException(sprintf('The pool "%s" does not exist.', $id));
        }
    }
}

