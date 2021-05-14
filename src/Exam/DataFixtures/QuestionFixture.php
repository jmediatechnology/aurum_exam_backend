<?php declare(strict_types=1);

namespace App\Exam\DataFixtures;

use App\Exam\Factory\AnswerFactory;
use App\Exam\Factory\CorrectAnswerFactory;
use App\Exam\Factory\QuestionFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuestionFixture extends Fixture
{
    private QuestionFactory $questionFactory;
    private AnswerFactory $answerFactory;
    private CorrectAnswerFactory $correctAnswerFactory;

    public function __construct(
        QuestionFactory $questionFactory,
        AnswerFactory $answerFactory,
        CorrectAnswerFactory $correctAnswerFactory
    ) {
        $this->questionFactory = $questionFactory;
        $this->answerFactory = $answerFactory;
        $this->correctAnswerFactory = $correctAnswerFactory;
    }

    public function load(ObjectManager $manager)
    {
        // ------------------------------------------------------ 1 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Welke manieren zijn er om de juiste brandstof-luchtmengsel te krijgen?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        Om brandstof te verbranden is er lucht nodig. 
        De brandstof kan op twee manieren met lucht vermengd worden om de juiste brandstof-luchtmengsel te krijgen.  
        Een carburatie systeem en een brandstof-injectie systeem.'));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('Een carburatie systeem, en een brandstof-injectie systeem (brandstofinspuiting)');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('Een pitot-statisch systeem, en een gyroscopisch systeem');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('Met een elektronische motormanagement systeem (FADEC)');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('Geen, brandstof hoeft niet met lucht vermengd te worden');

        $answerA->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 2 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Wat is de functie van een carburateur?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        De carburateur mengt brandstof en lucht in een bepaalde verhouding, en levert dit aan de motor. '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('De carburateur mengt brandstof en lucht, en levert dit aan het beluchtingsysteem');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('De carburateur mengt brandstof en lucht, en levert dit aan de motor');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('De carburateur mengt brandstof en lucht, en levert dit aan de brandstofpomp');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('De carburateur mengt brandstof en lucht, en levert dit aan de tankschakelaar');

        $answerB->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 3 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Op welke plek in het vliegtuig zijn de brandstoftanks meestal geïntergreerd?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        De brandstoftanks bevinden zich meestal in de vleugel/vleugelconstructie. '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('De gehsele lengte van het vliegtuig');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('De achterkant van het vliegtuig');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('De romp van het vliegtuig');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('Vleugel / vleugelconstructie');

        $answerD->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 4 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion(preg_replace('/\s+/', ' ', 'Hoe wordt de brandstoftoevoer 
        naar de carburateur op peil gehouden in een laagdekker?'));

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        Bij een laagdekker is de brandstoftank onder de carburateur geïntegreerd. 
        Om de carburateur te voorzien van brandstof wordt er een brandstofpomp gebruikt.
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('D.m.v. een tankschakelaar');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('D.m.v. een carburateur');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('D.m.v. een brandstofpomp');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('D.m.v. zwaartekracht (gravity feed)');

        $answerC->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 5 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Welke manieren zijn er om de brandstofpomp aan te drijven?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        Mechanisch (engine driven fuel pump) en als back-up elektrisch (electrical fuel pump). 
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('Mechanisch en elektrisch');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('Elektrisch');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('Mechanisch');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('Aerodynamisch');

        $answerA->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 6 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Wat is het gevaar van onderdruk (vacuüm) n de brandstoftank?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        Brandstof moet vervoerd worden naar de carburateur (in een carburatiemotor).
        Als er onderdruk in de brandstoftank ontstaat, dan kan brandstof niet naar de carburateur vervoerd worden. 
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('Een vapour lock');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('De brandstof kan niet vervoerd worden naar de carburateur');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('De brandstof zal kunnen exploderen');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('De brandstoftank zal kunnen lekken');

        $answerB->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);

        $manager->persist($question);

        // ------------------------------------------------------ 7 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Hoe wordt onderdruk in de brandstoftank voorkomen?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        Brandstoftanks hebben speciale tankdoppen met een beluchtingsgat of beluchtingspijpjes.
        Deze instrumenten zorgen ervoor dat er altijd atmosferische druk op de brandstof heerst. 
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('Met een beluchtingsgat');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('Met een luchtfilter');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('Met een carburateur');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('Met toevoerleidingen naar de motor');

        $answerA->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);

        $manager->persist($question);

        // ------------------------------------------------------ 8 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Welke manieren zijn er om het volume van de brandstoftank te meten?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        De eerste manier om de volume van de brandstoftanks kan gemeten worden met een vlottersysteem. 
        Een vlotter is een drijver. De stand van de vlotter is een maat voor het volume aan brandstof in de tank.
        De tweede manier is met een peilstok.
        Een carburateur heeft een vlotterkamer. 
        De vlotterkamer dient als tijdelijk opslag voor brandstof. 
        De vlotterkamer krijgt brandstof d.m.v. zwaartekracht of een brandstofpomp. 
        De vlotterkamer is dus geen maat voor het volume van de brandstoftank. 
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('Met een peilstok');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('Met een vlotter');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('Met een peilstok of vlotter');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('Met een peilstok of vlotter of in de vlotterkamer in de carburateur');

        $answerC->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 9 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Wat is een vapour lock?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        Een vapour lock is een probleem waarbij vloeibaar brandstof over gaat in gas (verdampen).    
        Dampbelvorming in de brandstofleiding verstoort de doorstroming van brandstof.
        De doorstroming van de brandstof naar de motor wordt dan bemoeilijkt of zelfs helemaal geblokkeerd. 
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('Een vapour lock is een instrument om gas op te vangen');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('Een vapour lock is een instrument om brandstof te vernevelen');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('Een vapour lock blokeert de doorstroming van de brandstof in de brandstofleiding');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('Een vapour lock blokeert de beluchtingsgat');

        $answerC->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 10 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Welke factoren kunnen een vapour lock veroorzaken?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        De temperatuur in de motorruimte kan een vapour lock veroorzaken. 
        Hoge temperaturen kunnen de brandstof laten koken. 
        Naast dat neemt de kookpunt af met hoogte. 
          
        Langdurig de motor stationair laten draaien op een zonnige dag verhoogt ook de kans op een vapour lock. 
        Ook bij het gebruik van MOGAS (Euro 95) bestaat een verhoogd kans op een vapour lock. 
          
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('De temperatuur in de motorruimte');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('Verontreinigingen in de brandstof');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('Het gebruik van brandstof met een laag octaan-getal');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('Hoge luchtvochtigheid');

        $answerA->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 11 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Wat zijn de symptomen van een vapour lock?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        De symptomen van een vapour lock zijn een onregelmatig lopende, inhoudende of afslaande motor.
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('Een onregelmatig lopende, inhoudende of afslaande motor');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('Brand in de brandstoftank');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('Een blokkering in de brandstoftank');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('Een lekkende brandstoftank');

        $answerA->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 12 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Wat kan er gedaan worden in het geval van een vapour lock?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        De remedie voor een vapour lock is het aanzetten van de elektrische brandstofpomp (indien aanwezig).
        In theorie kan een vapour lock verholpen worden door de druk in het brandstofsysteem verhoogt wordt, 
        omdat de kookpunt dan zal stijgen, helaas kan dit niet tijdens de vlucht, 
        maar de koeling verbeteren is wel mogelijk tijdens de vlucht.
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('De elektrische brandstofpomp aanzetten');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('De elektrische brandstofpomp aanzetten en verbeteren van de koeling');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('De koeling verbeteren');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('De carburateurvoorverwarmer aanzetten');

        $answerB->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 13 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Wat wordt er bedoeld met het begrip "chemisch juist"?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        Om benzine te verbranden is er zuurstof nodig, en dat wordt uit lucht gehaald. 
        Zowel bij te weinig lucht als bij te weinig benzine kan er geen verbranding plaats vinden. 
        Voor een efficiënten verbranding zoals in een motor mag de mengverhouding 
        slechts binnen een beperkt gebied variëren. 
        
        Om 1 gram benzine te verbranden, is precies 14.7 gram lucht nodig. 
        Een mengsel met een mengverhouding van 1 op 14.7 gram noemt men een chemisch juist of stoichiometrisch mengsel;
        dit mengsel bestaat dus uit lucht met 6.4% benzine.
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('Een mengsel dat bestaat uit 1 gram benzine en 14.7 gram lucht');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('Een mengsel dat bestaat uit 14.7 gram benzine en 1 gram lucht');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('Een mengsel dat bestaat uit 14.7 gram benzine en 14.7 gram lucht');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('Een mengsel dat bestaat uit 1 gram benzine en 1 gram lucht');

        $answerA->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 14 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Bij welke mengverhouding leveren benzinemotoren het meeste vermogen?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        Benzinemotoren leveren het meeste vermogen bij een enigzins rijk mengsel; 
        een lucht-brandstofverhouding met de lambdawaarde 0.85 tot 0.901 levert het meeste vermogen, 
        dat komt overeen met een lucht-brandstofverhouding van 12.5:1 tot 13.3:1.        
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('Bij een arm mengsel');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('Bij een enigzins arm mengsel');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('Bij een rijk mengsel');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('Bij een enigzins rijk mengsel');

        $answerD->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 15 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Welk gunstig effect heeft een rijk mengsel?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        Meer vermogen, en een koelend effect
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('Meer vermogen');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('Een koelend effect');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('Meer vermogen, en een koelend effect');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('Meer vermogen, een koelend effect, en verbeterd de motmorsmering');

        $answerC->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);
        // ------------------------------------------------------ 16 ---------------------------------------------------

        $question = $this->questionFactory->create();
        $question->setQuestion(preg_replace('/\s+/', ' ', '
        Wat moet er gebeuren met de brandstof-luchtverhouding met toenemende hoogte?'));

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        Luchtdichtheid neemt af met toenemende hoogte. 
        Hoe hoger men gaat des te minder lucht er is. 
        Omdat er nagenoeg evenveel brandstof verneveld wordt veranderd de brandstof-luchtverhouding. 
        Dus, mengsel wordt met toenemende hoogte rijker. 
        
        Om dezelfde brandstof-luchtverhouding instelling te behouden dient men de mengsel te verarmen.  
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('De mengsel verarmen');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('De mengsel verrijken');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('De mengsel onveranderd laten');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('De mengsel instelling aan de automatische piloot over laten');

        $answerA->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 17 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Welk brandstof wordt het meest gebruikt voor vliegtuigzuigermotoren?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        AVGAS is momenteel het meest gebruikte brandstof voor vliegtuigen met een zuigermotor.  
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('Euro 95');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('AVGAS');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('JET-A1');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('Diesel');

        $answerB->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 18 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Wat houdt klopvastheid in?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        De klopvastheid duit de kwaliteit van benzine aan. 
        
        Benzine moet op de juiste timing in de motor verbrand worden. 
        Als benzine op het verkeerde verbrand wordt, dan spreekt men van detonatie of "kloppen". 
        Benzine van lage kwaliteit zal eerder uitzichzelf verbranden. 
        Klopvastheid duidt de weerstand tegen detonatie aan, en wordt uitgedrukt in het octaangetal.   
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('De kwaliteit van benzine');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('De bruikbaarheid van benzine bij lage temperaturen');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('De bruikbaarheid van benzine bij hoge temperaturen');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('De temperatuur waarbij benzine stolt');

        $answerA->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 19 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Hoe wordt een hoge klopvastheid bereikt?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        De toevoeging van een loodverbinding: Tetra-Ethyllood (TEL) 
        zorgt ervoor dat een hoge klopvastheid bereikt kan worden.   
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('Door de toevoeging van de loodverbinding Tetra-Ethyllood');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('Door de toevoeging van Tetrahydrocannabinol');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('Door de toevoeging van n-heptaan');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('Door de toevoeging van iso-octaan');

        $answerA->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 20 ----------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Hoe controleert men of een brandstof verontreinigd is?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        Eerst dient brandstof afgetapd worden. Dat kan doordat tanks aftappunten (drains) hebben. 
        Deze aftappunten bevinden zich op de laagste punten van de tank. 
        Via de aftappunten kan een klein hoeveelheid brandstof afgetapd worden, 
        zodat het met fuel testers getest kan worden.
         
        Water is verreweg de meest voorkomende verontreininging in vliegtuigbenzine. 
        Water en brandstof mengen nauwelijk, en omdat water zwaarder is dan benzine, 
        zal het water zich verzamelen op lage punten in het brandstofsysteem. 
        Bij het drainen bevindt het water zich dan onderin. 
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('Met een fuel tester');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('Met motorische instrumenten dat weergegeven wordt in de cockpit');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('Met water');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('Met aftappunten');

        $answerA->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 21 ---------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Wat is de functie van een Carburateurvoorverwarmer (CVV)?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        Ten eerste, een Carburateurvoorverwarmer (CVV) is er om ijsvorming in de carburateur te voorkomen. 
         
        Ten tweede, een Carburateurvoorverwarmer (CVV) functioneert als alternatieve lucht voorziening. 
        De carburateur krijgt lucht via het luchtinlaatsysteem. 
        De luchtinlaat heeft ook een luchtfilter. 
        De luchtfilter kan verstopt raken door: stof, gras, water of ijs. 
        De luchtfilter is daarom onderdeel van de "preflight checks". 
        Mocht de luchtfilter toch verstopt raken, 
        dan lucht toch nog aangezogen worden via een alternatieve luchtinlaat (alternate air system). 
        De alternatieve luchtinlaat heeft geen luchtfilter, en mag alleen gebruikt worden als het noodzakelijk is. 
        Vooral bij gebruik op de grond bestaat de kans op het aanzuigen van verontreinigde lucht.
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('De Carburateurvoorverwarmer (CVV) verwarmt de brandstof');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('De Carburateurvoorverwarmer (CVV) verwarmt de brandstof-luchtmengsel');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('De Carburateurvoorverwarmer (CVV) voorkomt ijs in de carburateur');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer(preg_replace('/\s+/', ' ', '
        De Carburateurvoorverwarmer (CVV) voorkomt ijs in de carburateur 
        en doet dienst als alternatieve lucht voorziening
        '));

        $answerD->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 22 ---------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion(preg_replace('/\s+/', ' ', '
        Wat gebeurd er als er ijs in de carburateur is, en de Carburateurvoorverwarmer (CVV) aangezet wordt?
        '));

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        Carburateurijs veroorzaakt een vermogensafname. 
        Dit is te zien aan een afname van het toerental of afname van de inlaatdruk.
        In een later stadium gaat de motor onregelmatig lopen.
        
        Als de Carburateurvoorverwarmer (CVV) op de WARM stand gezet wordt, 
        dan wordt lucht vanuit het motorcompariment aangezogen. 
        Lucht vanuit het motorcompariment wordt verwarmt door de hete uitlaat. 
        
        Warmere lucht heeft een lagere dichtheid dan koude lucht. 
        Daardoor heeft warme lucht minder zuurstof. 
        Daardoor zal de lucht-brandstofmengsel in de WARM stand verrijkt worden. 
        Daardoor loopt de toerental terug (ongeveer 50 tot 100 rpm).
        
        Als de motor onregelmatig loopt vanwege carburateurijs en de Carburateurvoorverwarmer (CVV) aangezet wordt, 
        dan daalt het vermogen van de motor nog meer. 
        Daardoor gaat de motor nog meer onregelmatig lopen. 
        Het is belangrijk om in dit geval de Carburateurvoorverwarmer (CVV) op WARM te laten staan. 
        Het kan een tijdje duren voordat het ijs in de carburateur gesmolten is.  
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('Het vermogen van de motor stijgt direct');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('Het vermogen van de motor daalt');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('Het vermogen van de motor daalt, maar stijgt daarna weer');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('Het vermogen van de motor sijgt direct, maar daalt daarna weer');

        $answerC->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 23 ---------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion(preg_replace('/\s+/', ' ', 'Onder welke omstandigheden moet 
        men bedacht zijn op de vorming van carburateurijs?'));

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        In een vliegtuig met een carburatiemotor moet men zich voortdurend bewust zijn van mogelijke ijsvorming 
        in de carburateur. Lucht heeft water, en kan dus ook bevriezen. 
        Het ijs zet zich vooral af aan de wand van de venturi en op de gasklep. 
        Het ijs kan zelfs de gasklep vast laten vriezen. 
        
        Let op: de temperatuur in de carburateur is altijd lager, dan de buitentemperatuur. 
        Zelfs bij zomerse temperaturen is ijsvorming in de carburateur mogelijk. 
        Dat heeft twee redenen: verdamping en drukverlaging. 
        Verdamping van brandstof energie kost, deze energie wordt aan de lucht onttrokken, 
        daardoor daalt de temperatuur. 
        Drukverlaging in de venturi gaat gepaard met afkoeling. 
        
        Een temperatuurverlaging van 20°C tot 30°C t.o.v. de buitentemperatuur is mogelijk. 
        
        Men moet bedacht zijn op carburateurijs bij: hoge luchtvochtigheid en een lage toerental. 
        Hoe meer vocht in de lucht, des te meer ijs er kan ontstaan. 
        Bij een laag toerental is de motor relatief koel. 
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer('Hoge luchtvochtigheid');
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer('Hoge luchtvochtigheid en laag toerental');
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('Hoge luchtvochtigheid en op grote hoogtes');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer('Hoge luchtvochtigheid en hoog toerental');

        $answerB->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 24 ---------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Wat zijn de voor en nadelen van een carburateur en brandstofinjectie?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        Alle antwoorden zijn correct. 
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer(preg_replace('/\s+/', ' ', '
        Het grootste  nadeel van een carburateur zijn drukverlaging en verdamping, 
        daardor kan ijs in de carburatuer ontstaan.    
        '));
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer(preg_replace('/\s+/', ' ', '
        Bij een carburateur is de verdeling van het mengsel over de cilinders niet gelijkmatig.
        Bij een brandstofinjectie-systeem krijgt elke cilinder een afgepaste hoeveelheid brandstof van een verstuiver. 
        '));
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('Een brandstofinjectie-systeem is complexer en duurder dan een carburatiemotor');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer(
            'Bij een brandstofinjectie-systeem is de kans op een vapour lock groter dan bij een carburatiemotor.
        ');

        $answerA->setCorrectAnswer($correctAnswer);
        $answerB->setCorrectAnswer($correctAnswer);
        $answerC->setCorrectAnswer($correctAnswer);
        $answerD->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);

        // ------------------------------------------------------ 25 ---------------------------------------------------
        $question = $this->questionFactory->create();
        $question->setQuestion('Wat zijn de verschillen tussen een dieselmotor en een benzinemotor?');

        $correctAnswer = $this->correctAnswerFactory->create();
        $correctAnswer->setExplanation(preg_replace('/\s+/', ' ', '
        Alle antwoorden zijn correct. 
        '));

        $answerA = $this->answerFactory->create();
        $answerA->setAnswer(preg_replace('/\s+/', ' ', '
        Een dieselmotor zuigt geen brandstof-luchtmengsel aan, maar uitsluitend lucht.
        Het elektronische motormanagementsysteem (FADEC) bepaald aan de hand van aangezogen lucht, gasstand, 
        temperatuur, etc. de juiste hoeveelheid brandstof die moet worden ingespoten. 
        '));
        $answerB = $this->answerFactory->create();
        $answerB->setAnswer(
            'Een dieselmotor werkt met een hogere compressieverhouding en cilinderdruk t.o.v. een benzinemotor'
        );
        $answerC = $this->answerFactory->create();
        $answerC->setAnswer('Een dieselmotor werkt met een hogere cilinderdruk t.o.v. een benzinemotor');
        $answerD = $this->answerFactory->create();
        $answerD->setAnswer(
            'Een dieselmotor heeft geen gasklep; de motor zuigt altijd de maximale hoeveelheid lucht aan'
        );

        $answerA->setCorrectAnswer($correctAnswer);
        $answerB->setCorrectAnswer($correctAnswer);
        $answerC->setCorrectAnswer($correctAnswer);
        $answerD->setCorrectAnswer($correctAnswer);
        $question->setAnswers([$answerA, $answerB, $answerC, $answerD]);
        $manager->persist($question);
        // -------------------------------------------------------------------------------------------------------------
        $manager->flush();
    }
}
