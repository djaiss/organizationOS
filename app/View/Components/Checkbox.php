<?php

namespace App\View\Components;

class Checkbox extends FormControl
{
    public bool $checked;

    public function __construct(string $name, string $id = null, string $value = '1', string $label = '', string $bag = 'default')
    {
        parent::__construct($name, $id, $value, $label, $bag);
        $this->value = $value;
    }

    public function render()
    {
        return view('components.checkbox');
    }
}
