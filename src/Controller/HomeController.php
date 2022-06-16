<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EtudiantRepository $etrepo,ChartBuilderInterface $chartBuilder): Response
    {
        $totalF = $etrepo->studentBySex("F")[0]['count'];
        $totalM = $etrepo->studentBySex("M")[0]['count'];
        $total = $totalF + $totalM;
        $mpourc = (($totalM/$total)*100)."%";
        $fpourc = (($totalF/$total)*100)."%";

        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);

        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'total' => $total,
            'totalF' => $totalF,
            'totalM' => $totalM,
            'mpourc' => $mpourc,
            'fpourc' => $fpourc,
            'chart' => $chart,
        ]);
    }
}
