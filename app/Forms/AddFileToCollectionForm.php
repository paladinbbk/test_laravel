<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class AddFileToCollectionForm extends Form
{
    protected $formOptions = [
        'wrapper' => 'input-group mb-3',
    ];

    public function buildForm()
    {
        $this->add('name', 'text');

        $this->add('Create', 'submit', [
            'wrapper' => ['class' => 'input-group-append'],
            'text' => 'update',
            'attr' => ['class' => 'btn btn-outline-secondary']]);
    }
}