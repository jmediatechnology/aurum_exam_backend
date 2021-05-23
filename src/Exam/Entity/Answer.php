<?php declare(strict_types=1);

namespace App\Exam\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Exam\Repository\AnswerRepository;
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
 *      repositoryClass=AnswerRepository::class
 * )
 */
class Answer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(
     *      type="integer"
     * )
     * @Groups({
     *      "question:read",
     *      "exam:read",
     * })
     */
    private ?int $id = null;

    /**
     * @ORM\Column(
     *      type="text",
     *      nullable=false,
     * )
     * @Groups({
     *      "question:read",
     *      "exam:read",
     * })
     */
    private string $answer = '';

    /**
     * An Answer may belong to one Question ...
     * ... A Question has many Answers.
     *
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="answers", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", nullable=false)
     */
    private Question $question;

    /**
     * An Answer belongs to one CorrectAnswer ...
     * ... A CorrectAnswer may belong many Answers.
     *
     * @ORM\ManyToOne(targetEntity="CorrectAnswer", inversedBy="answer", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="correct_answer_id", referencedColumnName="id")
     * @Groups({
     *      "question:read",
     * })
     */
    private ?CorrectAnswer $correctAnswer = null;

    public function __construct(Question $question)
    {
        $question->addAnswer($this);
        $this->question = $question;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): void
    {
        $this->answer = $answer;
    }

    public function getQuestion(): Question
    {
        return $this->question;
    }

    public function setQuestion(Question $question): void
    {
        $this->question = $question;
    }

    public function getCorrectAnswer(): ?CorrectAnswer
    {
        return $this->correctAnswer;
    }

    public function setCorrectAnswer(CorrectAnswer $correctAnswer): void
    {
        $this->correctAnswer = $correctAnswer;
    }
}
