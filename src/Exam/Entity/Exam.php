<?php declare(strict_types=1);

namespace App\Exam\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Exam\Repository\ExamRepository;

/**
 * @ApiResource(
 *      collectionOperations={
 *          "get"={},
 *      },
 *      itemOperations={
 *          "get"={
 *              "normalization_context"={
 *                  "groups"={
 *                      "exam:read",
 *                  }
 *              },
 *          }
 *      }
 * )
 * @ORM\Entity(
 *      repositoryClass=ExamRepository::class
 * )
 */
class Exam
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(
     *      type="integer"
     * )
     * @Groups({
     *      "exam:read",
     * })
     */
    private ?int $id = null;

    /**
     * @ORM\Column(
     *      type="string",
     *      length=256,
     *      nullable=false,
     * )
     * @Groups({
     *      "exam:read",
     * })
     */
    private string $name = '';

    /**
     * An Exam has many Questions ...
     * ... A Question may belong to many Exams.
     *
     * @ORM\ManyToMany(targetEntity="Question", mappedBy="exams", cascade={"persist", "remove"})
     * @Groups({
     *      "exam:read",
     * })
     */
    private Collection $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Question[]|Collection
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    /**
     * @param Answer[] $answers
     */
    public function setQuestions(array $questions): void
    {
        $this->questions->clear();
        foreach ($questions as $question) {
            if ($question instanceof Question) {
                $this->addQuestion($question);
            }
        }
    }

    public function addQuestion(Question $question): void
    {
        if (false === $this->questions->contains($question)) {
            $this->questions->add($question);
            $question->addExam($this);
        }
    }

    public function removeAnswer(Question $question): void
    {
        if (true === $this->questions->contains($question)) {
            $this->questions->removeElement($question);
        }
    }
}
