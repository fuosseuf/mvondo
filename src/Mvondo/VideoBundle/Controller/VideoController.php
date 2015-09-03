<?php

namespace Mvondo\VideoBundle\Controller;

use Mvondo\VideoBundle\Entity\Video;
use Mvondo\VideoBundle\Form\VideoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VideoController extends Controller {

    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $video = new Video();
        $form = $this->get('form.factory')->create(new VideoType(), $video);
        if ($request->isMethod('POST')) {
            if ($form->handleRequest($request)->isValid()) {
                $em->persist($video);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Video created.');
            }
        }

        $videos = $em->getRepository('MvondoVideoBundle:Video')->findAll();
        return $this->render('MvondoVideoBundle:Video:index.html.twig', array(
                    'videos' => $videos,
                    'form' => $form->createView()
        ));
    }

    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('MvondoVideoBundle:Video')->find($id);
        $form = $this->get('form.factory')->create(new VideoType(), $video);

        if ($form->handleRequest($request)->isValid()) {
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Categorie ' . $video->getName() . ' updated');
            return $this->redirect($this->generateUrl('mvondo_video_list'));
        }

        $videos = $em->getRepository('MvondoVideoBundle:Video')->findAll();
        return $this->render('MvondoVideoBundle:Video:edit.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function deleteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('MvondoVideoBundle:Video')->find($id);
        $request->getSession()->getFlashBag()->add('notice', 'Categorie ' . $video->getName() . ' updated');
        $em->remove($video);
        $em->flush();
        return $this->redirect($this->generateUrl('mvondo_video_list'));
    }

}
