<?php
namespace App\Controller;


use App\Entity\User;
use App\Forms\LoginForm; 
use App\Forms\RegisterForm;
use App\Validation\Validator;
use App\Repository\PostRepository;
use App\Repository\UserRepository;

class UserController extends CoreController{

    /**Creation du formulaire de connexion */
    public function login(){
        if (isset($_POST['email']) ){
            //var_dump('aaaa');
            //On verifie si le formulaire est valide
            $validator = new Validator($_POST);
            $errors =  $validator->validate([
                'email' =>['required'],
                'password' =>['required', 'min:6']
            ]);

            if ($errors) {
                //var_dump('bbbb');
                $_SESSION['errors'][] = $errors;
                header('location:?c=login');
                
            }    
                //On va chercher l'utilisateur dans la base de donnee
                $userRepository = new UserRepository;
                $user = $userRepository->findOneByEmail(strip_tags($_POST['email']));
                var_dump($user);
                
                //Si l'utilisateur n'existe pas
                if(!$user){
                    //var_dump('cccc');
                    $_SESSION['erreur'] = 'L\'adresse e-mail et/ou le mot de passe est incorrect';
                    header('location:?c=login');
                    
                }    

                //L'utilisateur existe
               

                //Verification du mot de passe
                if (password_verify($_POST['password'], $user->getPassword())){  
                    //var_dump('dddd');
                    $userRepository->setSession($user);
                    header('Location:?c=profile');
                    
                }else {
                    $_SESSION['erreur'] = 'L\'adresse e-mail et/ou le mot de passe est incorrect';
                    //header('location:?c=login');
                    exit;
                }

                $_SESSION['message'] = "Votre compte a ete cree avec succes !";
                header('Location: ?c=profile');        

            

            
        }    
        
        $form = new LoginForm;

        echo $this->twig->render('login.html.twig', ['loginForm' => $form->loginForm()->createForm()]);

        
    
    }
        


    public function register(){

        if (isset($_POST['email']) ){

        $first_name = $_POST['prenom'];
        $last_name = $_POST['nom'];

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
            }    
            
            //On nettoie l'adresse mail (strip_tags)
                $email = strip_tags($_POST['email']);

            // On chiffre le mot de passe
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            // On hydrate l'utilisateur et on le stocke en base de donnees
                $userRepository = new UserRepository;

                $user = new User(null, $first_name, $last_name, $email, $password, null);

                $userRepository->create($user);

                $_SESSION['message'] = "Votre compte a ete cree avec succes !";
                header('Location: ?c=profile');
        }    

        $form = new RegisterForm;

        echo $this->twig->render('register.html.twig', ['registerForm' => $form->registerForm()->createForm()]);
    }


    public function profile(){
        $user = unserialize($_SESSION['user']);
        $postRepository = new PostRepository;
        $posts = $postRepository->findAllByUser($user);
        var_dump($posts);
        echo $this->twig->render('profile.html.twig', ['user'=>$user, 'posts'=>$posts] );

    }




}