<?php


namespace App\Service\HeroCreation;



use App\Entity\Hero;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CreateFormValidator
{
    private string $name;
    private string $sex;
    private string $class;
    private EntityManagerInterface $entityManager;
    private FlashBagInterface $flashBag;

    public function __construct(EntityManagerInterface $entityManager, FlashBagInterface $flashBag)
    {
        $this->entityManager = $entityManager;
        $this->flashBag = $flashBag;
    }

    public function passRequest(Request $request)
    {
        $this->name = (string)$request->request->get('name');
        $this->sex = (string)$request->request->get('sex');
        $this->class = (string)$request->request->get('class');
    }
    public function checkNameAvailable():bool
    {
        $otherHeroWithThatName = $this->entityManager->getRepository(Hero::class)->findOneBy(["name"=>$this->name]);
        if($otherHeroWithThatName)
            return false;
        if(mb_strlen($this->name)<5)
            return false;
        return true;

    }
    public function checkSexSelected():bool
    {
        if(in_array($this->sex,array("Male","Female")))
            return true;
        return false;
    }
    public function checkClassExist():bool
    {
        $class = $this->entityManager->getRepository(Hero::class)->findOneBy(["name"=>$this->class]);
        if ($class){
            return true;
        }
        $this->flashBag->add("warning","please pick class");
        return false;
    }
    public function isValid():bool
    {
        if(!$this->checkSexSelected())
        {
            $this->flashBag->add("warning","please pick sex");
            return false;
        }
        if(!$this->checkNameAvailable())
        {
            $this->flashBag->add("warning","name taken or too short");
            return false;
        }
    return true;
    }
}