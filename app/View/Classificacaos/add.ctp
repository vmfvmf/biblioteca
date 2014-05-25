<?php
$this->set("title_for_layout", 'Novo Classificação');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' CLASSIFICAÇÕES ',array('controller' => 'Classificacaos', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> NOVO </b>');

        echo    $this->Form->create('Classificacao',array( 'action' => 'add')),
                       $this->Form->input('classificacao'),
            $this->Form->end('cadastrar');
?>
