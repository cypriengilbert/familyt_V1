<?php


namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\ObjetListe;
use AppBundle\Entity\Commentaire;
use UserBundle\Entity\User;
use AppBundle\Entity\Depense;
use Symfony\Component\Form\Forms;
use AppBundle\Entity\Task;
use UserBundle\Form\UserModifyType;
use AppBundle\Form\ObjetListeModifyType;
use AppBundle\Form\DepenseType;

use AppBundle\Form\DepenseModifyContentType;
use AppBundle\Form\ObjetListeModifyContentType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;





class depenseController extends Controller
{
    public function addDepenseAction(Request $request)
     {
     // Création de l'entité
    $depense = new Depense();
     $datetime = new \Datetime('now');
    $famille = $this->container->get('security.context')->getToken()->getUser()->getFamille()->first();
    $depense->setPar($famille);
    $depense->setdate($datetime);
    $form = $this->get('form.factory')->create('AppBundle\Form\DepenseType', $depense);


   
    

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // ... perform some action, such as saving the task to the database
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();

      


    // Étape 1 : On « persiste » l'entité
    $em->persist($depense);

    // Étape 2 : On « flush » tout ce qui a été persisté avant
    $em->flush();
    $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
      return $this->redirect($this->generateUrl('gnet_platform_mesdepenses'));

    }


    

    return $this->render('AppBundle:Default:addDepense.html.twig', array(
        'form' =>$form->createView(),

        ));
    }





public function mesdepensesAction()
{

  $famille = $this->container->get('security.context')->getToken()->getUser()->getFamille()->first();
      $repository = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('AppBundle:Depense');

        $debit = $repository->FindAllDebit($famille);




  return $this->render('AppBundle:Default:depense.html.twig', array(
      'debit' => $debit,
      'famille' => $famille
    ));
}

public function depensetotaleAction()
{

  
      $repository = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('UserBundle:Famille');
  $famille = $repository->FindAll();

        $repository = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('AppBundle:Depense');

        $debit = $repository->FindAll();
        $resultat = array();
          foreach ($famille as $listefamille) {
            $resultat[$listefamille->getNom()] = 0;
          }

          foreach($famille as $listefamille){
            foreach($debit as $listedepense){
              if($listedepense->getPar()->getId() == $listefamille->getId()){
                $key = $listefamille->getId();
                $temp = $resultat[$listefamille->getNom()];
                $temp = $temp + $listedepense->getMontant();
                $resultat[$listefamille->getNom()] = $temp;


                if($listedepense->getType() == 'moitie'){
                $key = $listefamille->getId();
                $temp = $resultat[$listefamille->getNom()];
                $temp = $temp - $listedepense->getMontant()*$listefamille->getCoef2();
                $resultat[$listefamille->getNom()] = $temp;
                }
              }
              
            }
          }

          foreach($famille as $listefamille){
            foreach($debit as $listedepense){
              if($listedepense->getPour()->getId() == $listefamille->getId()){
                if($listedepense->getType() =='remboursement'){


                $key = $listefamille->getId();
                $temp = $resultat[$listefamille->getNom()];
                $temp = $temp - $listedepense->getMontant()*$listefamille->getCoefRemb();
                $resultat[$listefamille->getNom()] = $temp;

                }

                if($listedepense->getType() =='moitie'){
                $key = $listefamille->getId();
                $temp = $resultat[$listefamille->getNom()];
                $temp = $temp - $listedepense->getMontant()*$listefamille->getCoef2();
                $resultat[$listefamille->getNom()] = $temp;

                }
                
              }


               if($listedepense->getPour()->getId() == 10){
                if ($listedepense->getType() == 'O&T') {
                  if($listedepense->getConcerne()->getId() != $listefamille->getId()){
                $key = $listefamille->getId();
                $temp = $resultat[$listefamille->getNom()];
                $temp = $temp - $listedepense->getMontant()*$listefamille->getCoefOetT();
                $resultat[$listefamille->getNom()] = $temp;

              }
                }
                if ($listedepense->getType() == 'F&S') {
                 $key = $listefamille->getId();
                $temp = $resultat[$listefamille->getNom()];
                $temp = $temp - $listedepense->getMontant()*$listefamille->getCoef();
                $resultat[$listefamille->getNom()] = $temp;
                }

                
              }
            }
          }




  return $this->render('AppBundle:Default:depenseTotale.html.twig', array(
      'debit' => $debit,
      'famille' => $famille,
      'resultat' => $resultat
    ));

}











   public function deleteDepenseAction(Request $request, $id)
      {
       $em = $this->getDoctrine()->getManager();

    // On récupère l'annonce $id
    $depense = $em->getRepository('AppBundle:Depense')->find($id);

    if (null === $depense) {
      throw new NotFoundHttpException("La dépense n'existe pas.");
    }


    $em->remove($depense);

    
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien supprimée.');

      return $this->redirect($this->generateUrl('gnet_platform_mesdepenses'));
   

    
    }


public function editDepenseAction(Request $request, $id)
  {
     $em = $this->getDoctrine()->getManager();

    // On récupère l'annonce $id
    $depense = $em->getRepository('AppBundle:Depense')->find($id);

    if (null === $depense) {
      throw new NotFoundHttpException("Le commentaire d'id ".$id." n'existe pas.");
    }

    $form = $this->createForm(new DepenseModifyContentType(), $depense);

    if ($form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

      return $this->redirect($this->generateUrl('gnet_platform_mesdepenses'));
    }
    return $this->render('AppBundle:Default:editDepense.html.twig', array(
      'form'   => $form->createView(),
    ));

}

}