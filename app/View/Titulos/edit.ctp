<?php
    echo $this->Html->script('jquery', false);
    echo $this->Html->script('jquery-ui-1.10.4.min', false);
    echo $this->Html->script('ui.multiselect', false);
    echo $this->Html->css('jquery-ui', null, array('inline' => false));
    echo     $this->Html->css('ui.multiselect', null, array('inline' => false));
    echo $this->Html->link('BIBLIOTECA','../')   .' > '.
        $this->Html->link('TITULOS',array('controller' => 'Titulos', 'action' => 'index'))
        .' > <b>EDITAR</b>';
?>
<h1>Editar Titulo</h1>

<?php  
    
       echo    $this->Form->create('Titulo',array( 'action' => 'edit')),
          $this->Form->input('titulo'),
                       
          $this->Form->input('Autor', array(
                              'label' => __('Autores',true),
                              'type' => 'select',
                              'options'=>$autors,
                               'class' => 'multiselect',
                               'multiple' => 'multiple',
                               'style' => 'clear: none !important; width:460px; height:200px;'
          )),
            $this->Form->input('Classificacao', array(
                              'label' => __('Classificações',true),
                              'type' => 'select',
                                'class' => 'multiselect',
                              'multiple' => 'multiple',
                              'options'=>$classificacaos,
                'style' => 'clear: none !important; width:460px; height:200px;'
          )),
                
          $this->Form->input('Assunto', array(
                              'label' => __('Assuntos',true),
                              'type' => 'select',
                                'class' => 'multiselect',
                              'multiple' => 'multiple',
                              'options'=>$assuntos,
              'style' => 'clear: none !important; width:460px; height:200px;'
          )),
          $this->Form->input('localizacao_id',array('options'=>$localizacao, 'empty' => 'Selecione o titulo')),
          $this->Form->end('Salvar');
       
          $this->Html->scriptStart(array('inline' => false));
          echo '$(function(){$(".multiselect").multiselect();});';

          $this->Html->scriptEnd();
          echo $this->Js->writeBuffer();
?>