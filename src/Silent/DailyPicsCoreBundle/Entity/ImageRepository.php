<?php

namespace Silent\DailyPicsCoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ImageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */

class ImageRepository extends EntityRepository
{
    // This set the APC cache time to minimize query on high traffic website :)
    const cacheTime = 300;

    public function getBaseListForKnpPaginator($now)
    {
        $query = $this->_em->createQuery("SELECT i, k, c
                                          FROM SilentDailyPicsCoreBundle:Image i
                                          JOIN i.seoKeywords k
                                          JOIN i.categories c
                                          WHERE i.publishDate <= :now
                                          ORDER BY i.publishDate DESC ");

        $query->setParameter(":now", $now);

        $query->useResultCache(true, self::cacheTime);

        return $query;
    }

    public function getOneImage($lsug,$now)
    {
        $query = $this->_em->createQuery("SELECT i, c, k
                                          FROM SilentDailyPicsCoreBundle:Image i
                                          JOIN i.seoKeywords k
                                          JOIN i.categories c
                                          WHERE i.slug = :slug
                                          AND i.publishDate <= :now ");

        $query->setParameter(":slug", $lsug);
        $query->setParameter(":now", $now);

        $query->useResultCache(true, self::cacheTime);

        return $query->getSingleResult();
    }

    public function getPreviousImage($current, $now)
    {
        $query = $this->_em->createQuery("SELECT i
                                         FROM SilentDailyPicsCoreBundle:Image i
                                         WHERE i.publishDate > :currentImageDate
                                         AND i.publishDate <= :now
                                         ORDER BY i.publishDate ASC");

        $query->setParameter(":currentImageDate", $current->getPublishDate());
        $query->setParameter(":now",$now);

        $query->setMaxResults(1);
        $query->useResultCache(true, self::cacheTime);

        $result = $query->getResult();
        //We don't use getSingleResult cause the request can return nothing, with getSingleResult app can crash
        if (isset($result[0]))
            return $result[0];
        else
            return null;

    }

    public function getNextImage($current, $now)
    {
        $query = $this->_em->createQuery("SELECT i
                                         FROM SilentDailyPicsCoreBundle:Image i
                                         WHERE i.publishDate < :currentImageDate
                                         AND i.publishDate <= :now
                                         ORDER BY i.publishDate DESC");

        $query->setParameter(":currentImageDate", $current->getPublishDate());
        $query->setParameter(":now",$now);

        $query->setMaxResults(1);
        $query->useResultCache(true, self::cacheTime);

        $result = $query->getResult();
        //We don't use getSingleResult cause the request can return nothing, with getSingleResult app can crash
        if (isset($result[0]))
            return $result[0];
        else
            return null;

    }

    public function findAllWithDelimiter($now)
    {
        return $this->getBaseListForKnpPaginator($now)->getResult();
    }

    /*
    public function getLastId($cache, $now)
    {
        $query = $this->_em->createQuery('SELECT i.id AS idCount FROM SilentDailyPicsCoreBundle:Image i WHERE i.publishDate <= :now ORDER BY i.id DESC');
        $query->setParameter(':now', $now);
        $query->setMaxResults(1);

        if ($cache)
            $query->useResultCache(true, self::cacheTime);

        $result = $query->getArrayResult();
        if (isset($result[0]["idCoubnt"]))
            return $result[0]["idCoubnt"];
        else
            return 0;

    }
    */

}
