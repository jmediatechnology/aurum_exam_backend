<?php declare(strict_types=1);

namespace App\Exam\Factory;

use App\Exam\Entity\Answer;

class AnswerFactory
{
    public function create(): Answer
    {
        return new Answer();
    }
}
