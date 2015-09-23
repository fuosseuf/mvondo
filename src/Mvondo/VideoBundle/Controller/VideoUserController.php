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

    public function updateAction(Request $request, $id, $username) {
        $user = $this->getUser();
        if ($user->getUsername() != $username)
            return $this->redirect($this->generateUrl('mvondo_video_user_update', array(
                                'username' => $user->getUsername(),
                                'id' => $id
            )));

        $em = $this->getDoctrine()->getManager();
        if(!($video = $em->getRepository('MvondoVideoBundle:Video')->findOneBy(array('id' => $id, 'user' => $user))))
            throw $this->createNotFoundException("Video not found!!");
        
        $form = $this->get('form.factory')->create(new VideoType(), $video);

        if ($form->handleRequest($request)->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Categorie ' . $video->getTitle() . ' updated');
            
            return $this->redirect($this->generateUrl('mvondo_video_user_list', array('username' => $username)));
        }

        return $this->render('MvondoVideoBundle:VideoUser:edit.html.twig', array('form' => $form->createView()));
    }

    public function deleteAction(Request $request, $id, $username) {
        $user = $this->getUser();
        if ($user->getUsername() != $username)
            return $this->redirect($this->generateUrl('mvondo_video_user_update', array(
                                'username' => $user->getUsername(),
                                'id' => $id
            )));

        $em = $this->getDoctrine()->getManager();
        if(!($video = $em->getRepository('MvondoVideoBundle:Video')->findOneBy(array('id' => $id, 'user' => $user))))
            throw $this->createNotFoundException("Video not found!!");
        
        $request->getSession()->getFlashBag()->add('notice', 'Categorie ' . $video->getTitle() . ' deleted');
        $em->remove($video);
        $em->flush();
        return $this->redirect($this->generateUrl('mvondo_video_user_list', array('username' => $user->getUsername())));
    }

}
