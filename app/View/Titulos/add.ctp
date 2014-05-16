<h1>Novo Titulo</h1>
<?php  

        echo    $this->Form->create('Titulo',array( 'action' => 'add')),
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
      /*    $this->AutoComplete->input( 
                    'Localizacao.nome', 
                    array( 
                        'label' => 'Localização',
                        'autoCompleteUrl'=>$this->Html->url(  
                            array( 
                                'controller'=>'Localizacao', 
                                'action'=>'auto_complete', 
                            ) 
                        ), 
                        'autoCompleteRequestItem'=>'autoCompleteText', 
                    ) 
                ),
        */               $this->Form->end('cadastrar');
?>
