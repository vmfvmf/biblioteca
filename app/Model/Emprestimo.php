<?php
    class Emprestimo extends AppModel{
        
        public $name = "Emprestimo";
        public $belongsTo = array("Livro","Aluno");
        public $validate = array(
            'aluno_id'=> array(
                'rule' => 'notEmpty',
                'message'  => 'Escolha um aluno'
             ),
            'livro_id' => array(
                'rule' => 'notEmpty',
              'message'  => 'Escola um livro'
            )
        );
        
        public function realizaDev($id){
            return $this->query('UPDATE emprestimos SET data_devolucao = now() WHERE '
            . 'id = '.$id); 
        }
    }
?>
