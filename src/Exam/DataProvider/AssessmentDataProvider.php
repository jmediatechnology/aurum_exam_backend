<?php declare(strict_types=1);

namespace App\Exam\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Exam\Api\Resource\Assessment;

class AssessmentDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function getCollection(string $resourceClass, string $operationName = null): Assessment
    {
        return new Assessment();
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return false;
//        return Assessment::class === $resourceClass;
    }
}
