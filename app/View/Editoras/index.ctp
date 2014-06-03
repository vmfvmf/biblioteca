<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->extend('/Common/view');
$this->set("title_for_layout", "Editoras");  
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').'<b> EDITORAS </b>');

$this->start('sidebar');
?>
<li><?=$this->Html->link('Nova Editora',array('controller' => 'Editoras', 'action' => 'add')); ?></li>
<?php $this->end(); ?>
        <div id="main_div">
<table>
    <tr>
            <td><b><?=$this->Paginator->sort('editora','EDITORA');?></b></td> 
            <td><b>AÇÃO</b></td>
    </tr>
    
<?php foreach($editoras as $ed){  ?>
        <tr>
               <td> <?=$ed['Editora']['editora'];?> </td>
               
               <td>
                   <?= $this->Html->link($this->Html->image('edit.png'), 
                        array('controller' => 'Editoras', 'action' => 'edit',$ed['Editora']['id']),
                        array('escape' => false, 'title' => "Editar"));?>
                   
                  | <?= $this->Html->link($this->Html->image('trash.png'), 
                        array('controller' => 'Editoras', 'action' => 'delete',$ed['Editora']['id']), 
                        array('escape' => false, 'title' => "Deletar"), "Deseja excluir esta editora?");?> 
                 

               </td> 
        </tr>
<?php  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>