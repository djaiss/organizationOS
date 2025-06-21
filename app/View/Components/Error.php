<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Error extends Component
{
    public string $id;

    public string $for;

    public function __construct(string $for, public $value = null, public $bag = 'default')
    {
        $this->id = $for.'_error';
        $this->for = FormControl::sessionPath($for);
    }

    public function render()
    {
        return view('components.error');
    }
}
