<?php
$this->set("title_for_layout", 'Nova Localização');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' LOCALIZAÇÕES ',array('controller' => 'Localizacaos', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> NOVO </b>');

   echo    $this->Form->create('Localizacao',array( 'action' => 'add')),
                $this->Form->input( 
                    'localizacao'),
                $this->Form->end('cadastrar');
?>
