<h1>Editar Escola</h1>

<?php  
       echo    $this->Form->create(),
                       $this->Form->input('titulo'),
                       
          $this->Form->input('Autor', array(
                              'label' => __('Autores',true),
                              'type' => 'select',
                              'multiple' => 'checkbox',
                              'options'=>$autors,
          )),
            $this->Form->input('Categoria', array(
                              'label' => __('Categorias',true),
                              'type' => 'select',
                              'multiple' => 'checkbox',
                              'options'=>$categorias,
          )),
          $this->Form->input('localizacao_id',array('options'=>$localizacao, 'empty' => 'Selecione o titulo')),
                       $this->Form->end('salvar');
?>