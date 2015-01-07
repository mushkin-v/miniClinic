<?php

namespace AppBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
* Listener responsible to change the redirection at the end of the password resetting
*/
class RegistrationListener implements EventSubscriberInterface
{
    private $router;
    protected $requestStack;

    public function __construct(UrlGeneratorInterface $router, RequestStack $requestStack)
    {
        $this->router = $router;
        $this->requestStack = $requestStack;
    }

    /**
    * {@inheritDoc}
    */
    public static function getSubscribedEvents()
    {
        return array(
          FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationCompleted',
        );
    }

    public function onRegistrationCompleted(FormEvent $event)
    {
        $request = $this->requestStack->getCurrentRequest()->request->get('fos_user_registration_form');
        $url = isset($request['isDoctor'])? $this->router->generate('docRegister',array('slug'=>$request['username'])): $this->router->generate('pacientRegister');

        $event->setResponse(new RedirectResponse($url));
    }
}