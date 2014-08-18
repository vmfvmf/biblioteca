<?php

$this->set("title_for_layout", 'Novo Aluno');
$this->extend('/Common/view');
$this->assign('menu-principal', $this->element('menu-principal'));
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
    $this->Html->image('../img/arrow.png').
    $this->Html->link(' ALUNOS ',array('controller' => 'Alunos', 'action' => 'index')).
    $this->Html->image('../img/arrow.png').'<b> NOVO </b>');
$this->start('sidebar');
?>
<li><?=$this->Html->link('Buscar Aluno',array('controller' => 'Alunos', 'action' => 'index')); ?></li>
<br/>
<li><?=$this->Html->link('Todos Alunos',array('controller' => 'Alunos', 'action' => 'todos')); ?></li>
<?php $this->end(); ?>

<div id="main_div">
<?=$this->Form->create('Aluno',array( 'action' => 'add'));?>
    <h1>NOVO ALUNO</h1>
    <h2>DADOS PESSOAIS</h2>
        <?=$this->Form->input('nome', array('label' => 'Nome')),
        $this->Form->input('sobrenome', array('label' => 'Sobrenome'));?>
    <h2>DADOS ESCOLARES</h2>    
        <?=$this->Form->input('username', array('label' => 'RA'));?>
    <h2>CONTATO</h2>    
        <?=$this->Form->input('email', array('label' => 'E-Mail'));?>
    <h2>ENDEREÇO</h2>
        <?=$this->Form->input('Endereco.logradouro', array('label' => 'Rua')),
                $this->Form->input('Endereco.numero', array('label' => 'Numero')),
                $this->Form->input('Endereco.bairro', array('label' => 'Bairro')),
                $this->Form->input('Endereco.cidade', array('label' => 'Cidade', 'value' => 'Capão Bonito')),
                $this->Form->input('Endereco.cep', array('label' => 'CEP'));?>
        <?=$this->Form->end('cadastrar');?>
</div>