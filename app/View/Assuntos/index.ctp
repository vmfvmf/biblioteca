<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->extend('/Common/view');
$this->set("title_for_layout", "Assuntos");  
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').'<b> ASSUNTOS </b>');

$this->start('sidebar');
?>
<li><?=$this->Html->link('Novo Assunto',array('controller' => 'Assuntos', 'action' => 'add')); ?></li>
<?php $this->end(); ?>

<div id="main_div">
<table>
    <tr>
            <td><b><?=$this->Paginator->sort('assunto','ASSUNTO');?></b></td> 
            <td><b>AÇÃO</b></td>
    </tr>
    
<?php foreach($assuntos as $ass){  ?>
        <tr>
               <td><?=$ass['Assunto']['assunto']?></td>
               
               <td>
                   <?= $this->Html->link($this->Html->image('edit.png'), 
                        array('controller' => 'Assuntos', 'action' => 'edit',$ass['Assunto']['id']),
                        array('escape' => false, 'title' => "Editar"));?>
                   
                  | <?= $this->Html->link($this->Html->image('trash.png'), 
                        array('controller' => 'Assuntos', 'action' => 'delete',$ass['Assunto']['id']),
                        array('escape' => false, 'title' => "Deletar"), "Deseja excluir este assunto?");?> 
                 

               </td> 
        </tr>
<?php  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>