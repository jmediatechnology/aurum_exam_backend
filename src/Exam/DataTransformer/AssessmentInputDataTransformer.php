<?php declare(strict_types=1);

namespace App\Exam\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Exam\Api\Resource\Assessment;
use App\Exam\DataTransferObject\AssessmentInput;
use App\Exam\DataTransferObject\AssessmentOutput;
use App\Exam\Entity\CorrectAnswer;
use App\Exam\Entity\Exam;
use App\Exam\Repository\AnswerRepository;
use UnexpectedValueException;

class AssessmentInputDataTransformer implements DataTransformerInterface
{
    private AnswerRepository $answerRepository;

    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    public function transform($object, string $to, array $context = []): object
    {
        if (!$object instanceof AssessmentInput) {
            return $object;
        }
        $assessment = $object;
        $exam = $assessment->getExam();
        if (!$exam instanceof Exam) {
            throw new UnexpectedValueException('No Exam found');
        }

        $answers = $assessment->getAnswerIdList();
        $score = $this->calculateScore($exam, $answers);

        return new Assessment(
            $exam,
            $answers,
            $score
        );
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

    private function calculateScore(Exam $exam, array $intputAnswerList): int
    {
        $maxCorrectAnswerAmount = 0;
        $questions = $exam->getQuestions();
        foreach ($questions as $question) {
            $answers = $question->getAnswers();
            foreach ($answers as $answer) {
                $correctAnswer = $answer->getCorrectAnswer();
                if ($correctAnswer instanceof CorrectAnswer) {
                    $maxCorrectAnswerAmount++;
                }
            }
        }

        $correctAnswerAmount = 0;
        $answers = $this->answerRepository->findByListOfIds($intputAnswerList);
        foreach ($answers as $answer) {
            $correctAnswer = $answer->getCorrectAnswer();
            if ($correctAnswer instanceof CorrectAnswer) {
                $correctAnswerAmount++;
            }
        }

        $score = (float)($correctAnswerAmount / $maxCorrectAnswerAmount) * 100;
        return (int)$score;
    }
}
