<?php declare(strict_types=1);

namespace App\Exam\Repository;

use App\Exam\Entity\Exam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use RuntimeException;
use Throwable;

class ExamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exam::class);
    }

    public function persist(Exam $entity): void
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
