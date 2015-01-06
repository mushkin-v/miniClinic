<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Doctor;
use AppBundle\Entity\Pacient;
use AppBundle\Form\Type\DoctorType;
use AppBundle\Form\Type\PacientType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/docRegister", name="docRegister")
     */
    public function docRegisterAction(Request $request)
    {
        $doctor = new Doctor();

        $form = $this->createForm(new DoctorType(), $doctor);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $doctor->setUser($this->getUser());
            $this->getDoctrine()->getManager()->persist($doctor);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('User/docRegister.html.twig',
            [
                'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/pacientRegister", name="pacientRegister")
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

    /**
     * @Route("/docAccount", name="docAccount")
     */
    public function docAccountAction(Request $request)
    {
        $doctor = $this->getDoctrine()->getManager()->getRepository('AppBundle:Doctor')
            ->findOneByuser($this->getUser());

        $form = $this->createForm(new DoctorType(), $doctor);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($doctor);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('User/docAccount.html.twig',
            [
                'form' => $form->createView(),
            ]);
    }
}
