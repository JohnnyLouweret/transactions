<?php

namespace App\Repository;

use App\Entity\Country;
use App\Entity\User;
use App\Entity\UserDetail;
use App\Object\Collection\UserCollection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param Country $country
     *
     * @return UserCollection
     */
    public function findActiveByCountry(Country $country): UserCollection
    {
        $result =  $this->createQueryBuilder('u')
            ->where('u.active = :active')
            ->innerJoin('u.details', 'ud')
            ->andWhere('ud.citizenshipCountry = :country')
            ->setParameters([
                'active' => true,
                'country' => $country
            ])
            ->orderBy('u.id', 'ASC')
            ->getQuery()
            ->getResult();

        return new UserCollection($result);
    }

    /**
     * @throws Exception
     */
    public function delete(User $user): void
    {
        if ($user->getDetails() instanceof UserDetail) {
            throw new Exception('User has UserDetails.');
        }

        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();
    }
}
