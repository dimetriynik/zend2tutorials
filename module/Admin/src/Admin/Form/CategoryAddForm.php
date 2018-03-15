<?php

namespace Admin\Form;

use Zend\Form\Form;


class CategoryAddForm extends Form
{

    public function __construct($name = null, array $options = array())
    {
        parent::__construct('categoryAddForm', $options);

        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'bs-example form-horizontal');


        $this->add([
            'name' => 'categoryKey',
            'type' => 'Text',
            'options' => [
                'min' => 3,
                'max' => 100,
                'label' => 'Ключ',
            ],
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required'
            ]
        ]);

        $this->add([
            'name' => 'categoryName',
            'type' => 'Text',
            'options' => [
                'min' => 3,
                'max' => 100,
                'label' => 'Имя категории',
            ],
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',

            'attributes' => [
                'value' => 'Сохранить',
                'class' => 'btn btn-primary',
                'id' => 'btn_submit',

            ]
        ]);


    }


}