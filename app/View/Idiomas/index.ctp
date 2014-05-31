<?php
$this->extend('/Common/view');
$this->set("title_for_layout", "Idiomas");  
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').'<b> IDIOMAS </b>');

$this->start('sidebar');
?>
<li><?=$this->Html->link('Novo Idioma',array('controller' => 'Idiomas', 'action' => 'add')); ?></li>
<?php $this->end(); ?>
        <div id="main_div">
<table>
    <tr>
            <td><b><?=$this->Paginator->sort('idioma','IDIOMA');?></b></td> 
            <td><b>AÇÃO</b></td>
    </tr>
    
<?php foreach($idiomas as $id){  ?>
        <tr>
               <td> <?=$id['Idioma']['idioma'];?> </td>
               
               <td>
                   <?= $this->Html->link($this->Html->image('edit.png'), 
                        array('controller' => 'Idiomas', 'action' => 'edit',$id['Idioma']['id']),
                        array('escape' => false, 'title' => "Editar"));?>
                   
                  | <?= $this->Html->link($this->Html->image('trash.png'), 
                        array('controller' => 'Idiomas', 'action' => 'delete',$id['Idioma']['id']), 
                        array('escape' => false, 'title' => "Deletar"), "Deseja excluir este idioma?");?> 
                 

               </td> 
        </tr>
<?php  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>