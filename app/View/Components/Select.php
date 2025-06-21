<?php

namespace App\View\Components;

class Select extends FormControl
{
    public $options;

    public function __construct($name, $id = null, $value = '', $label = '', $bag = 'default', $options = [], public $multiple = false, public $placeholder = '')
    {
        parent::__construct($name, $id, $value, $label, $bag);
        if (is_string($options) && enum_exists($options)) {
            $options = array_map(fn ($case) => $case->label(), array_column($options::cases(), null, 'value'));
        }
        $this->options = $options;
    }

    public function isSelected($option): bool
    {
        if (is_array($this->value)) {
            return in_array($option, $this->value);
        }

        return (string) $option === (string) $this->value;
    }

    public function render()
    {
        return view('components.select');
    }
}
