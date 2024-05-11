<?php

namespace App\Controller;

use App\Entity\Login;
use App\Entity\OTP;
use App\Services\DisplayImg;
use App\Services\EmailChecker;
use App\Services\NewAccountCreation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * The Authentication controller manages all the Authentication related 
 * operations like login, register, reset password etc. Otp verification is 
 * added.
 * 
 * @package ORM
 * @subpackage Doctrine
 * 
 * @author Deepak Pandey <deepak.pandey@innoraft.com>
 */
class AuthenticationController extends AbstractController
{
    /**
     * @var object
     *    Request object handles parameter from query parameter.
     */
    private $em;

    /**
     * @var object
     *    Instance of login Repository.
     */
    private $login;

    /**
     * @var object
     *    Object of login Entity.
     */
    private $loginObj;

    /**
     * @var object
     *    Object of a class NewAccountCreation().
     */
    private $newAccountData;

    /**
     * @var object
     *    Instance of otp Repository.
     */
    private $oneTimeP;

    /**
     * @var object
     *    Object of otp Entity.
     */
    private $oneTimePass;

    /**
     * This constructor is used to initializing the object and also provides the
     * access to EntityManagerInterface
     * 
     * @param object $em
     *   Request object handles parameter from query parameter.
     * @param object $login
     *   Instance of login Repository.
     * @param object $loginObj
     *   object of login Entity.
     * @param object $newAccountData
     *   Object of a class NewAccountCreation().
     * @param object $oneTimeP
     *   Instance of otp Repository.
     * @param object $oneTimePass
     *   Object of otp Entity.
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->login = $this->em->getRepository(login::class);
        $this->loginObj = new Login();
        $this->newAccountData = new NewAccountCreation();
        $this->oneTimeP = $this->em->getRepository(OTP::class);
        $this->oneTimePass = new OTP();
    }

    /**
     * This routes opens the Password Reset page.
     * 
     * @param $token
     *   Encripted userId for reseting password.
     * 
     * @return Response
     *   Returns Password Reset page with encoded password.
     */
    #[Route('/PasswordReset/{token}', name: 'PasswordReset')]
    public function passwordReset($token)
    {
        return $this->render('login/PasswordReset.html.twig', [
            "token" => $token
        ]);
    }

