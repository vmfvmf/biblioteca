<?php
$this->set("title_for_layout", "Assuntos");  
$this->extend('/Common/view');
$this->start('sidebar');
?>
<li><?=$this->Html->link('Novo Assunto',array('controller' => 'Assuntos', 'action' => 'add')); ?></li>
<?php $this->end(); ?>
<h1>Autores<h1>


<table>
    <tr>
            <td><b><?=$this->Paginator->sort('assunto','ASSUNTO');?></b></td> 
            <td><b>AÇÃO</b></td>
    </tr>
    
<? foreach($assuntos as $ass){  ?>
        <tr>
               <td><?=$ass['Assunto']['assunto']?></td>
               
               <td>
                    <?=$this->Html->link('Editar',array('controller' => 'Assuntos', 'action' => 'edit',$ass['Assunto']['id'])); ?>
                  |  <?=$this->Html->link('Excluir',array('controller' => 'Assunto', 'action' => 'delete',$ass['Assunto']['id']), null, "Deseja excluir este assunto?"); ?>
                 

               </td> 
        </tr>
<?  }  ?>
</table>
<br/>
<?//=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
<br/>
<br/>
