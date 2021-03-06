<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Doctor;
use AppBundle\Entity\Pacient;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ServicesController extends Controller
{
    /**
     * @Route("/sendEmail", name="sendEmail")
     * @param  Request                                            $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function sendEmailAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $name = $request->request->get('name');
            $email = $request->request->get('description');
            $phone = $request->request->get('name');
            $message = $request->request->get('name');
            $this->get('vitmail')->Send(
                'This letter from'.$name.' my phone number '.$phone,
                $email,
                $this->getDoctrine()->getManager()->getRepository('AppBundle:User')
                    ->findOneByusername('admin')->getEmail(),
                $message
            );
        }

        return $this->redirect($this->generateUrl('contact', ['infoline' => $this->get('translator')->trans('email.send')]));
    }

    /**
     * @Route("/recordPacientToDoc", name="recordPacientToDoc")
     * @param  Request                                            $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function recordPacientToDocAction(Request $request)
    {
        $infoline = $this->get('translator')->trans('rec.no');
        if ($request->isMethod('POST')) {
            $docTime = $request->request->get('time');

            $user = $this->getUser()->getIsDoctor() ?
                $this->getDoctrine()->getManager()->getRepository('AppBundle:Doctor')->findOneByuser($this->getUser()) :
                $this->getDoctrine()->getManager()->getRepository('AppBundle:Pacient')->findOneByuser($this->getUser());
            $time = $this->getDoctrine()->getManager()->getRepository('AppBundle:AppointmentTime')->find($docTime);
            $time->setPacient($user);
            $user->addAppointmentTime($time);
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->persist($time);
            $this->getDoctrine()->getManager()->flush();

            $fromTime = $time->getFromTime()->format('H:i');
            $toTime =  $time->getToTime()->format('H:i');

            $infoline = $this->get('translator')->trans('rec1').' '.$fromTime.' '.$this->get('translator')->trans('rec2').' '.$toTime.'! '.$this->get('translator')->trans('rec3').' '.$user->getName().' '.$user->getLastName().'!';
        }

        return $this->redirect($this->generateUrl('Appointments', ['infoline' => $infoline]));
    }

    /**
     * @Route("/unRecordPacientToDoc", name="unRecordPacientToDoc")
     * @param  Request                                            $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function unRecordPacientToDocAction(Request $request)
    {
        $infoline = $this->get('translator')->trans('unrec.no', array(), 'messages');

        if ($request->isMethod('POST')) {
            $docTime = $request->request->get('time');
            $user = $this->getUser()->getIsDoctor() ?
                $this->getDoctrine()->getManager()->getRepository('AppBundle:Doctor')->findOneByuser($this->getUser()) :
                $this->getDoctrine()->getManager()->getRepository('AppBundle:Pacient')->findOneByuser($this->getUser());
            $time = $this->getDoctrine()->getManager()->getRepository('AppBundle:AppointmentTime')->find($docTime);
            $user->removeAppointmentTime($time);
            $time->removePacient();
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->persist($time);
            $this->getDoctrine()->getManager()->flush();

            $infoline = $this->get('translator')->trans('unrec', array(), 'messages').' '.$user->getName().' '.$user->getLastName().'!';
        }

        return $this->redirect($this->generateUrl('Appointments', ['infoline' => $infoline]));
    }
}
