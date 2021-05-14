<?php declare(strict_types=1);

namespace App\Exam\Api\Resource;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Action\NotFoundAction;
use App\Exam\Entity\Exam;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Exam\DataTransferObject\AssessmentOutput;

/**
 * @ApiResource(
 *      itemOperations={
 *          "get"={
 *              "controller"=NotFoundAction::class,
 *              "read"=false,
 *              "output"=false,
 *          },
 *      },
 *      collectionOperations={
 *           "post"={
 *              "input"=Assessment::class,
 *              "output"=AssessmentOutput::class,
 *              "normalization_context"={
 *                  "groups"={
 *                      "assessment:post",
 *                  }
 *              },
 *              "denormalization_context"={
 *                  "groups"={
 *                      "assessment:post",
 *                  }
 *              },
 *          },
 *      },
 * )
 */
class Assessment
{
    /**
     * @ApiProperty(identifier=true)
     * @Groups ({
     *     "assessment:post",
     * })
     */
    private int $id = 0;

    /**
     * @Groups ({
     *     "assessment:post",
     * })
     */
    private Exam $exam;

    /**
     * @Groups ({
     *     "assessment:post",
     * })
     */
    private array $answerIdList;

    public function __construct(Exam $exam, array $answerIdList)
    {
        $this->exam = $exam;
        $this->answerIdList = $answerIdList;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExam(): Exam
    {
        return $this->exam;
    }

    public function getAnswerIdList(): array
    {
        return $this->answerIdList;
    }
}
