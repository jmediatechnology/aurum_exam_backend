<?php declare(strict_types=1);

namespace App\Exam\Factory;

use App\Exam\Entity\CorrectAnswer;

class CorrectAnswerFactory
{
    public function create(): CorrectAnswer
    {
        return new CorrectAnswer();
    }
}
