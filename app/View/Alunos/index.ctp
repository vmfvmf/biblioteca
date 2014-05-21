<?php
$this->set("title_for_layout", "Alunos");  
$this->extend('/Common/view');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').'<b> ALUNOS </b>');

$this->start('sidebar');
?>
<li><?=$this->Html->link('Novo Aluno',array('controller' => 'Alunos', 'action' => 'add')); ?></li>
<?php $this->end(); ?>

<div id="main_div">
<table>
    <tr>
            <td><b><?=$this->Paginator->sort('nome','ALUNO');?></b></td> 
            <td><b>RA</b></td>
            <td><b>AÇÃO</b></td>
    </tr>
    
<? foreach($alunos as $aluno){  ?>
        <tr>
               <td><?=$this->Html->link($aluno['Aluno']['nome'],array('controller' => 'Autors', 'action' => 'view',$aluno['Aluno']['nome'])); ?></td>
               <td><?=$aluno['Aluno']['ra']?></td>
               <td>
                    <?=$this->Html->link('Editar',array('controller' => 'Alunos', 'action' => 'edit',$aluno['Aluno']['id'])); ?>
                  |  <?=$this->Html->link('Excluir',array('controller' => 'Alunos', 'action' => 'delete',$aluno['Aluno']['id']), null, "Deseja excluir este aluno?"); ?>
                 

               </td> 
        </tr>
<?  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>