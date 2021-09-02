<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterUserService
{
    private String $password1;
    private string $password2;
    private string $email;
    private string $username;
    private array $warningsArray;
    private EntityManagerInterface $em;
    private FlashBagInterface $flashBag;
    private UserPasswordHasherInterface $passwordEncoder;

    public function __construct(EntityManagerInterface $em,FlashBagInterface $flashBag,UserPasswordHasherInterface $passwordEncoder)
    {
        $this->em = $em;
        $this->flashBag = $flashBag;
        $this->passwordEncoder = $passwordEncoder;
    }
    public function passRequest($request)
    {
        $this->password1 = $request->request->get('password1');
        $this->password2 = $request->request->get('password2');
        $this->email = $request->request->get('email');
        $this->username = $request->request->get('username');
    }
    public function checkRegistrationRequirements():void
    {
        if (mb_strlen($this->username) < 5) {
            $this->warningsArray[] = "Username must be at least 5 letters long";
        }
        if (mb_strlen($this->password1) < 6) {
            $this->warningsArray[] = "passwords must be at least 6 letters long";
        }
        if ($this->password1 !== $this->password2) {
            $this->warningsArray[] = "Passwords must match";
        }
        $user = new User();
        $repositoryManager = $this->em->getRepository(User::class);
        if($repositoryManager->findOneBy(['email'=>$this->email]) !== null and
            $repositoryManager->findOneBy(['username'=>$this->username]) !== null
        ) {
            $this->warningsArray[] = "Either Username or email is already taken";
        }
        if(empty($this->warningsArray)) {
            try {
                $user->setEmail($this->email)
                    ->setPassword($this->passwordEncoder->hashPassword($user, $this->password1))
                    ->setUsername($this->username);
                $this->em->persist($user);
                $this->em->flush();
                $this->flashBag->add('notice',"Registration successful");
            } catch (\Exception $e) {
                $this->flashBag->add('warning',"internal server error sorry");
            };
        }
        else{
            foreach ($this->warningsArray as $warning){
                $this->flashBag->add('warning',"$warning");
            }
        }
    }


}