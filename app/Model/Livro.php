<?php
    class Livro extends AppModel{
        
        public $name = "Livro";
        public $belongsTo = array("Idioma","Titulo", "Editora");
        public $hasMany = array("Emprestimo");
        
        public function getLivrosTitulo(){
            return $this->query('
                    SELECT concat(t.titulo, \' - \',l.cod_barras) as "titulo", l.id as 
                    "livro_id" FROM livros l inner join titulos t
                     ON l.titulo_id = t.id where disponivel;', 'list'); // if table name is `locations`
        }
        
    }
?>
