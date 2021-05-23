<?php declare(strict_types=1);

namespace App\Exam\Factory;

use App\Exam\Entity\Answer;
use App\Exam\Entity\Question;

class AnswerFactory
{
    public function create(Question $question): Answer
    {
        return new Answer($question);
    }
}
