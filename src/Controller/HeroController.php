<?php


namespace App\Controller;


use App\Entity\Hero;
use App\Entity\HeroClass;
use App\Entity\User;
use App\Service\HeroCreation\CreateFormValidator;
use App\Service\HeroCreation\CreateHeroService;
use App\Service\HeroDBReader;
use App\Service\HeroFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

class HeroController extends AbstractController
{
    /**
     *@Route("/create_hero", name="create_hero")
     *@IsGranted("ROLE_USER")
     */
    public function createHero(Request $request, CreateHeroService $createHeroService, CreateFormValidator $createFormValidator):Response
    {
        if ($this->getUser()->getHero() instanceof Hero)
            return $this->redirectToRoute("game");

        if($request->getMethod() ==="POST") {
            $createFormValidator->passRequest($request);
            if($createFormValidator->isValid()){
                $createHeroService->passRequest($request);
                $createHeroService->createHero();
                return $this->redirectToRoute("game");
            }
        }
        $em = $this->getDoctrine()->getManager();
        $classes = $em->getRepository(HeroClass::class)->findAll();
        return $this->render("create_hero.html.twig", ['classes'=>$classes]);
    }

    /**
     * @Route("/stats", name="stats")
     * @IsGranted("ROLE_USER")
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function stats(CacheInterface $cache, HeroDBReader $DBReader, HeroFactory $heroFactory):Response
    {
        /**
         * @var $user User
         */
        $user = $this->getUser();
        $hero = null;
        if($user->getHero()) {
            $heroStoredData = $DBReader->readAndReturn();
            $heroFactory->setHeroInitials($heroStoredData);
            $hero = $heroFactory->createHero();
            dump($hero);
//            $hero = $cache->get($user->getUsername(),function () use ($heroFactory) {
//                return $heroFactory->createHero();
//            });
            $hero = $heroFactory->createHero();
            return $this->render("hero_info.html.twig",["hero"=>$hero]);
        }
        return $this->redirectToRoute('create_hero');
    }

    /**
     *@Route("/add_stat/{stat}", name="addStat")
     *@IsGranted("ROLE_USER")
     */
    public function addStat(string $stat, CacheInterface $cache):Response
    {
        /**
         * @var $hero Hero
         */
        $hero = $this->getUser()->getHero();
        $availableStats = $hero->getAvailableStatsPoints();
        if($availableStats > 0 && method_exists($hero,'get'.$stat)){
                $statBefore = $hero->{'get'.$stat}();
                $hero->{'set'.$stat}($statBefore + 1);
                $hero->setAvailableStatsPoints($availableStats - 1);
                $cache->delete($this->getUser()->getUsername());
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute("stats");
            }
        return new Response("nonono");
    }
}