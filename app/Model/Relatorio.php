<?php
    class Relatorio extends AppModel{
        public  $name = "Relatorio";
        public $hasMany = array("Aluno","Livro", 
            "Viewlte" => array(
            'className' => 'Viewlte',
            'foreignKey' => 'emprestimo_id'));
        
        
        
    }
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
