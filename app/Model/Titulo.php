<?php
    class Titulo extends AppModel{
        
        public $name = "Titulo";
        //public $helpers = array("Biblioteca");
        public $belongsTo = array("Localizacao");
        public $hasMany = array("Livro",
            "Viewtitulosdetalhe" => array(
                'className' => 'Viewtitulosdetalhe',
                'foreignKey' => 'id'),
            "Viewlivrosdetalhe" => array(
                'className' => 'Viewlivrosdetalhe',
                'foreignKey' => 'titulo_id')
        );
        public $hasAndBelongsToMany = array(
                            "Autor" => array(
                                'className' => 'Autor',
                                'joinTable' => 'autors_titulos',
                                'foreignKey' => 'titulo_id',
                                'associationForeignKey' => 'autor_id'),
                            "Classificacao" => array(
                                'className' => 'Classificacao',
                                'joinTable' => 'classificacaos_titulos',
                                'foreignKey' => 'titulo_id',
                                'associationForeignKey' => 'classificacao_id'),
                            "Assunto" => array(
                                'className' => 'assunto',
                                'joinTable' => 'assuntos_titulos',
                                'foreignKey' => 'titulo_id',
                                'associationForeignKey' => 'assunto_id')    
                            );///, "Assunto" );
    }
?>
