<?php

namespace Cyrildewit\PageViewCounter\Models;

use Illuminate\Database\Eloquent\Model;
use Cyrildewit\PageViewCounter\Contracts\PageView as PageViewContract;

class PageView extends Model implements PageViewContract
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Constructor function of the PageVisit model.
     *
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('page-view-counter.page_views_table_name', 'page-views'));
    }
}
