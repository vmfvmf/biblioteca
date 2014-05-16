<?php
    class Titulo extends AppModel{
        
        public $name = "Titulo";
        public $belongsTo = array("Localizacao");
        public $hasMany = array("Livro");
        public $hasAndBelongsToMany = array(
                            "Autor" => array(
                                'className' => 'Autor',
                                'joinTable' => 'autors_titulos',
                                'foreignKey' => 'titulo_id',
                                'associationForeignKey' => 'autor_id'),
                            "Categoria" => array(
                                'className' => 'Categoria',
                                'joinTable' => 'categorias_titulos',
                                'foreignKey' => 'titulo_id',
                                'associationForeignKey' => 'categoria_id')
                            );///, "Assunto" );
    }
?>
