<h1>Novo Livro</h1>
<?php  

        echo    $this->Form->create('Livro',array( 'action' => 'edit')),
                $this->Form->input('titulo_id',array
                  ('options'=>$titulos)),
                $this->Form->input('editora_id',array
                  ('options'=>$editoras)),
                $this->Form->input('Livro.edicao'),
                $this->Form->input('Livro.obs'),
                $this->Form->input('Livro.ano'),
                $this->Form->input('idioma_id',array
                  ('options'=>$idiomas, 'empty' => 'Selecione o idioma')),
                $this->Form->input('Livro.data_aquisicao'),
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
        */               $this->Form->end('salvar');
?>
