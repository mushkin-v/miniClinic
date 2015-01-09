<?php

namespace AppBundle\Twig;

class testTwigExt extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('show_help', array($this, 'ShowHelpFilter')),
        );
    }
    public function ShowHelpFilter($name)
    {
        $vit = mb_convert_case($name, MB_CASE_UPPER, "UTF-8").
            nl2br("
            To login as admin use - login: admin pass: admin. You can create new doctor only in admin panel.
            To login as pacient use - login: user pass: user. Or just create new user. To login as doctor use - login: doctor pass: doctor. Or just create new doctor in Admin Panel."
            );

        return $vit;
    }

    public function getName()
    {
        return 'testTwigExt';
    }
}
