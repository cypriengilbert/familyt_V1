<?php


namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\ObjetListe;
use UserBundle\Entity\Famille;
use AppBundle\Entity\Commentaire;
use AppBundle\Entity\Depense;

use UserBundle\Entity\User;
use Symfony\Component\Form\Forms;
use AppBundle\Entity\Task;
use AppBundle\Form\ObjetListeModifyType;
use AppBundle\Form\ObjetListeModifyContentType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;





class malisteController extends Controller
{
    public function malisteAction()
    {
        $id_user = $this->container->get('security.context')->getToken()->getUser();

    	$repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('AppBundle:ObjetListe')
;



$listListe = $repository->myFindAll($id_user);







return $this->render('AppBundle:Default:maliste.html.twig', array(
      'Liste' => $listListe
    ));
    }

    public function autreListeAction(Request $request, $id)
    {
          $repository = $this->getDoctrine()->getManager()->getRepository('UserBundle:User');
          $User = $repository->findOneBy(array('id' => $id));
          $idfamille = $User->getFamille()->first();
          $famille1 = $repository->FindFamille($idfamille);

          $repository = $this->getDoctrine()->getManager()->getRepository('UserBundle:Famille');
          $listefamille = $repository->findAll();

        $repository = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('AppBundle:ObjetListe')
;

$listListe = $repository->FindAllOther($User);

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
  return $this->redirect($this->generateUrl('gnet_platform_rendreIndispo', array('id' => $depense->getIdsouhait())));
    }

return $this->render('AppBundle:Default:autreListe.html.twig', array(
      'Liste' => $listListe,
      'User' => $User,
      'famille' => $famille,
      'famille1' => $famille1,
      'listefamille' => $listefamille,
      'page' => 'unique',
      'f' => $idfamille,
      'form' => $form->createView()
    ));
    }


    public function listeFamilleAction(Request $request,$id)
    {
          $repository = $this->getDoctrine()->getManager()->getRepository('UserBundle:User');
          $User = $repository->findOneBy(array('id' => $id));
          $idfamille = $User->getFamille()->first();
          $famille1 = $repository->FindFamille($idfamille);
          $repository = $this->getDoctrine()->getManager()->getRepository('UserBundle:Famille');
          $listefamille = $repository->findAll();

        $repository = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('AppBundle:ObjetListe')
  ;

  $listListe = $repository->FindCommunFamille($idfamille);
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
    return $this->redirect($this->generateUrl('gnet_platform_rendreIndispo', array('id' => $depense->getIdsouhait())));
      }

  return $this->render('AppBundle:Default:autreListe.html.twig', array(
      'Liste' => $listListe,
      'User' => $User,
      'famille' => $famille,
      'famille1' => $famille1,
'listefamille' => $listefamille,
      'page' => 'famille',
      'f' => $idfamille,
      'form' => $form->createView()

    ));
    }


    public function listeCoupleAction(Request $request, $id)
    {
          $repository = $this->getDoctrine()->getManager()->getRepository('UserBundle:User');
          $User = $repository->findOneBy(array('id' => $id));
          $idfamille = $User->getFamille()->first();
          $famille1 = $repository->FindFamille($idfamille);
          $repository = $this->getDoctrine()->getManager()->getRepository('UserBundle:Famille');
          $listefamille = $repository->findAll();

        $repository = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('AppBundle:ObjetListe');
  $listListe = $repository->FindCommun($idfamille);
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
    return $this->redirect($this->generateUrl('gnet_platform_rendreIndispo', array('id' => $depense->getIdsouhait())));
      }


  return $this->render('AppBundle:Default:autreListe.html.twig', array(
      'Liste' => $listListe,
      'User' => $User,
      'famille' => $famille,
      'famille1' => $famille1,
'listefamille' => $listefamille,
      'page' => 'couple',
      'f' => $idfamille,
      'form' => $form->createView()
    ));
    }

    public function allListeAction()
    {
          $repository = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('UserBundle:Famille');
        $famille = $repository->findAll();



  return $this->render('AppBundle:Default:allListe.html.twig', array(
      'famille' => $famille
    ));
    }



