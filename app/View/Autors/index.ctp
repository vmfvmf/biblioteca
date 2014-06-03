<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->extend('/Common/view');
$this->set("title_for_layout", "Autores");  
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').'<b> AUTORES </b>');
$this->start('sidebar');
?>
<li><?=$this->Html->link('Novo Autor',array('controller' => 'Autors', 'action' => 'add')); ?></li>
<?php $this->end(); ?>

<div id="main_div" >
<table>
    <tr>
            <td><b><?=$this->Paginator->sort('autor','AUTOR');?></b></td> 
            <td><b>AÇÃO</b></td>
    </tr>
    
<?php foreach($autors as $autor){  ?>
        <tr>
               <td><?=$autor['Autor']['autor']; ?></td>
               
               <td>
                   <?= $this->Html->link($this->Html->image('edit.png'), 
                        array('controller' => 'Autors', 'action' => 'edit',$autor['Autor']['id']),
                        array('escape' => false, 'title' => "Editar"));?>
                   
                  | <?= $this->Html->link($this->Html->image('trash.png'), 
                        array('controller' => 'Autors', 'action' => 'delete',$autor['Autor']['id']),
                        array('escape' => false, 'title' => "Deletar"), "Deseja excluir este autor?");?> 
                 

               </td> 
        </tr>
<?php  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>