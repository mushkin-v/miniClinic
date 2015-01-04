<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Doctor;
use AppBundle\Form\Type\DoctorType;
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
            $this->getDoctrine()->getManager()->persist($doctor);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('User/docRegister.html.twig',
            [
                'form' => $form->createView(),
            ]);
    }
}
