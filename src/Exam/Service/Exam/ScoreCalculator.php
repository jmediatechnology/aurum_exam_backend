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
        if (0 === $maxCorrectAnswerAmount) {
            throw new UnexpectedValueException('This exam does not have any correct answer');
        }

        $correctAnswerAmount = 0;
        $answers = $this->answerRepository->findByListOfIds($answerIdList);
        foreach ($answers as $answer) {
            $correctAnswer = $answer->getCorrectAnswer();
            if ($correctAnswer instanceof CorrectAnswer) {
                $correctAnswerAmount++;
            }
        }

        $score = (float)($correctAnswerAmount / $maxCorrectAnswerAmount) * 100;
        $score = (int)$score;
        if ($score > 100) {
            throw new UnexpectedValueException('Score may not be higher than 100');
        }

        return $score;
    }
}
