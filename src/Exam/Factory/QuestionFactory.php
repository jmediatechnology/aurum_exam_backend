<?php declare(strict_types=1);

namespace App\Exam\Factory;

use App\Exam\Entity\Question;

class QuestionFactory
{
    public function create(): Question
    {
        return new Question();
    }
}
