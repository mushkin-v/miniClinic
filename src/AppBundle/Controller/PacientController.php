<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pacient;
use AppBundle\Form\Type\PacientType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PacientController extends Controller
{
    /**
     * @Route("/pacientRegister", name="pacientRegister")
     * @param  Request                                                                                       $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function pacientRegisterAction(Request $request)
    {
        $pacient = new Pacient();

        $form = $this->createForm(new PacientType(), $pacient);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $pacient->setUser($this->getUser());
            $this->getDoctrine()->getManager()->persist($pacient);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('User/pacientRegister.html.twig',
            [
                'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/pacientAccount", name="pacientAccount")
     * @param  Request                                                                                       $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function pacientAccountAction(Request $request)
    {
        $pacient = $this->getDoctrine()->getManager()->getRepository('AppBundle:Pacient')
            ->findOneByuser($this->getUser());

        $form = $this->createForm(new PacientType(), $pacient);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($pacient);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('User/pacientAccount.html.twig',
            [
                'form' => $form->createView(),
            ]);
    }
}
