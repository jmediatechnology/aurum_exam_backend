<?php declare(strict_types=1);

namespace App\Exam\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Exam\Repository\QuestionRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      collectionOperations={
 *          "get"={
 *              "normalization_context"={
 *                  "groups"={
 *                      "question:read",
 *                  }
 *              },
 *          }
 *      },
 *      itemOperations={
 *          "get"={},
 *      }
 * )
 * @ORM\Entity(
 *      repositoryClass=QuestionRepository::class
 * )
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(
     *      type="integer"
     * )
     * @Groups({
     *      "question:read",
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
     *      "question:read",
     * })
     */
    private string $question = '';

    /**
     * A Question may belong to many Exams ...
     * ... An Exam has many Questions.
     *
     * @ORM\ManyToMany(targetEntity="Exam", inversedBy="questions", cascade={"persist", "remove"})
     */
    private Collection $exams;

    /**
     * A Question has many Answers ...
     * ... An Answer may belong to one Question.
     *
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question", cascade={"persist", "remove"})
     * @Groups({
     *      "question:read",
     * })
     */
    private Collection $answers;

    public function __construct()
    {
        $this->exams = new ArrayCollection();
        $this->answers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }

    /**
     * @return Exam[]|Collection
     */
    public function getExams(): Collection
    {
        return $this->exams;
    }

    /**
     * @param Exam[] $exams
     */
    public function setExams(array $exams): void
    {
        $this->exams->clear();
        foreach ($exams as $exam) {
            if ($exam instanceof Exam) {
                $this->addExam($exam);
            }
        }
    }

    public function addExam(Exam $exam): void
    {
        if (false === $this->exams->contains($exam)) {
            $this->exams->add($exam);
            $exam->addQuestion($this);
        }
    }

    public function removeExam(Exam $exam): void
    {
        if (false === $this->exams->contains($exam)) {
            $this->exams->removeElement($exam);
        }
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
            $answer->setQuestion($this);
        }
    }

    public function removeAnswer(Answer $answer): void
    {
        if (true === $this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
        }
    }
}
