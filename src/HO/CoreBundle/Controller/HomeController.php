<?php

namespace HO\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use HO\CoreBundle\Entity\Content;
use HO\CoreBundle\Entity\Video;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class HomeController extends Controller
{
    public function homeAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$contents = $em->getRepository('HOCoreBundle:Content')->findBy(array('type' => 'homepage'));
    	$content = $contents[0]->getCode();
    	$videos = $em->getRepository('HOCoreBundle:Video')->findAll();

    	$video1 = $videos[0]->getSource();
    	$video2 = $videos[1]->getSource();
    	$video3 = $videos[2]->getSource();
        return $this->render('HOCoreBundle:Home:index.html.twig', array(
        	'content' => $content,
        	'video1' => $video1,
        	'video2' => $video2,
        	'video3' => $video3));
    }

    public function contactAction(Request $request) {
        $data = $request->request->all();
        $name = $data['name'];
        $email = $data['email'];
        $message = $data['message'];


        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'localhost';                            // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'root';                             // SMTP username
            $mail->Password =  null;                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($email, 'Mailer');
            $mail->addAddress('killian.corbel@gmail.com');
                             // Set email format to HTML
            $mail->Subject = 'New message from ' . $name;
            $mail->Body    = $message;

            $mail->send();
            $request->getSession()->getFlashBag()->add('info', 'Votre mail a bien été envoyé, nous reviendrons vers vous le plus vite possible');
            return $this->redirectToRoute('ho_core_homepage');
        } catch (Exception $e) {
            print_r($mail->ErrorInfo);
            exit();
            $request->getSession()->getFlashBag()->add('info', 'Erreur lors de l\'envoi de votre mail, écrivez nous à rodolphe.dugueperoux@epitech.eu');
            return $this->redirectToRoute('ho_core_homepage');
        }
    }
}
