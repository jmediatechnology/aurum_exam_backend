<?php declare(strict_types=1);

namespace App\Exam\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Exam\Repository\CorrectAnswerRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      collectionOperations={
 *          "get"={}
 *      },
 *      itemOperations={
 *          "get"={},
 *      }
 * )
 * @ORM\Entity(
 *      repositoryClass=CorrectAnswerRepository::class
 * )
 */
class CorrectAnswer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(
     *      type="integer"
     * )
     */
    private ?int $id = null;

    /**
     * A CorrectAnswer may belong to many Answers ...
     * ... An Answer belongs to one CorrectAnswer.
     *
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="correctAnswer")
     */
    private Collection $answers;

    /**
     * @ORM\Column(
     *      type="text",
     *      nullable=false,
     * )
     * @Groups({
     *      "question:read",
     * })
     */
    private string $explanation = '';

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Answer[]|Collection
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    /**
     * @param Answer[] $answers
     */
    public function setAnswers(array $answers): void
    {
        $this->answers->clear();
        foreach ($answers as $answer) {
            if ($answer instanceof Answer) {
                $this->addAnswer($answer);
            }
        }
    }

    public function addAnswer(Answer $answer): void
    {
        if (false === $this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setCorrectAnswer($this);
        }
    }

    public function removeAnswer(Answer $answer): void
    {
        if (true === $this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
        }
    }

    public function getExplanation(): string
    {
        return $this->explanation;
    }

    public function setExplanation(string $explanation): void
    {
        $this->explanation = $explanation;
    }
}
