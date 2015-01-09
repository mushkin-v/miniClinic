<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Appointment;
use AppBundle\Entity\Doctor;
use AppBundle\Entity\Pacient;
use AppBundle\Entity\PacientHistory;
use AppBundle\Entity\User;
use AppBundle\Form\Type\AppointmentType;
use AppBundle\Form\Type\DoctorType;
use AppBundle\Form\Type\PacientHistoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DocController extends Controller
{
    /**
     * @Route("/docOffice/{infoline}", name="docOffice", defaults={"infoline" = null})
     * @param $infoline
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function docOfficeAction($infoline)
    {
        return $this->render('User/docOffice.html.twig', array('infoline' => $infoline));
    }

    /**
     * @Route("/allAppointmentsHistory", name="allAppointmentsHistory")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function allAppointmentsHistoryAction()
    {
        return $this->render(
            'User/DocOffice/allAppointmentsHistory.html.twig',
            array(
                'appointments' => $this->getDoctrine()->getManager()->getRepository('AppBundle:Appointment')
                    ->findAll(),
            ));
    }

    /**
     * @Route("/docAppointmentsHistory", name="docAppointmentsHistory")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function docAppointmentsHistoryAction()
    {
        return $this->render(
            'User/DocOffice/docAppointmentsHistory.html.twig',
            array(
                'doctor' => $this->getDoctrine()->getManager()->getRepository('AppBundle:Doctor')
                    ->findOneByuser($this->getUser()),
                'appointments' => $this->getDoctrine()->getManager()->getRepository('AppBundle:Appointment')
                    ->findAll(),
            ));
    }

    /**
     * @Route("/createNewAppointment", name="createNewAppointment")
     * @param  Request                                                                                       $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createNewAppointmentAction(Request $request)
    {
        $appointment = new Appointment();

        $form = $this->createForm(new AppointmentType(), $appointment);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $doctor = $this->getDoctrine()->getManager()->getRepository('AppBundle:Doctor')
                ->findOneByuser($this->getUser());
            $appointment->setDoctor($doctor);
            $this->getDoctrine()->getManager()->persist($appointment);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('docOffice', ['infoline' => $this->get('translator')->trans('cotroller.new.app')]));
        }

        return $this->render('User/DocOffice/createNewAppointment.html.twig',
            [
                'form' => $form->createView(),
                'time' => $this->getDoctrine()->getManager()
                    ->getRepository('AppBundle:AppointmentTime')->findAll(),
            ]);
    }

    /**
     * @Route("/docPacientHistory", name="docPacientHistory")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function docPacientHistoryAction()
    {
        $docPacientsHistories = $this->getDoctrine()->getManager()->getRepository('AppBundle:Doctor')
            ->findOneByuser($this->getUser())->getPacients();
        foreach ($docPacientsHistories as $history) {
            $pacients[] = $history->getPacient();
        }

        return isset($pacients) ?
            $this->render(
            'User/DocOffice/docPacientHistory.html.twig',
            array(
            'docPacients' => array_unique($pacients),
            )) :
            $this->redirect($this->generateUrl(
                'docOffice', ['infoline' => $this->get('translator')->trans('cotroller.no.pac')]))
            ;
    }

    /**
     * @Route("/allPacientHistory", name="allPacientHistory")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function allPacientHistoryAction()
    {
        return $this->render(
            'User/DocOffice/allPacientHistory.html.twig',
            array(
                'pacients' => $this->getDoctrine()->getManager()->getRepository('AppBundle:Pacient')
                    ->findAll(),
            ));
    }

    /**
     * @Route("/createPacientHistory", name="createPacientHistory")
     * @param  Request                                                                                       $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createPacientHistoryAction(Request $request)
    {
        $history = new PacientHistory();

        $form = $this->createForm(new PacientHistoryType(), $history);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $doctor = $this->getDoctrine()->getManager()->getRepository('AppBundle:Doctor')
                ->findOneByuser($this->getUser());
            $history->setDoctors($doctor);
            $this->getDoctrine()->getManager()->persist($history);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('docOffice', ['infoline' => $this->get('translator')->trans('cotroller.new.pac')]));
        }

        return $this->render('User/DocOffice/createPacientHistory.html.twig',
            [
                'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/docAccount", name="docAccount")
     * @param  Request                                                                                       $request
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
     * @param  Request                                                                                       $request
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
            [
                'slug' => $slug,
                'form' => $form->createView(),
            ]);
    }
}
