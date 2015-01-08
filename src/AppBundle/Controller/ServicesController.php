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


class ServicesController extends Controller
{
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
        return $this->redirect($this->generateUrl('contact',['infoline'=>'Your message have been send! Thank you!']));
    }
}
