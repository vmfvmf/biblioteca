<?php
$this->set("title_for_layout", 'Novo Assunto');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' ASSUNTOS ',array('controller' => 'Assuntos', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> NOVO </b>');



        echo    $this->Form->create('Assunto',array( 'action' => 'add')),
                       $this->Form->input('assunto'),
            $this->Form->end('cadastrar');
?>
