<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 17/10/2014
 * Time: 10:57
 */

namespace Blog\BlogBundle\Entity;


use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{

    public function findPostsOrderByDate($user_id)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT p.title, p.content, p.deleted, p.creationDate
                    FROM BlogBlogBundle:Post p
                    WHERE p.user = :user_id
                    ORDER by p.creationDate'
            )
            ->setParameter('user_id', $user_id);

        return $query->getArrayResult();
    }

} 