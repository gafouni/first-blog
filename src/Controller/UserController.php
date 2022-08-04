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
        //var_dump($_POST);
        if (!empty($this->request->request->get('email')) ){
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
                $user = $userRepository->findOneByEmail(strip_tags($this->request->request->get('email')));
                //var_dump($user);
                
                //Si l'utilisateur n'existe pas
                if(!$user){
                   // var_dump('cccc');
                    $this->session->set('message', 'L\'adresse e-mail et/ou le mot de passe est incorrect');
                    header('location:?c=login');
                    
                }    

                //L'utilisateur existe
               
                

                //Verification du mot de passe
                //var_dump($user);
                if (password_verify($this->request->request->get('password'), $user->getPassword())){  
                    //var_dump('dddd');
                    $userRepository->setSession($user);
                    header('Location:?c=profile');
                    
                }else {
                    //var_dump('eee');
                    $this->session->set('message', 'L\'adresse e-mail et/ou le mot de passe est incorrect');
                    //header('location:?c=login');
                    
                }

                    $this->session->set('message', "Vous etes connectes !");
                    header('Location:?c=profile'); 
                
                    
                    // if(($user->getStatus()) == ROLE_ADMIN){
                    //     $this->session->set('message', "Vous etes connectes !");
                    //     header('Location:?c=admin');  
                    // }else{    

                    //     $this->session->set('message', "Vous etes connectes !");
                    //     header('Location:?c=profile');  
                    // }
            
        }    
        
        //$message = $_SESSION['message'] ?? NULL;
        $message = $this->session->get('message') ?? NULL;
        $form = new LoginForm;

        $this->twig->display('login.html.twig', ['loginForm' => $form->loginForm()->createForm(), 'message'=>$message]);
    
    }
        


    public function register(){

        if (!empty($this->request->request->get('email')) ){

        $first_name = $this->request->request->get('prenom');
        $last_name = $this->request->request->get('nom');

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
                header('location:?c=register');
                
            }    
            
            //On nettoie l'adresse mail (strip_tags)
                $email = strip_tags($this->request->request->get('email'));

            // On chiffre le mot de passe
                $password = password_hash($this->request->request->get('password'), PASSWORD_BCRYPT);

            // On hydrate l'utilisateur et on le stocke en base de donnees
                $userRepository = new UserRepository;

                $user = new User(null, $first_name, $last_name, $email, $password, null);

                $userRepository->create($user);

                $this->session->set('message', "Votre compte a ete cree; vous pouvez vous connecter");
                header('Location: ?c=login');
        }    

        $form = new RegisterForm;

        $this->twig->display('register.html.twig', ['registerForm' => $form->registerForm()->createForm()]);
    }


    public function profile(){

        //On recupere la liste des articles proposes par le membre        
        $user = $this->getConnectedUser();
        $postRepository = new PostRepository;
        $posts = $postRepository->findAllByUser($user, $active=1);
        //var_dump($posts);
        //die;
        //$message = $_SESSION['message'] ?? NULL;
        $message = $this->session->get('message');

        $this->twig->display('profile.html.twig', ['user'=>$user, 'posts'=>$posts, 'message'=>$message] );

    }

    public function logout(){
        
        session_destroy();
        header('Location:?c=login');
        
    }    

}