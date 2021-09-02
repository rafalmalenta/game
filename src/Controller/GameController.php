<?php


namespace App\Controller;

use App\Entity\EnemyModifier;
use App\Entity\EnemyPrototype;
use App\Entity\Hero;
use App\Entity\User;
use App\Service\Battle\BattleHandler;
use App\Service\Battle\EnemyArrayExtractor;
use App\Service\Battle\EnemyChecker;
use App\Service\HeroCreation\CreateHeroService;
use App\Service\HeroCreation\CreateFormValidator;
use App\Service\HeroDBReader;
use App\Service\HeroFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class GameController extends AbstractController
{
    /**
     *@Route("/game", name="game")
     *@IsGranted("ROLE_USER")
     */
    public function start(Request $request, CreateHeroService $createHeroService,CreateFormValidator $createFormValidator, HeroFactory $heroFactory):Response
    {
        /**
         * @var $user User
         */
        $user = $this->getUser();
        $hero = null;
        if($user->getHero()) {
//            $hero = $heroFactory->createHero();
            return $this->render("game.html.twig");
        }
        return $this->redirectToRoute("create_hero");
    }
    /**
     *@Route("/arena", name="arena",methods={"GET","POST"})
     *@IsGranted("ROLE_USER")
     */
    public function arena(Request $request,HeroDBReader $DBReader, EntityManagerInterface $manager, HeroFactory $heroFactory):Response
    {
        if ($request->getMethod()==="POST") {
            $postBody = json_decode($request->getContent());
            $checker = new EnemyChecker($manager);
            if($checker->checkAll([1,25], $postBody)){
                $heroStoredData = $DBReader->readAndReturn();
                $heroFactory->setHeroInitials($heroStoredData);
                $hero = $heroFactory->createHero();
                $extractor = new EnemyArrayExtractor($checker->returnEntities());
                $defenders = $extractor->extract();
                $ba = new BattleHandler([$hero],$defenders,$manager);
                $report = $ba->startBattle();

                return $this->json(['report'=>$report]);
            }

            return $this->json("some error happened")->setStatusCode(500);
        }
        $enemiesPrototype = $this->getDoctrine()->getManager()->getRepository(EnemyPrototype::class)->findAll();
        $modifiers = $this->getDoctrine()->getManager()->getRepository(EnemyModifier::class)->findAll();
        foreach ($enemiesPrototype as $enemy){
            $enemies[] = ['lvl'=>$enemy->getLevel(),'name'=>$enemy->getName()];
        }
        foreach ($modifiers as $modifier){
            $availableModifiers[] = ['name'=>$modifier->getName(),'boosts'=>$modifier->getBoostTo()];
        }
        return $this->render('arena.html.twig',['availableEnemies'=>$enemies, 'availableModifiers'=>$availableModifiers]);
    }

}