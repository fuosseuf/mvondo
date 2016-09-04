<?php
namespace Mvondo\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ModulesController extends Controller {


    public function last_eventsAction() {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('MvondoEventBundle:Event')->findAll();
        return $this->render('modules/last_events.html.twig', array('events' => $events));
    }


    public function highlight_eventAction($id) {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('MvondoEventBundle:Event')->find($id);

        return $this->render('modules/highlight_event.html.twig', array(
                    'event' => $event,
        ));
    }

}
