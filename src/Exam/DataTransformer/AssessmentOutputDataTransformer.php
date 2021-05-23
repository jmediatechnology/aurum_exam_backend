<?php declare(strict_types=1);

namespace App\Exam\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Exam\Api\Resource\Assessment;
use App\Exam\DataTransferObject\AssessmentOutput;
use App\Exam\Entity\Exam;
use App\Exam\Service\Exam\ScoreCalculator;
use UnexpectedValueException;

class AssessmentOutputDataTransformer implements DataTransformerInterface
{
    private ScoreCalculator $scoreCalculator;
    private ValidatorInterface $validator;

    public function __construct(
        ScoreCalculator $scoreCalculator,
        ValidatorInterface $validator
    ) {
        $this->scoreCalculator = $scoreCalculator;
        $this->validator = $validator;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if (!$data instanceof Assessment) {
            return false;
        }
        if ($to !== AssessmentOutput::class) {
            return false;
        }
        return true;
    }

    public function transform($object, string $to, array $context = []): object
    {
        if (!$object instanceof Assessment) {
            return $object;
        }

        $assessment = $object;

        $this->validator->validate($assessment);

        $exam = $assessment->getExam();
        if (!$exam instanceof Exam) {
            throw new UnexpectedValueException('No Exam found');
        }

        $answerIdList = $assessment->getAnswerIdList();
        $score = $this->scoreCalculator->calculateScore($exam, $answerIdList);

        return new AssessmentOutput(
            $score
        );
    }
}
