<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Doctor;
use AppBundle\Entity\Pacient;
use AppBundle\Entity\User;
use AppBundle\Form\Type\DoctorType;
use AppBundle\Form\Type\DoctorLoginType;
use AppBundle\Form\Type\PacientType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class UserController extends Controller
{
    /**
     * @Route("/pacientRegister", name="pacientRegister")
     * @param Request $request
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
     * @param Request $request
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

    /**
     * @Route("/docAccount", name="docAccount")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
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

    /**
     * @Route("/docRegister/{slug}", name="docRegister")
     * @param $slug
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function docRegisterAction($slug, Request $request)
    {
        $doctor = new Doctor();

        $form = $this->createForm(new DoctorType(), $doctor);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $doctorLogin = $this->getDoctrine()->getManager()->getRepository('AppBundle:User')
                ->findOneByusername($slug);
            $doctor->setEmail($doctorLogin->getEmail());
            $doctor->setCardNumber($doctorLogin->getCardNumber());
            $doctor->setUser($doctorLogin);
            $this->getDoctrine()->getManager()->persist($doctor);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirect($this->generateUrl('personal'));
        }

        return $this->render('User/docRegister.html.twig',
            [   'slug' => $slug,
                'form' => $form->createView(),
            ]);
    }
    /**
     * @Route("/sendEmail", name="sendEmail")
     */
    public function sendEmailAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $name = $request->request->get('name');
            $email = $request->request->get('description');
            $phone = $request->request->get('name');
            $message = $request->request->get('name');
            $this->get('vitmail')->Send(
                'This letter from' . $name . ' my phone number ' . $phone,
                $email,
                $this->getDoctrine()->getManager()->getRepository('AppBundle:User')
                    ->findOneByusername('admin')->getEmail(),
                $message
            );
        }
        return $this->redirect($this->generateUrl('contact',['infoline'=>'Your message have been sent! Thank you!']));
    }
}
