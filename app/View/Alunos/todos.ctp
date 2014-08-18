<?php
$this->set("title_for_layout", "Alunos");  
$this->assign('menu-principal', $this->element('menu-principal'));
$this->extend('/Common/view');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').'<b> ALUNOS </b>');

$this->start('sidebar');
?>
<li><?=$this->Html->link('Novo Aluno',array('controller' => 'Alunos', 'action' => 'add')); ?></li>
<br/>
    <li><?=$this->Html->link('Buscar Aluno',array('controller' => 'Alunos', 'action' => 'index')); ?></li>
<?php $this->end(); ?>

<div id="main_div">
<table>
    <tr>
        <td></td>
            <td><b><?=$this->Paginator->sort('nome','ALUNO');?></b></td> 
            <td><b>RA</b></td>
            <td><b>EMAIL</b></td>
            <td><b>AÇÃO</b></td>
    </tr>
    
<?php foreach($alunos as $aluno){  ?>
        <tr>
            <td><?= $this->Biblioteca->DetalhesAluno($aluno['Viewaluno']['aluno_id']); ?></td>
               <td><?=$aluno['Viewaluno']['nome']; ?></td>
               <td><?=$aluno['Viewaluno']['ra']?></td>
               <td><?=$aluno['Viewaluno']['email']?></td>
               <td>        
                  <?= $this->Biblioteca->EditarAluno($aluno['Viewaluno']['aluno_id']); ?>                   
                  | <?= $this->Biblioteca->ExcluirAluno($aluno['Viewaluno']['aluno_id']); ?> 
                    
               </td> 
        </tr>
<?php  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>