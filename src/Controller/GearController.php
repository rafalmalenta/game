<?php


namespace App\Controller;


use App\Service\GearHandle\ArmorHandler;
use App\Service\GearHandle\WeaponHandler;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;


class GearController extends AbstractController
{
    /**
     *@Route("/wear/weapon/{id}", name="wear_weapon")
     *@IsGranted("ROLE_USER")
     */
    public function wearItem(int $id, EntityManagerInterface $manager, CacheInterface $cache):Response
    {
        if ($this->getDoctrine()->getManager()->getRepository(Weapon::class)->findOneBy(['id'=>$id])){
            $weapon = $this->getDoctrine()->getManager()->getRepository(Weapon::class)->findOneBy(['id'=>$id]);
            $gearHandler = new WeaponHandler($weapon,$this->getUser()->getHero(),$manager);
            $gearHandler->wearDecide();
        }
        $cache->delete($this->getUser()->getUsername());
        return $this->redirectToRoute("stats");
    }

    /**
     *@Route("/wear/armor/{id}", name="wear_armor")
     *@IsGranted("ROLE_USER")
     */
    public function wearArmor(int $id, EntityManagerInterface $manager, CacheInterface $cache):Response
    {
        if ($this->getDoctrine()->getManager()->getRepository(Armor::class)->findOneBy(['id'=>$id])){
        $armor = $this->getDoctrine()->getManager()->getRepository(Armor::class)->findOneBy(['id'=>$id]);
            $gearHandler = new ArmorHandler($armor,$this->getUser()->getHero(),$manager);
            $gearHandler->wearDecide();
            return $this->redirectToRoute("stats");
        }
        $cache->delete($this->getUser()->getUsername());

        return new Response("nonono");
    }

}