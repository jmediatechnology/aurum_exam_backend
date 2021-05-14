<?php declare(strict_types=1);

namespace App\Exam\Repository;

use App\Exam\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use RuntimeException;
use Throwable;

class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function persist(Question $entity): void
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
