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
	public function FindDebit($id)
	{

	$qb1 = $this->createQueryBuilder('a');
	$qb1
	->leftJoin('a.pour', 'b')
	->where('a.par = :id')
	->orwhere('b = :id')
	->setParameter('id', $id)
	;
	return $qb1
		->getQuery()
		->getResult();

}
}
