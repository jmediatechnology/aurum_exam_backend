<?php declare(strict_types=1);

namespace App\Exam\DataTransferObject;

use Symfony\Component\Serializer\Annotation\Groups;

class AssessmentOutput
{
    /**
     * @Groups({
     *     "assessment:post",
     * })
     */
    private int $score;

    public function __construct(int $score)
    {
        $this->score = $score;
    }

    public function getScore(): int
    {
        return $this->score;
    }
}
