<?php declare(strict_types=1);

namespace App\Exam\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Exam\Api\Resource\Assessment;

class AssessmentDataPersister implements ContextAwareDataPersisterInterface
{
    private ContextAwareDataPersisterInterface $dataPersister;

    public function __construct(ContextAwareDataPersisterInterface $dataPersister)
    {
        $this->dataPersister = $dataPersister;
    }

    public function supports($data, array $context = []): bool
    {
        if ($data instanceof Assessment) {
            return true;
        }
        return $this->dataPersister->supports($data, $context);
    }

    public function persist($data, array $context = []): object
    {
        if (!$data instanceof Assessment) {
            return $this->dataPersister->persist($data, $context);
        }
        //@TODO Execute some Assessment persistence logic here
        return $this->dataPersister->persist($data, $context);
    }

    public function remove($data, array $context = []): void
    {
        $this->dataPersister->remove($data, $context);
    }
}
