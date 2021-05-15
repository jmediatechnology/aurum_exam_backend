<?php

namespace App\Tests\Exam\Service\Exam;

use App\Exam\Entity\Answer;
use App\Exam\Entity\CorrectAnswer;
use App\Exam\Entity\Exam;
use App\Exam\Entity\Question;
use App\Exam\Repository\AnswerRepository;
use App\Exam\Service\Exam\ScoreCalculator;
use PHPUnit\Framework\TestCase;
use UnexpectedValueException;

class ScoreCalculatorTest extends TestCase
{
    private array $answers;
    private Exam $exam;

    protected function setUp(): void
    {
        parent::setUp();

        $question1 = new Question();
        $question1->setQuestion('Wat is de uitkomst van de operatie 1 + 1');
        $answer1 = new Answer();
        $answer1->setAnswer('2');
        $correctAnswer1 = new CorrectAnswer();
        $correctAnswer1->addAnswer($answer1);
        $question1->addAnswer($answer1);

        $question2 = new Question();
        $question2->setQuestion('Wat is de uitkomst van de operatie 2 + 2');
        $answer2 = new Answer();
        $answer2->setAnswer('4');
        $correctAnswer2 = new CorrectAnswer();
        $correctAnswer2->addAnswer($answer2);
        $question2->addAnswer($answer2);

        $question3 = new Question();
        $question3->setQuestion('Wat is de uitkomst van de operatie 3 + 3');
        $answer3 = new Answer();
        $answer3->setAnswer('6');
        $correctAnswer3 = new CorrectAnswer();
        $correctAnswer3->addAnswer($answer3);
        $question3->addAnswer($answer3);

        $question4 = new Question();
        $question4->setQuestion('Wat is de uitkomst van de operatie 4 + 4');
        $answer4 = new Answer();
        $answer4->setAnswer('8');
        $correctAnswer4 = new CorrectAnswer();
        $correctAnswer4->addAnswer($answer4);
        $question4->addAnswer($answer4);

        $question5 = new Question();
        $question5->setQuestion('Wat is de uitkomst van de operatie 5 + 5');
        $answer5 = new Answer();
        $answer5->setAnswer('10');
        $correctAnswer5 = new CorrectAnswer();
        $correctAnswer5->addAnswer($answer5);
        $question5->addAnswer($answer5);

        $question6 = new Question();
        $question6->setQuestion('Wat is de uitkomst van de operatie 6 + 6');
        $answer6 = new Answer();
        $answer6->setAnswer('12');
        $correctAnswer6 = new CorrectAnswer();
        $correctAnswer6->addAnswer($answer6);
        $question6->addAnswer($answer6);

        $question7 = new Question();
        $question7->setQuestion('Wat is de uitkomst van de operatie 7 + 7');
        $answer7 = new Answer();
        $answer7->setAnswer('14');
        $correctAnswer7 = new CorrectAnswer();
        $correctAnswer7->addAnswer($answer7);
        $question7->addAnswer($answer7);

        $question8 = new Question();
        $question8->setQuestion('Wat is de uitkomst van de operatie 8 + 8');
        $answer8 = new Answer();
        $answer8->setAnswer('16');
        $correctAnswer8 = new CorrectAnswer();
        $correctAnswer8->addAnswer($answer8);
        $question8->addAnswer($answer8);

        $question9 = new Question();
        $question9->setQuestion('Wat is de uitkomst van de operatie 9 + 9');
        $answer9 = new Answer();
        $answer9->setAnswer('18');
        $correctAnswer9 = new CorrectAnswer();
        $correctAnswer9->addAnswer($answer9);
        $question9->addAnswer($answer9);

        $question10 = new Question();
        $question10->setQuestion('Wat is de uitkomst van de operatie 10 + 10');
        $answer10 = new Answer();
        $answer10->setAnswer('20');
        $correctAnswer10 = new CorrectAnswer();
        $correctAnswer10->addAnswer($answer10);
        $question10->addAnswer($answer10);

        $questions = [
            $question1,
            $question2,
            $question3,
            $question4,
            $question5,
            $question6,
            $question7,
            $question8,
            $question9,
            $question10,
        ];

        $exam = new Exam();
        $exam->setQuestions($questions);

        $this->exam = $exam;
        $this->answers = [
            $answer1,
            $answer2,
            $answer3,
            $answer4,
            $answer5,
            $answer6,
            $answer7,
            $answer8,
            $answer9,
            $answer10,
        ];
    }

    public function testThatScoreIs100(): void
    {
        $answersGivenByStudent = [
            $this->answers[0],
            $this->answers[1],
            $this->answers[2],
            $this->answers[3],
            $this->answers[4],
            $this->answers[5],
            $this->answers[6],
            $this->answers[7],
            $this->answers[8],
            $this->answers[9],
        ];

        $answerRepository = $this->createMock(AnswerRepository::class);
        $answerRepository->method('findByListOfIds')->willReturn($answersGivenByStudent);

        $scoreCalculator = new ScoreCalculator($answerRepository);
        $actual = $scoreCalculator->calculateScore($this->exam, []);
        $this->assertEquals(100, $actual);
    }

    public function testThatScoreIs90(): void
    {
        $answersGivenByStudent = [
            $this->answers[0],
            $this->answers[1],
            $this->answers[2],
            $this->answers[3],
            $this->answers[4],
            $this->answers[5],
            $this->answers[6],
            $this->answers[7],
            $this->answers[8],
        ];

        $answerRepository = $this->createMock(AnswerRepository::class);
        $answerRepository->method('findByListOfIds')->willReturn($answersGivenByStudent);

        $scoreCalculator = new ScoreCalculator($answerRepository);
        $actual = $scoreCalculator->calculateScore($this->exam, []);
        $this->assertEquals(90, $actual);
    }

    public function testThatExceptionIsThrown(): void
    {
        $this->expectException(UnexpectedValueException::class);

        $answersGivenByStudent = [
            $this->answers[0],
            $this->answers[1],
            $this->answers[2],
            $this->answers[3],
            $this->answers[4],
            $this->answers[5],
            $this->answers[6],
            $this->answers[7],
            $this->answers[8],
            $this->answers[9],
            $this->answers[9],
        ];

        $answerRepository = $this->createMock(AnswerRepository::class);
        $answerRepository->method('findByListOfIds')->willReturn($answersGivenByStudent);

        $scoreCalculator = new ScoreCalculator($answerRepository);
        $scoreCalculator->calculateScore($this->exam, []);
    }
}
