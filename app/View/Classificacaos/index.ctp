<?php
$this->extend('/Common/view');
$this->set("title_for_layout", "Classificações");  
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').'<b> CLASSIFICAÇÕES </b>');


$this->start('sidebar');
?>
<li><?=$this->Html->link('Nova Classificação',array('controller' => 'Classificacaos', 'action' => 'add')); ?></li>
<?php $this->end(); ?>

        <div id="main_div" >
<table>
    <tr>
            <td><b><?=$this->Paginator->sort('classificacao','CLASSIFICAÇÃO');?></b></td> 
            <td><b>AÇÃO</b></td>
    </tr>
    
<? foreach($classificacao as $cas){  ?>
        <tr>
               <td><?=$cas['Classificacao']['classificacao']?></td>
               
               <td>
                    <?=$this->Html->link('Editar',array('controller' => 'Classificacaos', 'action' => 'edit',$cas['Classificacao']['id'])); ?>
                  |  <?=$this->Html->link('Excluir',array('controller' => 'Classificacaos', 'action' => 'delete',$cas['Classificacao']['id']), null, "Deseja excluir esta Classificação?"); ?>
                 

               </td> 
        </tr>
<?  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>