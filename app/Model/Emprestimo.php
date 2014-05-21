<?php
    class Emprestimo extends AppModel{
        
        public $name = "Emprestimo";
        public $hasAndBelongsToMany = array(
                            "Livro" => array(
                                'className' => 'Livro',
                                'joinTable' => 'emprestimos_livros',
                                'foreignKey' => 'emprestimo_id',
                                'associationForeignKey' => 'livro_id'));
        public $hasMany = array("Viewlte", "Aluno");
        
        public $validate = array(
            'aluno_id'=> array(
                'rule' => 'notEmpty',
                'message'  => 'Escolha um aluno'
             ),
            'livro_id'=> array(
                'rule' => 'notEmpty',
                'message'  => 'Escolha um livro'
             )
        );
        
        public function realizaDev($id){
            return $this->query('UPDATE emprestimos_livros SET data_devolucao = now() WHERE '
            . 'id = '.$id); 
        }
        
        public function prorrogaPrazo($id){
            return $this->query('UPDATE emprestimos_livros SET prazo_devolucao = (now() '
                    . '+ INTERVAL \'7 days\') WHERE '
            . 'id = '.$id); 
        }
    }
?>

