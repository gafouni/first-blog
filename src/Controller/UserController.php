<?php
namespace App\Controller;


use App\Forms\LoginForm; 
use App\Forms\RegisterForm;
use App\Validation\Validator;
use App\Repository\UserRepository;

class UserController extends CoreController{

    /**Creation du formulaire de connexion */
    public function login(){
        
         //On verifie si le formulaire est valide
         $validator = new Validator($_POST);
         $errors =  $validator->validate([
             'email' =>['required'],
             'password' =>['required', 'min:6']
         ]);

         if ($errors) {
            $_SESSION['errors'][] = $errors;
            header('location:?c=login');
            exit; 

            //On va chercher l'utilisateur dans la base de donnee
            $userRepository = new UserRepository;
            $user = $userRepository->findOneByEmail(strip_tags($_POST['email']));

            if(!$user){
                $_SESSION['erreur'] = 'L\'adresse e-mail et/ou le mot de passe est incorrect';
                header('location:?c=login');
                exit;
            }    

            if (password_verify($_POST['password'], $user->password)){  
                $user->setSession();
            }else {
                $_SESSION['erreur'] = 'L\'adresse e-mail et/ou le mot de passe est incorrect';
                header('location:?c=login');
                exit;
            }
            
        echo $this->twig->render('profile.html.twig', ['user'=>$user]);


        }

        $form = new LoginForm;

         echo $this->twig->render('login.html.twig', ['loginForm' => $form->loginForm()->createForm()]);

    }


    public function register(){

        //On verifie si le formulaire est valide
        $validator = new Validator($_POST);
        $errors =  $validator->validate([
            'first_name' =>['required'],
            'last_name' =>['required'],
            'email' =>['required'],
            'password' =>['required', 'min:6']
        ]);

        //var_dump($errors); die();

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header('location:/register');
            exit;
        
        //On nettoie l'adresse mail (strip_tags)
            $email = strip_tags($_POST['email']);

        // On chiffre le mot de passe
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // On hydrate l'utilisateur 
            $userRepository = new UserRepository;

            $user->setFirst_name($first_name)
                ->setLast_name($last_name)
                ->setEmail($email)
                ->setPassword($password);

           // var_dump($user); 
            //die();

        // On stocke l'utilisateur en base de donnees
            $user->create();

            $_SESSION['message'] = "Votre compte a ete cree avec succes !";
            header('Location: c? = profile');
        }        

        $form = new RegisterForm;

        echo $this->twig->render('register.html.twig', ['registerForm' => $form->registerForm()->createForm()]);


    }

    public function profile(){

        echo $this->twig->render('profile.html.twig');

    }




}