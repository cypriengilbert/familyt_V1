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
use UserBundle\Form\UserModifyType;
use AppBundle\Form\ObjetListeModifyType;
use AppBundle\Form\ObjetListeModifyContentType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;





class compteController extends Controller
{
    public function voirCompteAction()
    {
        $id_user = $this->container->get('security.context')->getToken()->getUser()->getId();
        
    	$repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('UserBundle:User')
;



$listUser = $repository->findOneBy(array('id' => $id_user));

return $this->render('AppBundle:Default:compte.html.twig', array(
      'User' => $listUser
    ));
    }

  public function editCompteAction(Request $request)
  {

    $em = $this->getDoctrine()->getManager();

    $user = $this->container->get('security.context')->getToken()->getUser();



   
    $form = $this->createForm(new UserModifyType(), $user);

    if ($form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

      return $this->redirect($this->generateUrl('gnet_platform_moncompte'));
    }
    return $this->render('AppBundle:Default:editcompte.html.twig', array(
      'form'   => $form->createView(),
    ));

}
















    public function voirautreCompteAction()
    {
          $repository = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('UserBundle:User');

        $User = $repository->FindAll();
    
      


return $this->render('AppBundle:Default:annuaire.html.twig', array(
      'UserListe' => $User
    ));
    }



}