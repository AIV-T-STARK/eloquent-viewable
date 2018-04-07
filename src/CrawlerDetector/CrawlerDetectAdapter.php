<?php

declare(strict_types=1);

/*
 * This file is part of Eloquent Viewable.
 *
 * (c) Cyril de Wit <github@cyrildewit.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyrildeWit\EloquentViewable\CrawlerDetector;

use Jaybizzle\CrawlerDetect\CrawlerDetect;
use CyrildeWit\EloquentViewable\Contracts\CrawlerDetector\Detector;

/**
 * Class CrawlerDetectAdapter.
 *
 * @author Cyril de Wit <github@cyrildewit.nl>
 */
class CrawlerDetectAdapter implements Detector
{
    /**
     * CrawlerDetect instance.
     *
     * @var \Jaybizzle\CrawlerDetect\CrawlerDetect
     */
    protected $detector;

    /**
     * Create a new CrawlerDetector instance.
     *
     * @param  \Jaybizzle\CrawlerDetect\CrawlerDetect  $detector
     * @return void
     */
    public function __construct(CrawlerDetect $detector)
    {
        $this->detector = $detector;
    }

    /**
     * Determine if the current user is crawler.
     *
     * @return bool
     */
    public function isBot()
    {
        return $this->detector->isCrawler();
    }
}
