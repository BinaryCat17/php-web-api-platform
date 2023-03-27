<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use App\Controller\GetPoolController;
use App\Controller\GetCollectionPoolController;
use App\Controller\PostPoolController;
use App\Controller\PutPoolController;
use App\Controller\PatchPoolController;
use App\Controller\DeletePoolController;


#[ApiResource(
    mercure: true,
    operations: [
        new Get(
            controller: GetPoolController::class,
            write: false,
            read: false
        ),
        new GetCollection(
            controller: GetCollectionPoolController::class,
            write: false,
            read: false
        ),
        new Post (
            controller: PostPoolController::class,
            write: false,
            read: false
        ),
        new Put(
            controller: PutPoolController::class,
            write: false,
            read: false
        ),
        new Patch(
            controller: PatchPoolController::class,
            write: false,
            read: false
        ),
        new Delete(
            controller: DeletePoolController::class,
            write: false,
            read: false
        )
    ]
)]
#[ORM\Entity]
class Pool
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = 0;

    #[ORM\Column(unique: true)]
    #[Assert\NotNull]
    public ?int $pool_id = null;

    #[ORM\Column(type: 'text', unique: true)]
    #[Assert\NotBlank]
    public string $pool_name = '';

    public function getId(): ?int
    {
        return $this->id;
    }
}
