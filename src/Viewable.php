<?php

declare(strict_types=1);

/*
 * This file is part of the Eloquent Viewable package.
 *
 * (c) Cyril de Wit <github@cyrildewit.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyrildeWit\EloquentViewable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use CyrildeWit\EloquentViewable\Contracts\View as ViewContract;
use CyrildeWit\EloquentViewable\Contracts\ViewableService as ViewableServiceContract;

/**
 * Trait Viewable.
 *
 * @author Cyril de Wit <github@cyrildewit.nl>
 */
trait Viewable
{
    /**
     * Boot the Viewable trait for a model.
     *
     * @return void
     */
    public static function bootViewable()
    {
        static::observe(ViewableObserver::class);
    }

    /**
     * Get a collection of all the views the model has.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function views(): MorphMany
    {
        return $this->morphMany(app(ViewContract::class), 'viewable');
    }

    /**
     * Get the total number of views.
     *
     * @param  \CyrildeWit\EloquentViewable\Support\Period
     * @return int
     */
    public function getViews($period = null): int
    {
        return app(ViewableServiceContract::class)
            ->getViewsCount($this, $period);
    }

    /**
     * Get the total number of unique views.
     *
     * @param  \CyrildeWit\EloquentViewable\Support\Period
     * @return int
     */
    public function getUniqueViews($period = null) : int
    {
        return app(ViewableServiceContract::class)
            ->getUniqueViewsCount($this, $period);
    }

    /**
     * Store a new view.
     *
     * @return bool
     */
    public function addView(): bool
    {
        return app(ViewableServiceContract::class)->addViewTo($this);
    }

    /**
     * Store a new view with an expiry date.
     *
     * @param  \DateTime  $expiresAt
     * @return bool
     */
    public function addViewWithExpiryDate($expiresAt): bool
    {
        return app(ViewableServiceContract::class)->addViewWithExpiryDateTo($this, $expiresAt);
    }

    /**
     * Retrieve records sorted by views.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByViews(Builder $query, string $direction = 'desc'): Builder
    {
        return app(ViewableServiceContract::class)->applyScopeOrderByViewsCount($query, $direction);
    }

    /**
     * Retrieve records sorted by unqiue views.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByUniqueViews(Builder $query, string $direction = 'desc'): Builder
    {
        return app(ViewableServiceContract::class)->applyScopeOrderByViewsCount($query, $direction, true);
    }
}
