<?php declare(strict_types=1);

namespace App\Exam\Service\Exam;

use App\Exam\Entity\CorrectAnswer;
use App\Exam\Entity\Exam;
use App\Exam\Repository\AnswerRepository;
use UnexpectedValueException;

class ScoreCalculator
{
    private AnswerRepository $answerRepository;

    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    public function calculateScore(Exam $exam, array $answerIdList): int
    {
        $maxCorrectAnswerAmount = $this->calculateMaxCorrectAnswerAmount($exam);
        if (0 === $maxCorrectAnswerAmount) {
            throw new UnexpectedValueException('This exam does not have any correct answer');
        }

        $correctAnswerAmount = $this->calculateCorrectAnswerAmount($exam, $answerIdList);

        $score = (int) (($correctAnswerAmount / $maxCorrectAnswerAmount) * 100);
        if ($score > 100) {
            throw new UnexpectedValueException('Score may not be higher than 100');
        }
        return $score;
    }

    private function calculateMaxCorrectAnswerAmount(Exam $exam): int
    {
        $maxCorrectAnswerCount = 0;
        foreach ($exam->getQuestions() as $question) {
            foreach ($question->getAnswers() as $answer) {
                $correctAnswer = $answer->getCorrectAnswer();
                if ($correctAnswer instanceof CorrectAnswer) {
                    $maxCorrectAnswerCount++;
                }
            }
        }
        return $maxCorrectAnswerCount;
    }

    private function calculateCorrectAnswerAmount(Exam $exam, array $answerIdList): int
    {
        $correctAnswerCount = 0;

        $perfectAnswerIdList = $this->buildPerfectAnswerIdList($exam);
        $answerIdList = array_intersect($perfectAnswerIdList, $answerIdList);

        $answers = $this->answerRepository->findByListOfIds($answerIdList);
        foreach ($answers as $answer) {
            $correctAnswer = $answer->getCorrectAnswer();
            if ($correctAnswer instanceof CorrectAnswer) {
                $correctAnswerCount++;
            }
        }
        return $correctAnswerCount;
    }

    /**
     * @return int[]
     */
    private function buildPerfectAnswerIdList(Exam $exam): array
    {
        $perfectAnswerIdList = [];
        foreach ($exam->getQuestions() as $question) {
            foreach ($question->getAnswers() as $answer) {
                $correctAnswer = $answer->getCorrectAnswer();
                if ($correctAnswer instanceof CorrectAnswer) {
                    $perfectAnswerIdList[] = $answer->getId();
                }
            }
        }
        return $perfectAnswerIdList;
    }
}
