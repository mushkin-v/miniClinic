<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/setLocale/{loc}", name="setLocale", defaults={"loc" = "en"})
     */

    public function setLocaleAction($loc)
    {
        $this->get('request')->setLocale($loc);

        return $this->redirect($this->generateUrl('homepage', array('_locale' => $loc)));
    }
    /**
     * @Route("/{_locale}", name="homepage", defaults={"_locale": "en"}, requirements={"_locale": "en|uk"})
     */
    public function indexAction(Request $request)
    {
        $locale = $request->getLocale();

        return $this->getUser() == true ?
            $this->render('default/index.html.twig') :
            $this->redirect($this->generateUrl('fos_user_security_login'))
            ;
    }

    /**
     * @Route("/Appointments/{infoline}", name="Appointments", defaults={"infoline" = null})
     * @param $infoline
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function AppointmentsAction($infoline)
    {
        return $this->render(
            'default/Appointments.html.twig',
            array(
                'pacient' => $this->getDoctrine()->getManager()->getRepository('AppBundle:Pacient')->findOneByuser($this->getUser()),
                'appointments' => $this->getDoctrine()->getManager()->getRepository('AppBundle:Appointment')->findAll(),
                'infoline' => $infoline,
            ));
    }

    /**
     * @Route("/personal", name="personal")
     */
    public function personalAction()
    {
        return $this->render('default/personal.html.twig', [
            'doctors' => $this->getDoctrine()->getManager()->getRepository('AppBundle:Doctor')->findAll()
        ]);
    }

    /**
     * @Route("/contact/{infoline}", name="contact", defaults={"infoline" = null})
     * @param $infoline
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction($infoline)
    {
        return $this->render('default/contact.html.twig', array('infoline' => $infoline));
    }

    /**
     * @Route("/services", name="services")
     */
    public function servicesAction()
    {
        return $this->render('default/services.html.twig');
    }

    /**
     * @Route("/adminPanel", name="adminPanel")
     * @Security("has_role('ROLE_SUPER_ADMIN') and is_granted('ROLE_SUPER_ADMIN')")
     */
    public function adminPanelAction()
    {
        return $this->render('default/adminPanel.html.twig');
    }
}
