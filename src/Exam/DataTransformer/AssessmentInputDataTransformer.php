<?php declare(strict_types=1);

namespace App\Exam\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Exam\Api\Resource\Assessment;
use App\Exam\DataTransferObject\AssessmentInput;
use App\Exam\Entity\Exam;
use App\Exam\Service\Exam\ScoreCalculator;
use UnexpectedValueException;

class AssessmentInputDataTransformer implements DataTransformerInterface
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
        if ($data instanceof Assessment) {
            return false;
        }
        $input = $context['input'] ?? [];
        $class = $input['class'] ?? '';
        return $class === AssessmentInput::class && $to === Assessment::class;
    }

    public function transform($object, string $to, array $context = []): object
    {
        if (!$object instanceof AssessmentInput) {
            return $object;
        }
        $assessment = $object;

        $this->validator->validate($assessment);

        $exam = $assessment->getExam();
        if (!$exam instanceof Exam) {
            throw new UnexpectedValueException('No Exam found');
        }

        $answers = $assessment->getAnswerIdList();

        //@TODO Pass this score to the Assessment resource?
        $score = $this->scoreCalculator->calculateScore($exam, $answers);

        return new Assessment(
            $exam,
            $answers,
        );
    }
}
