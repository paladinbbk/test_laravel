<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class FileForm extends Form
{
    protected $formOptions = [
        'wrapper' => 'input-group mb-3',
    ];

    public function buildForm()
    {
        $this->add('url', 'url');
        $this->add('cost', 'text');

        $this->add('submit', 'submit', [
            'wrapper' => ['class' => 'input-group-append'],
            'text' => 'update',
            'attr' => ['class' => 'btn btn-outline-secondary']]);
    }
}