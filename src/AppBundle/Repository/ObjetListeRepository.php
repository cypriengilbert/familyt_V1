<?php

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

/**
 * ObjetListeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ObjetListeRepository extends EntityRepository
{
	public function myFindAll($iduser)
	{
		// Méthode 1 : en passant par l'EntityManager
    $qb = $this->createQueryBuilder('a');
  	$qb
    ->where('a.User = :id')
    ->setParameter('id', $iduser)
  ;

  return $qb
    ->getQuery()
    ->getResult()
  ;
	}


  public function FindAllOther($user)
  {
    // Méthode 1 : en passant par l'EntityManager

    $qb = $this->createQueryBuilder('a');
    $qb
    ->where('a.User = :id')
		->andwhere('a.commun = false')
		->andwhere('a.communfamille = false')
    ->setParameter('id', $user)
  ;

  return $qb
    ->getQuery()
    ->getResult()
  ;
  }

    public function FamilleUserFindAll()
  {
    // Méthode 1 : en passant par l'EntityManager
    $qb = $this->createQueryBuilder('a');
    $qb
    ->leftJoin('a.famille', 'b')
  ;



  return $qb
    ->getQuery()
    ->getResult()
  ;
  }

	public function FindCommun($famille)
	{
		// Méthode 1 : en passant par l'EntityManager

		$qb = $this->createQueryBuilder('a');
		$qb
		->where('a.famille = :id')
		->andwhere('a.commun = true')
		->andwhere('a.communfamille = false')
		->setParameter('id', $famille)
	;

	return $qb
		->getQuery()
		->getResult()
	;
	}

	public function FindCommunFamille($famille)
	{
		// Méthode 1 : en passant par l'EntityManager

		$qb = $this->createQueryBuilder('a');
		$qb
		->where('a.famille = :id')
		->andwhere('a.commun = false')
		->andwhere('a.communfamille = true')
		->setParameter('id', $famille)
	;

	return $qb
		->getQuery()
		->getResult()
	;
	}


}
