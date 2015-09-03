<?php

namespace Mvondo\VideoBundle\Controller;

use Mvondo\VideoBundle\Entity\Category;
use Mvondo\VideoBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller {

    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $category = new Category();
        $form = $this->get('form.factory')->create(new CategoryType(), $category);
        if ($request->isMethod('POST')) {
            if ($form->handleRequest($request)->isValid()) {
                $em->persist($category);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Category created.');
            }
        }

        $categories = $em->getRepository('MvondoVideoBundle:Category')->findAll();
        return $this->render('MvondoVideoBundle:Category:index.html.twig', array(
                    'categories' => $categories,
                    'form' => $form->createView()
        ));
    }

    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('MvondoVideoBundle:Category')->find($id);
        $form = $this->get('form.factory')->create(new CategoryType(), $category);

        if ($form->handleRequest($request)->isValid()) {
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Categorie ' . $category->getName() . ' updated');
            return $this->redirect($this->generateUrl('mvondo_category_list'));
        }

        $categories = $em->getRepository('MvondoVideoBundle:Category')->findAll();
        return $this->render('MvondoVideoBundle:Category:edit.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function deleteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('MvondoVideoBundle:Category')->find($id);
        $request->getSession()->getFlashBag()->add('notice', 'Categorie ' . $category->getName() . ' updated');
        $em->remove($category);
        $em->flush();
        return $this->redirect($this->generateUrl('mvondo_category_list'));
    }

}
