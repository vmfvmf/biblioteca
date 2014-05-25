<?php
$this->set("title_for_layout", 'Novo Autor');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' AUTORES ',array('controller' => 'Autors', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> NOVO </b>');


        echo    $this->Form->create('Autor',array( 'action' => 'add')),
                       $this->Form->input('autor'),
            $this->Form->end('cadastrar');
?>