public function changeCommentAction(Request $request, $id)
    {
     $em = $this->getDoctrine()->getManager();

    // On récupère l'annonce $id
    $Objet = $em->getRepository('AppBundle:ObjetListe')->find($id);

    if (null === $Objet) {
      throw new NotFoundHttpException("Le commentaire d'id ".$id." n'existe pas.");
    }


    $form = $this->createForm(new ObjetListeModifyType(), $Objet);

    if ($form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

      return $this->redirect($this->generateUrl('gnet_platform_autreListe', array('id' => $Objet->getUser()->getId())));
    }

    return $this->render('AppBundle:Default:editComment.html.twig', array(
      'form'   => $form->createView(),
    ));
    }

    public function indispoAction(Request $request, $id)
    {
     $em = $this->getDoctrine()->getManager();

    // On récupère l'annonce $id
    $Objet = $em->getRepository('AppBundle:ObjetListe')->find($id);

    if (null === $Objet) {
      throw new NotFoundHttpException("Le commentaire d'id ".$id." n'existe pas.");
    }


    $Objet->setPris('1');


      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

      return $this->redirect($this->generateUrl('gnet_platform_autreListe', array('id' => $Objet->getUser()->getId())));



    }

     public function dispoAction(Request $request, $id)
    {
     $em = $this->getDoctrine()->getManager();
    $Objet = $em->getRepository('AppBundle:ObjetListe')->find($id);
    if (null === $Objet) {
      throw new NotFoundHttpException("Le commentaire d'id ".$id." n'existe pas.");
    }
    $Objet->setPris('0');
      $em->flush();
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');
      return $this->redirect($this->generateUrl('gnet_platform_autreListe', array('id' => $Objet->getUser()->getId())));



    }



    public function addListeAction(Request $request)
    {
     // Création de l'entité
    $objetliste = new ObjetListe();
    $id_user = $this->container->get('security.context')->getToken()->getUser();
    $datetime = date("Y");
    $objetliste->setPris('0');
    $idfamille = $id_user->getFamille()->first();
    $objetliste->setFamille($idfamille);
    $objetliste->setannee($datetime);
    $form = $this->get('form.factory')->create('AppBundle\Form\ObjetListeType', $objetliste,array('idfamille' => $idfamille->getId()) );
    $form->handleRequest($request);
if($objetliste->getUser() == null){
$objetliste->setUser($id_user);
}
    if ($form->isSubmitted() && $form->isValid()) {

    $em = $this->getDoctrine()->getManager();

    $em->persist($objetliste);
    $em->flush();
    $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
      return $this->redirect($this->generateUrl('gnet_platform_view', array('id' => $objetliste->getId())));

    }




    return $this->render('AppBundle:Default:addListe.html.twig', array(
        'form' =>$form->createView(),

        ));
    }

    public function deleteListeAction(Request $request, $id)
	    {
	     $em = $this->getDoctrine()->getManager();

    // On récupère l'annonce $id
    $Objet = $em->getRepository('AppBundle:ObjetListe')->find($id);

    if (null === $Objet) {
      throw new NotFoundHttpException("Le commentaire d'id ".$id." n'existe pas.");
    }


    $em->remove($Objet);


      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien supprimée.');

      return $this->redirect($this->generateUrl('gnet_platform_view'));



    }

	public function editListeAction(Request $request, $id)
  {
     $em = $this->getDoctrine()->getManager();

    // On récupère l'annonce $id
    $Objet = $em->getRepository('AppBundle:ObjetListe')->find($id);

    if (null === $Objet) {
      throw new NotFoundHttpException("Le commentaire d'id ".$id." n'existe pas.");
    }

    $form = $this->createForm(new ObjetListeModifyContentType(), $Objet);

    if ($form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

      return $this->redirect($this->generateUrl('gnet_platform_view'));
    }
    return $this->render('AppBundle:Default:editListe.html.twig', array(
      'form'   => $form->createView(),
    ));

}

}