    /**
     * This routes Reset the user password from a link which he has received
     * in his email.
     *
     * @param object $request
     *   Request object handles parameter from query parameter.
     * 
     * @return Response
     *   Returns message that the password is reset or not.
     */
    #[Route('/PasswordR', name: 'PasswordR')]
    public function passwordR(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $pass = $request->request->get('pass');
            $token = $request->request->get('token');
            $id = base64_decode($token);
            $login = $this->login->find($id);
            if ($login) {
                $ePass = base64_encode($pass);
                $login->setPassword($ePass);
                $this->em->persist($login);
                $this->em->flush();
                return new JsonResponse("Password Reset Successful");
            }
            return new JsonResponse("Data Not Found");
        }
        return new JsonResponse("Failed");
    }
    
    /**
     * This routes sends the resend password link to user emailId.
     *
     * @return Response
     *   Returns message that the email is send or not.
     */
    #[Route('/ResetPass', name: 'ResetPass')]
    public function resetPass(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $email = $request->request->get('email');

            $login = $this->login->findOneBy(['email' => $email]);
            if (!$login) {
                return new JsonResponse('User Not Exists !!');
            }
            $userId = $login->getId();

            $emailSend = new EmailChecker($email, 'Welcome to VidyaVista Your PasswordReset Link is here : ' . "http://127.0.0.1:8000/PasswordReset/" . base64_encode($userId), 'Password Reset Link for VidyaVista ');
            $emailSendStatus = $emailSend->emailSend();
            if ($emailSendStatus) {
                return new JsonResponse("Reset Password Link send to your email id");
            }
            return new JsonResponse("Failed");
        }
        return $this->render(view: 'login/ResetPass.html.twig');
    }

    /**
     * This routes checks the emailid and password is correct or not.
     * 
     * @param object $session
     *   Session object store session variable.
     * @param object $request
     *   Request object handles parameter from query parameter.
     *  
     * @return Response
     *   Returns message that the passwoard is correct or not.
     */
    #[Route('/login', name: 'login')]
    public function login(Request $request, SessionInterface $session)
    {
        if ($request->isXmlHttpRequest()) {
            $email = $request->request->get('email');
            $pass = $request->request->get('pass');
            $dPass = base64_encode($pass);
            $check = $this->login->findOneBy(['email' => $email, 'password' => $dPass]);
            if ($check) {
                $session->set('email', $email);
                $check->setStatus(1);
                $this->em->persist($check);
                $this->em->flush();
                return new JsonResponse('done');
            }
            return new JsonResponse('Worng email-id OR password !!');
        }
        return $this->render(view: 'login/login.html.twig');
    }

    /**
     * This route create a new user account and then redirect the it to 
     * home page.
     * 
     * @param object $session
     *   Session object store session variable.
     * @param object $request
     *   Request object handles parameter from query parameter.
     *  
     * @return object
     *   Returns error message if some errors occurs while creating account 
     *   or else return to home page.
     */
    #[Route('/newAccount', name: 'new_Account')]
    public function newAccount(Request $request, SessionInterface $session)
    {
        if ($request->isXmlHttpRequest()) {
            $dataSetAccount = $this->newAccountData->getAccountDetails($request);
            $check = $this->login->findOneBy(['email' => $dataSetAccount['email']]);
            $otpCheck = $this->oneTimeP->findOneBy(['emailId' => $dataSetAccount['email'], 'Otp' => $dataSetAccount['otpUser']]);
            if (!$dataSetAccount['image']) {
                $dataSetAccount['image'] = "";
            }
            $imageLocation = new DisplayImg($dataSetAccount['image'], $dataSetAccount['email'], $dataSetAccount['gender']);
            $dataSetAccount['image'] = $imageLocation->checkingImg();
            if ($dataSetAccount['pass'] != $dataSetAccount['conPass']) {
                return new JsonResponse('Wrong Password !!');
            } elseif (!$otpCheck) {
                return new JsonResponse('Wrong OTP Enter.');
            } elseif (!$check) {
                $dataSetAccount['pass'] = base64_encode($dataSetAccount['pass']);
                if ($dataSetAccount['authLetter'] != "NULL") {
                    $dataSetAccount['authLetter']->move('authLetter/', $dataSetAccount['email']);
                    $dataSetAccount['authLetter'] = 'authLetter/' . $dataSetAccount['email'];
                }
                $this->loginObj->setVal($dataSetAccount);
                $this->em->persist($otpCheck);
                $this->em->persist($this->loginObj);
                $this->em->flush();
                $session->set('email', $dataSetAccount['email']);
                return new JsonResponse("done");
            }
            return new JsonResponse('Email-Id Already Exist !!');
        }
        return $this->render(view: 'login/signup.html.twig');
    }

    /**
     * This route sends otp to user email id and also stores it to database.
     * 
     * @param object $session
     *   Session object store session variable.
     * @param object $request
     *   Request object handles parameter from query parameter.
     *  
     * @return Response
     *   Returns message of otp status.
     */
    #[Route('/otpSend', name: 'otpSend')]
    public function sendOtp(Request $request)
    {
        if ($request->isXmlHttpRequest()) {

            $email = $request->request->get('email');
            $check = $this->login->findOneBy(['email' => $email]);
            if (!$check) {
                $otp = rand(100000, 999999);

                $emailSend = new EmailChecker($email, "Here's your OTP to log into your VidyaVista. " . $otp, 'Your OTP to enter into your VidyaVista Journey.');
                $emailSendStatus = $emailSend->emailSend();
                $otpCheck = $this->oneTimeP->findOneBy(['emailId' => $email]);

                if (!$emailSendStatus) {
                    return new JsonResponse('OTP not send try again');
                } elseif ($otpCheck) {
                    $otpCheck->setOtp($otp);
                    $this->em->persist($otpCheck);
                    $this->em->flush();
                    return new JsonResponse('OTP Send to your email address');
                }
                $this->oneTimePass->setEmailId($email);
                $this->oneTimePass->setOtp($otp);
                $this->oneTimePass->setValidity('0');
                $this->em->persist($this->oneTimePass);
                $this->em->flush();
                return new JsonResponse('OTP Send to your email address');
            }
            return new JsonResponse('Account already exist !!');
        }
        return new JsonResponse('Failed');
    }

    /**
     * This route destroys the session and redirect the page to login page.
     *
     * @return Response
     *   Returns login page.
     */
    #[Route('/logout', name: 'logout')]
    public function logout(SessionInterface $session)
    {
        $emailId = $session->get('email');
        $check = $this->login->findOneBy(['email' => $emailId]);

        $check->setStatus('0');

        $this->em->persist($check);
        $this->em->flush();
        $session->clear();

        return $this->render(view: 'login/login.html.twig');
    }

    /**
     * This route sends mails to users and owner.
     * 
     * @param object $request
     *   Request object handles parameter from query parameter.
     *  
     * @return Response
     *   Returns message of contacts us form.
     */
    #[Route('/contactussend', name: 'contactussend')]
    public function sendContactUsSend(Request $request)
    {
        if ($request->isXmlHttpRequest()) {

            $email = $request->request->get('email');
            $name = $request->request->get('name');
            $message = $request->request->get('message');
            $user_message = "Hi " . $name . ", <br>
            
            Thank you for contacting VidyaVista,<br><br>
            
            We will surely get through your query and get back to you ASAP!<br><br>

            Regards,<br>
            Team VidyaVista";

            $vidyaVistaBody = "Hi Team VidyaVista, <br>
            
            Someone send a request,<br><br>
            Name : ". $name ."<br>
            Email : ". $email ."<br>
            Message : ". $message ."<br><br>

            Regards,<br>
            Team VidyaVista";
            $emailSend = new EmailChecker($email, $user_message, 'Thankyou for contacting VidyaVista.');
            $emailSendStatus = $emailSend->emailSend();

            if ($emailSendStatus) {
                $vidyaVistaEmailSend = new EmailChecker('info.vidyavista@gmail.com', $vidyaVistaBody, 'Someone send a request to VidyaVista.');
                $vidyaVistaEmailSendStatus = $vidyaVistaEmailSend->emailSend();
                if($vidyaVistaEmailSendStatus) {
                    return new JsonResponse('Thank you for contacting VidyaVista.');  
                }     
                return new JsonResponse('Failes to contact VidyaVista team.');  
            }
            return new JsonResponse('Failed.');
        }
        return new JsonResponse('Failed');
    }
}
