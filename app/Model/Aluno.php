<?php
    class Aluno extends AppModel{
        
        public  $name = "Aluno";
        public $hasMany = array("Emprestimo");
        
        
        public function getAlunosRa(){
                return $this->query('
                        SELECT concat(a.nome, \' - \',a.ra) as "aluno", a.id
                        FROM alunos a;', 'list'); // if table name is `locations`
        }
    }
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
