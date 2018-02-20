<?php

namespace TradeBundle\Controller;

use TradeBundle\Entity\AmountType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Amounttype controller.
 *
 * @Route("amounttype")
 */
class AmountTypeController extends Controller
{
    /**
     * Lists all amountType entities.
     *
     * @Route("/", name="amounttype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $amountTypes = $em->getRepository('TradeBundle:AmountType')->findAll();

        return $this->render('amounttype/index.html.twig', array(
            'amountTypes' => $amountTypes,
        ));
    }

    /**
     * Creates a new amountType entity.
     *
     * @Route("/new", name="amounttype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $amountType = new Amounttype();
        $form = $this->createForm('TradeBundle\Form\AmountTypeType', $amountType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($amountType);
            $em->flush();

            return $this->redirectToRoute('amounttype_show', array('id' => $amountType->getId()));
        }

        return $this->render('amounttype/new.html.twig', array(
            'amountType' => $amountType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a amountType entity.
     *
     * @Route("/{id}", name="amounttype_show")
     * @Method("GET")
     */
    public function showAction(AmountType $amountType)
    {
        $deleteForm = $this->createDeleteForm($amountType);

        return $this->render('amounttype/show.html.twig', array(
            'amountType' => $amountType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing amountType entity.
     *
     * @Route("/{id}/edit", name="amounttype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AmountType $amountType)
    {
        $deleteForm = $this->createDeleteForm($amountType);
        $editForm = $this->createForm('TradeBundle\Form\AmountTypeType', $amountType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('amounttype_edit', array('id' => $amountType->getId()));
        }

        return $this->render('amounttype/edit.html.twig', array(
            'amountType' => $amountType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a amountType entity.
     *
     * @Route("/{id}", name="amounttype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AmountType $amountType)
    {
        $form = $this->createDeleteForm($amountType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($amountType);
            $em->flush();
        }

        return $this->redirectToRoute('amounttype_index');
    }

    /**
     * Creates a form to delete a amountType entity.
     *
     * @param AmountType $amountType The amountType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AmountType $amountType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('amounttype_delete', array('id' => $amountType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
