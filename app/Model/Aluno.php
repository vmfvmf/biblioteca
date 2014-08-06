<?php
    App::import('Model','User');
    class Aluno extends User{
        
        public  $name = "Aluno";
        public $hasMany = array("Emprestimo", "Viewlte", "Viewaluno");
        public $sequence = 'public.users_id_seq';
        
        
        public function getAlunosRa(){
                return $this->query('
                        SELECT ra as "aluno", aluno_id
                        FROM viewalunos;', 'list'); // if table name is `locations`
        }
    }
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
