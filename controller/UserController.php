<?php

/**
 * Le Controlleur correspondant a l'utilisateur
 * - PreregisterAction est appele a la suite du preregisterForm, lors du submit
 *   et fais quelques pretraitements
 * - RegisterAction est appele a la suite du registerForm, lors du submit
 */
class UserController extends Controller
{
    public function PreregisterAction(Request $request)
    {
        $this->loadModel('UserModel');

        $email = $request->post('email');
        $password = $request->post('password');
        $confirmPwd = $request->post('confirmPwd');

        if ($email && $password && $confirmPwd)
        {
            $isError = false;
            $errors = array();
            if (!($this->usermodel->availableEmail($email)))
            {
                $errors['email'] = 'Email déjà utilisé';
                $isError = true;
            }
            if ($password != $confirmPwd)
            {
                $errors['password'] = 'Mot de passe différent';
                $isError = true;
            }
            if (!($this->usermodel->availablePwd($password)))
            {
                $errors['password'] = 'La taille du mdp doit être entre 6 et 20';
                $isError = true;
            }
            if ($isError)
            {
                $data = array('errors' => $errors);
                $this->render('persists/home', $data);
                return;
            }

            $request->getSession()->set('email', $email);
            $request->getSession()->set('password', $password);

            $this->render('forms/registerForm');
        }
    }

    public function RegisterAction(Request $request)
    {
        $username = $request->post('username');
        $birthDate = $request->post('birthDate');
        //On recupere les champs deja entres
        $email = $request->getSession()->get('email');
        $password = $request->getSession()->get('password');

        if (isset($username, $birthDate))
        {
            $this->loadModel('UserModel');

            $errors = array();
            $isError = false;
            $data = array
            (
                'username' => $username,
            );

            if (!($this->usermodel->availableUser($username)))
            {
                $errors['username'] = 'Pseudonyme déjà utilisé';
                $isError = true;
            }
            if ($isError)
            {
                $data['errors'] = $errors;
                $this->render('views/forms/registerForm', $data);
                return;
            }

            echo "Ceci est un test";

            $this->usermodel->addUser($username, $email, $password, $birthDate);
            $this->render('views/persists/validationInscription');
        }
        echo "test";
    }

    public function LoginAction()
    {
        $this->render('persists/home');
    }
}