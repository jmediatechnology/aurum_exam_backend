<?php declare(strict_types=1);

namespace App\Exam\Factory;

use App\Exam\Entity\Exam;

class ExamFactory
{
    public function create(): Exam
    {
        return new Exam();
    }
}
