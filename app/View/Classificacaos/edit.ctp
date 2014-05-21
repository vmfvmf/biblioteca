<?php
$this->set("title_for_layout", 'Editar Classificação');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' CLASSIFICAÇÕES ',array('controller' => 'Classificacaos', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> EDITAR </b>');

       echo    $this->Form->create(),
                       $this->Form->input('classificacao'),
                       $this->Form->end('salvar');
?>