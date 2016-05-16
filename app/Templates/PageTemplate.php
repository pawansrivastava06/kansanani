<?php

namespace SundaySim\Templates;

use Carbon\Carbon;
use SundaySim\Page;
use Illuminate\View\View;

class PageTemplate extends AbstractTemplate
{
    protected $view = '';

    protected $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function prepare(View $view, array $parameters)
    {
        $posts = $this->pages->get();

        $view->with('posts', $posts);
    }
}
