<?php

namespace TradeBundle\Controller;

use TradeBundle\Entity\MoneyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Moneytype controller.
 *
 * @Route("moneytype")
 */
class MoneyTypeController extends Controller
{
    /**
     * Lists all moneyType entities.
     *
     * @Route("/", name="moneytype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $moneyTypes = $em->getRepository('TradeBundle:MoneyType')->findAll();

        return $this->render('moneytype/index.html.twig', array(
            'moneyTypes' => $moneyTypes,
        ));
    }

    /**
     * Creates a new moneyType entity.
     *
     * @Route("/new", name="moneytype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $moneyType = new Moneytype();
        $form = $this->createForm('TradeBundle\Form\MoneyTypeType', $moneyType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($moneyType);
            $em->flush();

            return $this->redirectToRoute('moneytype_show', array('id' => $moneyType->getId()));
        }

        return $this->render('moneytype/new.html.twig', array(
            'moneyType' => $moneyType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a moneyType entity.
     *
     * @Route("/{id}", name="moneytype_show")
     * @Method("GET")
     */
    public function showAction(MoneyType $moneyType)
    {
        $deleteForm = $this->createDeleteForm($moneyType);

        return $this->render('moneytype/show.html.twig', array(
            'moneyType' => $moneyType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing moneyType entity.
     *
     * @Route("/{id}/edit", name="moneytype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MoneyType $moneyType)
    {
        $deleteForm = $this->createDeleteForm($moneyType);
        $editForm = $this->createForm('TradeBundle\Form\MoneyTypeType', $moneyType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('moneytype_edit', array('id' => $moneyType->getId()));
        }

        return $this->render('moneytype/edit.html.twig', array(
            'moneyType' => $moneyType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a moneyType entity.
     *
     * @Route("/{id}", name="moneytype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, MoneyType $moneyType)
    {
        $form = $this->createDeleteForm($moneyType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($moneyType);
            $em->flush();
        }

        return $this->redirectToRoute('moneytype_index');
    }

    /**
     * Creates a form to delete a moneyType entity.
     *
     * @param MoneyType $moneyType The moneyType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MoneyType $moneyType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('moneytype_delete', array('id' => $moneyType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
