<?php


namespace App\Controller;

use App\Entity\Performance;
use App\Repository\AboutUsRepository;
use App\Repository\PerformanceRepository;
use App\Repository\PriceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @param PerformanceRepository $performanceRepository
     * @Route("/", name="index", methods={"GET"})
     * @return Response
     */
    public function index(PerformanceRepository $performanceRepository): Response
    {
        return $this->render('index.html.twig', [
            'performances' => $performanceRepository->findAll(),
        ]);
    }

    /**
     * @param AboutUsRepository $aboutUsRepository
     * @Route("/about-us", name="about_us")
     * @return Response
     */
    public function aboutUs(AboutUsRepository $aboutUsRepository): Response
    {
        return $this->render('about_us.html.twig',
            ['aboutus' => $aboutUsRepository->findAll(),
            ]);
    }

    /**
     * @param PriceRepository $priceRepository
     * @Route("/prices", name="prices")
     * @return Response
     */
    public function prices(PriceRepository $priceRepository): Response
    {
        return $this->render('prices.html.twig',
            ['prices' => $priceRepository->findAll(),
            ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('contact.html.twig');
    }
}