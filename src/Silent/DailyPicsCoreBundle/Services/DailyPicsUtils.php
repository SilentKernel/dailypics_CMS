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

    private $ct;

    public function __construct($ct)
    {
        $this->ct = $ct;
    }

    // Keep time in cache for 300 seconds (same time as query cache)
    public function getCurrentCachedTime()
    {
        $cacheAPC = $this->ct->get('cache_APC');
        if (!$now = $cacheAPC->fetch(self::currentTimeAPCConst))
        {
            $now = new \DateTime('now');
            $cacheAPC->save(self::currentTimeAPCConst, $now, self::cacheTime);
        }
        return $now;
    }
} 