<?php declare(strict_types=1);

namespace App\Exam\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AnswerIdListConstraint extends Constraint
{
    public $message = 'The property "answerIdList" must be an array of numbers. {{extra}}';
}
