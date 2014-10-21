<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 21/10/2014
 * Time: 16:30
 */

namespace Blog\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PostRepository extends EntityRepository
{
    const RESULTS_PER_PAGE = 5;

    public function findPostsOrderByDate($page = 0)
    {
        $query = $this->getEntityManager()
            ->getRepository('BlogBlogBundle:Post')
            ->createQueryBuilder('p')
            ->where('p.deleted = 0')
            ->orderBy('p.creationDate', 'DESC')
            ->setFirstResult($page * self::RESULTS_PER_PAGE)
            ->setMaxResults(self::RESULTS_PER_PAGE)
            ->getQuery();

        $paginator = new Paginator($query, false);

        return $paginator;
    }

    public function findPostDates()
    {
        $result_set_mapping = new ResultSetMapping();

        $result_set_mapping->addScalarResult('year', 'year');
        $result_set_mapping->addScalarResult('month', 'month');

        $query = $this->getEntityManager()
            ->createNativeQuery(
                'select month(p.creationDate) as month, year(p.creationDate) as year
                from Post p
                group by month, year
                order by p.creationDate desc',
                $result_set_mapping);

        return $query->getResult();
    }
} 