<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->set("title_for_layout", "Localizações");  
$this->extend('/Common/view');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').'<b> LOCALIZAÇÕES </b>');

$this->start('sidebar');
?>
<li><?=$this->Html->link('Nova Localização',array('controller' => 'Localizacaos', 'action' => 'add')); ?></li>
<?php $this->end(); ?>

<div id="main_div" >
<table>
    <tr>
            <td><b><?=$this->Paginator->sort('localizacao','LOCALIZAÇÃO');?></b></td> 
            <td><b>AÇÃO</b></td>
    </tr>
    
<?php foreach($localizacao as $lo){  ?>
        <tr>
               <td><?=$lo['Localizacao']['localizacao']; ?></td>
               
               <td>
                    <?= $this->Html->link($this->Html->image('edit.png'), 
                        array('controller' => 'Localizacaos', 'action' => 'edit',$lo['Localizacao']['id']),
                        array('escape' => false, 'title' => "Editar"));?>
                   
                  | <?= $this->Html->link($this->Html->image('trash.png'), 
                        array('controller' => 'Localizacaos', 'action' => 'delete',$lo['Localizacao']['id']),
                        array('escape' => false, 'title' => "Deletar"), "Deseja excluir esta localização?");?> 
                 
                 

               </td> 
        </tr>
<?php  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>