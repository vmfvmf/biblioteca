<?php
$this->set("title_for_layout", 'Novo Aluno');
$this->assign('menu-principal', $this->element('menu-principal'));
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' ALUNOS ',array('controller' => 'Alunos', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> NOVO </b>');

        echo    $this->Form->create('Aluno',array( 'action' => 'add')),
                       $this->Form->input('nome', array('label' => 'Nome')),
                $this->Form->input('ra', array('label' => 'RA')),
                $this->Form->input('ano_serie', array('label' => 'Série')),
            $this->Form->end('cadastrar');
?>
