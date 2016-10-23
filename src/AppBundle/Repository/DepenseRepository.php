<?php

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;

/**
 * DepenseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DepenseRepository extends \Doctrine\ORM\EntityRepository
{

	public function FindAllDebit($id)
	{
		// Méthode 1 : en passant par l'EntityManager
    $qb = $this->createQueryBuilder('a');
  	$qb
    ->where('a.par = :id')
    ->orWhere('a.pour = :idTlm')
    ->orWhere('a.pour = :id')
    ->setParameter('id', $id)
    ->setParameter('idTlm', 10)
  ;

  return $qb
    ->getQuery()
    ->getResult()
  ;
	}

}