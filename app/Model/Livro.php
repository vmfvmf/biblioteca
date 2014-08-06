<?php
    class Livro extends AppModel{
        
        public $name = "Livro";
        public $helpers = array('Barcode');
        public $belongsTo = array("Idioma","Titulo", "Editora");
        public $hasMany = array(
            "Viewlivrosdetalhe" => array(
                'className' => 'Viewlivrosdetalhe',
                'foreignKey' => 'id')
        );
        public $hasAndBelongsToMany = array(
                            "Emprestimo" => array(
                                'className' => 'Emprestimo',
                                'joinTable' => 'emprestimos_livros',
                                'foreignKey' => 'livro_id',
                                'associationForeignKey' => 'emprestimo_id'));
        
        public function getLivrosTitulo(){
            return $this->query('
                    SELECT l.id as 
                    "livro_id", t.titulo FROM livros l inner join titulos t
                     ON l.titulo_id = t.id where disponivel;', 'list'); // if table name is `locations`
        }
        
    }
?>
