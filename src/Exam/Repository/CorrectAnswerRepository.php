<?php declare(strict_types=1);

namespace App\Exam\Repository;

use App\Exam\Entity\CorrectAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use RuntimeException;
use Throwable;

class CorrectAnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CorrectAnswer::class);
    }

    public function persist(CorrectAnswer $entity): void
    {
        try {
            $manager = $this->getEntityManager();
            $manager->persist($entity);
            $manager->flush();
        } catch (Throwable $exception) {
            $message = 'Error trying to persist';
            $code = $exception->getCode();
            throw new RuntimeException($message, $code, $exception);
        }
    }
}
