<?php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
//включаем поддержку мершрутов над классами
use Symfony\Component\Routing\Annotation\Route;
//включаем поддержку шаблонов
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//включаем логирование
use Psr\Log\LoggerInterface;
//добавляем свой класс для связи с базой
use App\Entity\Playgrounds;



class DefaultController extends AbstractController
{
	

/**
  * @Route("/")
  */
    public function index(LoggerInterface $logger)
    {		
	return $this->render('index.html.twig');
	$logger->info("Saying hello");
    }

/**
 * @Route("/map/{coor}")
 */
 public function map($coor, LoggerInterface $logger)
    {	
	$coor=trim($coor, "()");
	$YX=explode(", ", $coor);

   $playgrounds = $this->getDoctrine()
        ->getRepository(Playgrounds::class)
        ->Point($YX[1], $YX[0]);
    
    if (!$playgrounds) {
        $logger->info(
            'No playground found'
        );
    }
   
    $response = new Response();
	//$response->headers->set('Content-Type', 'text/xml');
	
    return $this->render('base.html.twig', ['playgrounds' => $playgrounds], $response); 
    

		
    }

}

?>
