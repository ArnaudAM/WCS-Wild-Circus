<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="app_index")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/about-us", name="about_us")
     */
    public function aboutUs()
    {
        return $this->render('about_us.html.twig');
    }

    /**
     * @Route("/prices", name="prices")
     */
    public function prices()
    {
        return $this->render('prices.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('contact.html.twig');
    }
}