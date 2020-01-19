<?php


namespace App\Jobs;

use Illuminate\Cache\Repository as CacheRepository;
use Psr\SimpleCache\InvalidArgumentException;

class Jobs
{

    /**
     * @var CacheRepository
     */
    private $cacheRepository;

    /**
     * Jobs constructor.
     * @param CacheRepository $cacheRepository
     */
    public function __construct(CacheRepository $cacheRepository)
    {
        $this->cacheRepository = $cacheRepository;
    }

    /**
     * @param $jobKey
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function getJobStatus($jobKey)
    {
        $cacheData = $this->cacheRepository->get($jobKey);

        if ($cacheData) {
            $this->cacheRepository->delete($jobKey);
        }

        return $cacheData;
    }

}
