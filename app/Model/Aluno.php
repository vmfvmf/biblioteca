<?php
    class Aluno extends AppModel{
        
        public  $name = "Aluno";
        public $hasMany = array("Emprestimo");
    }
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
