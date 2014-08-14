<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->set("title_for_layout", "Detalhes Empréstimo");  
$this->set("title_for_layout", 'Novo Empréstimo');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' EMPRÉSTIMOS ',array('controller' => 'Emprestimos', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> DETALHES </b>');

$this->extend('/Common/view');
$this->start('sidebar');
?>
    <ul>
    <li><?=$this->Html->link('Novo Empréstimo',array('controller' => 'Emprestimos', 'action' => 'add')); ?></li>
    <br/>
    <li><?=$this->Html->link('Todos Empréstimos',array('controller' => 'Emprestimos', 'action' => 'emprestimos')); ?></li>
    <br/>
    <li><?=$this->Html->link('Detalhes Aluno',array('controller' => 'Alunos', 'action' => 'view',$emprestimo[0]['Viewlte']['aluno_id'])); ?></li>
</ul>
    
<?php $this->end(); ?>
<div id="main_div">
<h2>Aluno</h2>
<h3><?=$emprestimo[0]['Viewlte']['aluno'];?></h3> 
<h2>RA</h2>
<h3><?=$emprestimo[0]['Viewlte']['ra'];?></h3> 
<h2>DATA EMPRÉSTIMO</h2>
<h3><?=$this->Time->format($emprestimo[0]['Viewlte']['data_emprestimo'], '%d/%m/%Y');?></h3> 
<br/>
<table >
    <thead>
    <th></th>
    <th>TÍTULO</th>
    <th>PRAZO DEVOLUÇÃO</th>
    <th>DATA DEVOLUÇÃO</th>
    <th>AÇÕES</TH>
    </thead>
    
<?php  foreach($emprestimo as $emp){ ?>
        <tr>
            <td><?=$this->Biblioteca->DetalhesLivro($emp['Viewlte']['livro_id']);?></td>
            <td><?=$emp['Viewlte']['titulo']; ?></td>
            <td><?=$this->Time->format($emp['Viewlte']['prazo_devolucao'], '%d/%m/%Y'); ?></td>
            <td><?=($emp['Viewlte']['data_devolucao'] != null) ? 
                          $this->Time->format($emp['Viewlte']['data_devolucao'], '%d/%m/%Y'):
                             "__/__/____"; ?></td>
                        <td>
                          
                         <?php if(!$emp['Viewlte']['data_devolucao']){ 
                             echo $this->Biblioteca->DevolverLivroLink($emp['Viewlte']['id']);

                             $date1 = date_create($this->Time->format($emp['Viewlte']['prazo_devolucao'],"%Y/%m/%d"));
                             $date2 = new DateTime();
                             $date2->format("%Y/%m/%d");
                             $diff=date_diff($date1,$date2,false);
                             if($diff->days >= 0 && $diff->invert>0) echo " | " .
                                 $this->Biblioteca->ProrrogarPrazoLink($emp['Viewlte']['id']);
                         }else{
                             echo "-";
                         }
            echo "</tr>";
               }?>  
</table>

</div>