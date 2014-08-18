<?php
    class Endereco extends AppModel{
        
        public  $name = "Endereco";
        
        
        public $validate = array(
            'logradouro' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Escreva a rua'
                )
            ),
            'numero' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Escreva o numero'
                )
            ),
            'cep' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Escreva o CEP'
                )
            ),
            'bairro' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Escreva o bairro'
                )
            ),
            'cidade' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Escreva a cidade'
                )
            )
        );
    }
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
