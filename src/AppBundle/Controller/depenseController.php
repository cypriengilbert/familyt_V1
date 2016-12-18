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
    $depense = new Depense();
    $datetime = new \Datetime('now');
    $famille = $this->container->get('security.context')->getToken()->getUser()->getFamille()->first();
    $depense->setPar($famille);
    $depense->setdate($datetime);
    $form = $this->get('form.factory')->create('AppBundle\Form\DepenseType', $depense);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($depense);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
        return $this->redirect($this->generateUrl('gnet_platform_mesdepenses'));
        }
    return $this->render('AppBundle:Default:addDepense.html.twig', array(
        'form' =>$form->createView(),
        'famille' => $famille,
        ));
    }

public function mesdepensesAction()
{
      $famille = $this->container->get('security.context')->getToken()->getUser()->getFamille()->first()->getId();
      $famille_ent = $this->container->get('security.context')->getToken()->getUser()->getFamille()->first();
      $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Depense');
      $debit = $repository->FindDebit($famille);
      return $this->render('AppBundle:Default:depense.html.twig', array(
      'debit' => $debit,
      'famille_ent' => $famille_ent,
      'famille' => $famille
      ));
}

public function depensetotaleAction()
{
      $test = 0;
      $nb_partFS = 0;
      $nb_partOT = 0;
      $repository = $this->getDoctrine()->getManager()->getRepository('UserBundle:Famille');
      $famille = $repository->FindAll();
      $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Depense');
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
              }
            }
          }
          foreach($famille as $listefamille){
            foreach($debit as $listedepense){
              $pour = $listedepense->getPour();
              foreach($pour as $listePour){
                if($listePour == $listefamille){
                  if($listedepense->getType() =='remboursement'){
                  $key = $listefamille->getId();
                  $temp = $resultat[$listefamille->getNom()];
                  $temp = $temp - ($listedepense->getMontant()/(count($pour)));
                  $resultat[$listefamille->getNom()] = $temp;

                  }

                  if($listedepense->getType() =='moitie'){
                  $key = $listefamille->getId();
                  $temp = $resultat[$listefamille->getNom()];
                  $temp = $temp - $listedepense->getMontant()/(count($pour));
                  $resultat[$listefamille->getNom()] = $temp;

                  }
}
              }

                if ($listedepense->getType() == 'O&T' || $listedepense->getType() == 'F&S') {
                  if ($listefamille->getParticipe() == TRUE){
                  $nb_partOT = 0;
                  if($listedepense->getConcerne()->getId() != $listefamille->getId()){
                  foreach($listedepense->getPour() as $participant){
                    $nb_partOT = $nb_partOT + $participant->getCoef();
                    }
                $key = $listefamille->getId();
                $temp = $resultat[$listefamille->getNom()];
              if($nb_partOT != 0){$temp = $temp - $listedepense->getMontant()*($listefamille->getCoef()/$nb_partOT);}
                $resultat[$listefamille->getNom()] = $temp;
              }
                }}



              }
            }





  return $this->render('AppBundle:Default:depenseTotale.html.twig', array(
      'debit' => $debit,
      'famille' => $famille,
      'resultat' => $resultat,
      'test' => $nb_partOT
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
    $famille = $this->container->get('security.context')->getToken()->getUser()->getFamille()->first();
    if (null === $depense) {
      throw new NotFoundHttpException("Le commentaire d'id ".$id." n'existe pas.");
    }

      $form = $this->createForm(new DepenseType(), $depense);
      if ($form->handleRequest($request)->isValid()) {
      $em->flush();
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');
      return $this->redirect($this->generateUrl('gnet_platform_mesdepenses'));
    }
    return $this->render('AppBundle:Default:addDepense.html.twig', array(
      'form'   => $form->createView(),
      'famille' => $famille,
    ));

}

}
