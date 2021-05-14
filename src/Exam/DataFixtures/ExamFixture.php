<?php declare(strict_types=1);

namespace App\Exam\DataFixtures;

use App\Exam\Entity\Question;
use App\Exam\Factory\ExamFactory;
use App\Exam\Repository\QuestionRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use RuntimeException;

class ExamFixture extends Fixture implements DependentFixtureInterface
{
    private QuestionRepository $questionRepository;
    private ExamFactory $examFactory;

    public function __construct(
        QuestionRepository $questionRepository,
        ExamFactory $examFactory
    ) {
        $this->questionRepository = $questionRepository;
        $this->examFactory = $examFactory;
    }

    public function getDependencies(): array
    {
        return [
            QuestionFixture::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $questions = $this->questionRepository->findAll();
        $exam = $this->examFactory->create();
        $exam->setName('Het brandstofsysteem');

        foreach ($questions as $question) {
            if (!$question instanceof Question) {
                throw new RuntimeException('Failed to process Question entity');
            }
            $exam->addQuestion($question);

            $manager->persist($question);
        }

        $manager->flush();
    }
}
