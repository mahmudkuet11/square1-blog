<?php

namespace App\View\Components\Table;

use Illuminate\View\Component;

class Sort extends Component
{
    /**
     * Column heading
     * @var string
     */
    public $title;

    /**
     * Sort key
     * @var string
     */
    public $key;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $key)
    {
        $this->title = $title;
        $this->key = $key;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table.sort');
    }

    public function sortIconClass()
    {
        if(request()->get('sort') !== $this->key){
            return 'sort-inactive';
        }

        return "sort-" . request()->get('sort-dir', 'desc');
    }

    public function url()
    {
        $dir = request()->get('sort-dir', 'desc');
        $dir = $dir === 'asc' ? 'desc' : 'asc';
        return url()->current() . "?sort={$this->key}&sort-dir=$dir";
    }
}
