<?php

namespace App\Controller;

use App\Entity\Pool;
use App\Exception\PoolNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

#[AsController]
class PatchPoolController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private LoggerInterface $logger
    ) {
        $this->logger->info('PatchPoolController here');
    }

    public function __invoke($id, Pool $data): Pool
    {
        $entity = $this->em->find('App\Entity\Pool', $id);
        if (empty($entity))
        {
            throw new PoolNotFoundException(sprintf('The pool "%s" does not exist.', $id));
        }
        
        if(isset($data->pool_id))
        {
            $entity->pool_id = $data->pool_id;
            $this->em->flush();
        }
        return $entity;
    }
}

