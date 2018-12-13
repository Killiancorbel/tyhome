<?php

namespace HO\CoreBundle\Controller;

use HO\MemberBundle\Entity\PremiumFile;
use HO\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;


class ApiController extends Controller
{
    public function newTokenAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneBy(array('username' => $request->request->get('username')));
        if (!$user) {
            return new JsonResponse(array('error' => "User not found"), 401);
        }

        $isValid = $this->get('security.password_encoder')->isPasswordValid($user, $request->request->get('password'));
        if (!$isValid) {
            throw new BadCredentialsException();
        }

        $token = $this->get('lexik_jwt_authentication.encoder.default')->encode(array(
            'username' => $user->getUsername(),
            'exp' => time() + 3600
        ));

        return new JsonResponse(array('token' => $token));
    }

    public function showAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_PREMIUM');
        $em = $this->getDoctrine()->getManager();
        $file = $em->getRepository(PremiumFile::class)->find($id);
        $data = $this->get('jms_serializer')->serialize($file, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function createAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_PREMIUM');
        $em = $this->getDoctrine()->getManager();
        $data = $request->request->all();
        $file = $request->files->get('file');
        $type = $request->request->get('type');
        if ($file) {
            $newFile = new PremiumFile();
            $newFile->setFile($file);
            $newFile->preUpload();
            $newFile->setUser($this->getUser());
            $newFile->setType($type);
            $em->persist($newFile);
            $em->flush();
            $newFile->upload();
            return new Response('', Response::HTTP_CREATED);
        }

        return new Response('', Response::HTTP_BAD_REQUEST);
    }

    public function listAction()
    {
        $this->denyAccessUnlessGranted('ROLE_PREMIUM');
        $em = $this->getDoctrine()->getManager();
        $files = $em->getRepository(PremiumFile::class)->findBy(array('user' => $this->getUser()));

        $res = [];
        foreach ($files as $file) {
            $temp = [];
            $temp['id'] = $file->getId();
            $temp['name'] = $file->getAlt();
            $temp['url'] =  "http://nootty.fr/uploads/img/" . $file->getId() . "." . $file->getUrl();
            $temp['type'] = $file->getType();
            $res[] = $temp;
        }
        $data = $this->get('jms_serializer')->serialize($res, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
