<?php

namespace Mvondo\VideoBundle\Controller;

use Mvondo\VideoBundle\Entity\Video;
use Mvondo\VideoBundle\Form\VideoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VideoUserController extends Controller {

    public function indexAction(Request $request, $username, $page) {

        $user = $this->getUser();
        if ($user->getUsername() != $username)
            return $this->redirect($this->generateUrl('mvondo_video_user_list', array('username' => $user->getUsername())));

        $video = new Video();
        $form = $this->get('form.factory')->create(new VideoType(), $video);

        if ($request->isMethod('POST')) {
            if ($form->handleRequest($request)->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $video->setUser($user);
                $em->persist($video);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Video created.');
            }

            $form = $this->get('form.factory')->create(new VideoType(), new Video());
        }

        return $this->render('MvondoVideoBundle:VideoUser:index.html.twig', array(
                    'videos' => $user->getVideos(),
                    'form' => $form->createView()
        ));
    }

    public function addAction(Request $request, $username) {
        $user = $this->getUser();
        if ($user->getUsername() != $username)
            return $this->redirect($this->generateUrl('mvondo_video_user_update', array(
                                'username' => $user->getUsername(),
                                'id' => $id
            )));

        $client = $this->get('mvondo_youtube.google_client');
        $client->setRedirectUri("http://www.mvondo.local.fr/app_dev.php/authentication");
        // $client->setRedirectUri($this->generateUrl('mvondo_site_auth'));

        if ($request->getSession()->has("token")) {
            $client->setAccessToken($request->getSession()->get("token"));
            $video = new Video();
            $form = $this->get('form.factory')->create(new VideoType(), $video);

            if ($request->isMethod('POST')) {
                if ($form->handleRequest($request)->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $video->setUser($user);

                    $youtube = $this->get('mvondo_youtube.google_youtube');
                    $youtube->setClient($client);
                    if ($youtube->upload($video))
                        $request->getSession()->getFlashBag()->add('notice', 'Video created.');
                }
            }
            return $this->render('MvondoVideoBundle:VideoUser:add.html.twig', array('form' => $form->createView()));
        }

        return $this->render('MvondoVideoBundle:VideoUser:add.html.twig', array('authLink' => $client->createAuthUrl()));
    }

    public function synchronizeAction(Request $request, $username) {
        $user = $this->getUser();
        if ($user->getUsername() != $username)
            return $this->redirect($this->generateUrl('mvondo_video_user_synchronize', array(
                                'username' => $user->getUsername()
            )));
        

        $client = $this->get('mvondo_youtube.google_client');
        $client->setRedirectUri("http://www.mvondo.local.fr/app_dev.php/authentication");
        // $client->setRedirectUri($this->generateUrl('mvondo_site_auth'));
        $youtube = $this->get('mvondo_youtube.google_youtube');

        if ($request->getSession()->has("token")) {
            $client->setAccessToken($request->getSession()->get("token"));
            $youtube->setClient($client);

            if ($request->isXmlHttpRequest()) {
                if (($videoKey = $request->request->get('id')) && ($catid = $request->request->get('catid')))
                    $youtube->save($videoKey, $catid);

                return new \Symfony\Component\HttpFoundation\JsonResponse('Video ajouté');
            }
            $results = $youtube->synchronize();
            $categories = $this->getDoctrine()->getManager()->getRepository('MvondoVideoBundle:Category')->findAll();
            return $this->render('MvondoVideoBundle:VideoUser:synchronize.html.twig', array(
                        'categories' => $categories,
                        'videos' => $results
            ));
        }

        return $this->render('MvondoVideoBundle:VideoUser:synchronize.html.twig', array('authLink' => $client->createAuthUrl()));
    }

    public function deleteAction(Request $request, $id, $username) {
        $user = $this->getUser();
        if ($user->getUsername() != $username)
            return $this->redirect($this->generateUrl('mvondo_video_user_update', array(
                                'username' => $user->getUsername(),
                                'id' => $id
            )));

        $em = $this->getDoctrine()->getManager();
        if (!($video = $em->getRepository('MvondoVideoBundle:Video')->findOneBy(array('id' => $id, 'user' => $user))))
            throw $this->createNotFoundException("Video not found!!");

        $request->getSession()->getFlashBag()->add('notice', 'Categorie ' . $video->getTitle() . ' deleted');
        $em->remove($video);
        $em->flush();
        return $this->redirect($this->generateUrl('mvondo_video_user_list', array('username' => $user->getUsername())));
    }

}
