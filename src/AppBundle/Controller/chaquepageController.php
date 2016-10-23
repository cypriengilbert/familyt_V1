<?php


namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\ObjetListe;
use AppBundle\Entity\Commentaire;
use UserBundle\Entity\User;
use Symfony\Component\Form\Forms;
use AppBundle\Entity\Task;
use AppBundle\Form\ObjetListeModifyType;
use AppBundle\Form\ObjetListeModifyContentType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\Query\ResultSetMapping;





class chaquepageController extends Controller
{
    public function userandfamilleAction(){
      $repository = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('UserBundle:User');

        $User = $repository->findAll();
    
        
        $repository = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('UserBundle:Famille')
;

$listefamille = $repository->FindAll();



  // Méthode 1 : en passant par l'EntityManager


$em = $this->container->get('doctrine')->getManager();
$repository = $em->getRepository('UserBundle:User');
$query = $repository->createQueryBuilder('u')
    ->select('u.username')
    ->addSelect('u.id')
    ->join('u.famille', 'f')->addSelect('f.nom')

    //->where('.id = :group_id')
    //->setParameter('group_id', 5)
    ->getQuery()->getResult();



return $this->render('AppBundle:Default:layoutListe.html.twig', array(
      'famille' => $listefamille, 
      'listenom' => $User,
      'jointure' => $query
    ));
}
   
}