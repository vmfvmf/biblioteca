<h1>Registro de Emprestimo</h1>
<?php  
    if(isset($livros)){
        echo    $this->Form->create('Emprestimo',array( 'action' => 'add')),
                $this->Form->input('livro_id',array
                  ('options'=>$livros, 'empty' => 'Selecione o livro')),
                $this->Form->input('aluno_id',array
                  ('options'=>$alunos, 'empty' => 'Selecione o aluno')),
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
    }else{
         echo 'Não há livros disponíveis.';
    }
?>
