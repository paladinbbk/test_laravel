<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ParceForm extends Form
{
    protected $formOptions = [
        'method' => 'POST',
        'url' => 'parse',
        'wrapper' => 'input-group mb-3',
    ];

    public function buildForm()
    {
        $this->add('url', 'url');
        $this->add('submit', 'submit', [
            'wrapper' => ['class' => 'input-group-append'],
            'text' => 'parce',
            'attr' => ['class' => 'btn btn-outline-secondary']]);
    }
}