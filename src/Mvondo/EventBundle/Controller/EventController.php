<?php

namespace Mvondo\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Mvondo\EventBundle\Entity\TypeEvent;
use Mvondo\EventBundle\Form\TypeEventType;
use Mvondo\EventBundle\Entity\Event;
use Mvondo\EventBundle\Form\EventType;

class EventController extends Controller {

    public function indexAction() {
        $menu = array(
            'link' => "",
            'title' => "",
            'slug' => "agenda"
        );
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository("MvondoEventBundle:Event")->findAll();
        return $this->render('site/agenda.html.twig', array(
            'menu' => $menu,
            'events'=>$events
            ));
    }

    public function typeAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $type = new TypeEvent();
        $form = $this->get('form.factory')->create(new TypeEventType(), $type);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($type);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Type d\'évênement bien enregistré.');
        }

        $types = $em->getRepository("MvondoEventBundle:TypeEvent")->findAll();
        $menu = array(
            'link' => "",
            'title' => "Espace Admin - type Evênement",
            'slug' => "admin"
        );
        return $this->render('site/admin_agenda_type.html.twig', array(
                    'menu' => $menu,
                    'types' => $types,
                    'form' => $form->createView()
        ));
    }

    public function typeUpdateAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        if (!$type = $em->getRepository("MvondoEventBundle:TypeEvent")->find($id))
            throw $this->createNotFoundException("Ce type d'éêneent n'éxiste pas!!!");
        $form = $this->get('form.factory')->create(new TypeEventType(), $type);

        if ($form->handleRequest($request)->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Type d\'évênement bien mis à jour.');
        }

        $types = $em->getRepository("MvondoEventBundle:TypeEvent")->findAll();
        $menu = array(
            'link' => "",
            'title' => "Espace Admin - type Evênement",
            'slug' => "admin"
        );
        return $this->render('site/admin_agenda_type.html.twig', array(
                    'menu' => $menu,
                    'types' => $types,
                    'form' => $form->createView()
        ));
    }

    public function addAction(Request $request, $username) {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if ($user->getUsername() != $username)
            return $this->redirect($this->generateUrl('mvondo_event_user_add', array('username' => $user->getUsername())));
        $event = new Event();
        $form = $this->get('form.factory')->create(new EventType(), $event);

        if ($form->handleRequest($request)->isValid()) {
            $event->setUser($user);
            $em->persist($event);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Evênement bien enregistré.');
        }

        $events = $em->getRepository("MvondoEventBundle:Event")->findAll();
        $menu = array(
            'link' => "",
            'title' => "Espace Artiste - Evênement",
            'slug' => "admin"
        );
        return $this->render('site/add_agenda.html.twig', array(
                    'menu' => $menu,
                    'events' => $events,
                    'form' => $form->createView()
        ));
    }

    public function updateAction(Request $request, $username, $id) {
        $user = $this->getUser();
        if ($user->getUsername() != $username)
            return $this->redirect($this->generateUrl('mvondo_event_user_add', array('username' => $user->getUsername())));
        $menu = array(
            'link' => "",
            'title' => "Espace Artiste - Evênement",
            'slug' => "admin"
        );

        $em = $this->getDoctrine()->getManager();
        if (!($event = $em->getRepository('MvondoEventBundle:Event')->find($id)))
            throw $this->createNotFoundException("Cet évênement n'éxiste pas!!!");

        $form = $this->get('form.factory')->create(new EventType(), $event);

        if ($form->handleRequest($request)->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Evênement bien mis à jour.');
            return $this->redirect($this->generateUrl('mvondo_event_user_add', array('username' => $user->getUsername())));
        }


        return $this->render('site/update_agenda.html.twig', array(
                    'menu' => $menu,
                    'form' => $form->createView()
        ));
    }

    public function deleteAction(Request $request, $username, $id) {
        $user = $this->getUser();
        if ($user->getUsername() != $username)
            return $this->redirect($this->generateUrl('mvondo_event_user_add', array('username' => $user->getUsername())));

        $em = $this->getDoctrine()->getManager();
        if (!($event = $em->getRepository('MvondoEventBundle:Event')->find($id)))
            throw $this->createNotFoundException("Cet évênement n'éxiste pas!!!");

        $em->remove($event);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Evênement bien mis à jour.');
        return $this->redirect($this->generateUrl('mvondo_event_user_add', array('username' => $user->getUsername())));
    }

}
