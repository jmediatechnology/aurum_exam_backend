<?php declare(strict_types=1);

namespace App\Exam\Validator;

use InvalidArgumentException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class AnswerIdListConstraintValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof AnswerIdListConstraint) {
            throw new InvalidArgumentException($value, AnswerIdListConstraint::class);
        }

        if (!is_array($value)) {
            $type = gettype($value);
            $extra = sprintf('The type of AnswerIdList is %s.', $type);
            $this->context
                ->buildViolation($constraint->message)
                ->setParameter('{{extra}}', $extra)
                ->addViolation();
            return;
        }

        foreach ($value as $item) {
            if (!is_numeric($item)) {
                $extra = sprintf('The item "%s" is not a number, this does not adhere to us.', $item);
                $this->context
                    ->buildViolation($constraint->message)
                    ->setParameter('{{extra}}', $extra)
                    ->addViolation();
            }
        }
    }
}
