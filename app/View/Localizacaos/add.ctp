<h1>Nova Localização</h1>
<?php   echo    $this->Form->create('Localizacao',array( 'action' => 'add')),
                $this->AutoComplete->input( 
                    'nome', 
                    array( 
                        'autoCompleteUrl'=>$this->Html->url(  
                            array( 
                                'controller'=>'Localizacao', 
                                'action'=>'auto_complete', 
                            ) 
                        ), 
                        'autoCompleteRequestItem'=>'autoCompleteText', 
                    ) 
                ),
                $this->Form->end('cadastrar');
?>
