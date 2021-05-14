<?php declare(strict_types=1);

namespace App\Exam\DataTransferObject;

use App\Exam\Entity\Exam;
use Symfony\Component\Serializer\Annotation\Groups;

class AssessmentInput
{
    /**
     * @Groups ({
     *     "assessment:read",
     *     "assessment:post",
     *     "assessment:post:input",
     * })
     */
    private ?Exam $exam = null;

    /**
     * @Groups ({
     *     "assessment:read",
     *     "assessment:post",
     *     "assessment:post:input",
     * })
     */
    private array $answerIdList = [];

    public function getExam(): ?Exam
    {
        return $this->exam;
    }

    public function setExam(Exam $exam): void
    {
        $this->exam = $exam;
    }

    public function getAnswerIdList(): array
    {
        return $this->answerIdList;
    }

    public function setAnswerIdList(array $answerIdList): void
    {
        $this->answerIdList = $answerIdList;
    }
}
