<?php
echo $this->Html->link('BIBLIOTECA','../')   .' > '.
        $this->Html->link('LIVROS',array('controller' => 'Livros', 'action' => 'index'))
        .' > <b>NOVO</b>';
?>
<h1>Novo Livro</h1>
<?php  
        echo    $this->Form->create('Livro',array( 'action' => 'add')),
                $this->Form->input('titulo_id',array
                  ('options'=>$titulos, 'empty' => 'Selecione o titulo')),
                $this->Form->input('editora_id',array
                  ('options'=>$editoras, 'empty' => 'Selecione a editora')),
                $this->Form->input('Livro.cod_barras'),
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
        */               $this->Form->end('cadastrar');
?>
