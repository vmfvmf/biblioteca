<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->set("title_for_layout", "Novo Título"); 
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' TÍTULOS ',array('controller' => 'Titulos', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> NOVO </b>');

echo $this->Html->script('jquery', false);
echo $this->Html->script('jquery-ui', false);
    echo $this->Html->script('ui.multiselect', false);
    echo     $this->Html->css('ui.multiselect', null, array('inline' => false));
    
        echo    $this->Form->create('Titulo',array( 'action' => 'add')),
                       $this->Form->input('titulo', array('label'=>'Título')),
                       
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
          $this->Form->input('localizacao_id',array('options'=>$localizacao, 'empty' => 'Selecione...')),
          $this->Form->end('cadastrar');
     
        $this->Html->scriptStart(array('inline' => false));
                    echo '$(function(){
                        $(".multiselect").multiselect();
                        $(document).tooltip();
                    });';

                    $this->Html->scriptEnd();
                echo $this->Js->writeBuffer();
?>