<?php
$this->set("title_for_layout", "Alunos");  
$this->assign('menu-principal', $this->element('menu-principal'));
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
    
<?php foreach($alunos as $aluno){  ?>
        <tr>
               <td><?=$this->Html->link($aluno['Viewaluno']['nome'],array('controller' => 'Alunos', 'action' => 'view',$aluno['Viewaluno']['aluno_id'])); ?></td>
               <td><?=$aluno['Viewaluno']['ra']?></td>
               <td>
                   <?= $this->Html->link($this->Html->image('edit.png'), 
                        array('controller' => 'Alunos', 'action' => 'edit',$aluno['Viewaluno']['aluno_id']), 
                        array('escape' => false, 'title' => "Editar"));?>
                   
                  | <?= $this->Html->link($this->Html->image('trash.png'), 
                        array('controller' => 'Alunos', 'action' => 'delete',$aluno['Viewaluno']['aluno_id']),
                        array('escape' => false, 'title' => "Deletar"), "Deseja excluir este aluno?");?> 
                    
               </td> 
        </tr>
<?php  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>