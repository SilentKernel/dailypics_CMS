<?php
/*
 * This file provide some method acessible to the rest of the APP
 */

namespace Silent\DailyPicsCoreBundle\Services;

class DailyPicsUtils
{
    // This should be in parameters.yml
    const cacheTime = 300;
    // this should use "secret" or an other unique key to prevent bug if more than one instance is hosted on the same server
    const currentTimeAPCConst = "dp_current_time";
    const randomPicsAPCConst = "dp_random_pics";

    private $ct;
    private $cacheAPC;

    public function __construct($ct)
    {
        $this->ct = $ct;
        $this->cacheAPC = $this->ct->get('cache_APC');
    }

    // Keep time in cache for 300 seconds (same time as query cache)
    public function getCurrentCachedTime()
    {
        if (!$now = $this->cacheAPC->fetch(self::currentTimeAPCConst))
        {
            $now = new \DateTime('now');
            $this->cacheAPC->save(self::currentTimeAPCConst, $now, self::cacheTime);
        }
        return $now;
    }

    // this is not really proper, will make it better later
    public function getRandomPics($number)
    {
        if (!$randomPics = $this->cacheAPC->fetch(self::randomPicsAPCConst))
        {
            $images = $this->ct->get('doctrine')
                ->getManager()
                ->getRepository("SilentDailyPicsCoreBundle:Image")
                ->findAllWithDelimiter($this->getCurrentCachedTime());

            // only if we have enougth pics to show ...
            if (isset($images[$number-1]))
            {
                shuffle($images);
                $randomPics = array_slice($images, 0, $number);
            }
            else
                $randomPics = null;

            // Keep it in cache for 30 seconds... don't regenerate it every time page load
            $this->cacheAPC->save(self::randomPicsAPCConst, $randomPics, (self::cacheTime/60) );
        }
        return $randomPics;
    }
} 
