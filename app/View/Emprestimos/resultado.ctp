<?php

$this->assign('menu-principal', $this->element('menu-principal'));
$this->set("title_for_layout", "Resultado da Busca"); 
$this->extend('/Common/view');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' EMPRÉSTIMOS ',array('controller' => 'Emprestimos', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> RESULTADO </b>');

echo $this->Html->script('jquery', false);
echo $this->Html->script('jquery-ui', false);
echo $this->Html->script('ui.multiselect', false);
echo     $this->Html->css('ui.multiselect', null, array('inline' => false));
    $this->start('sidebar');
    ?>
<li><?=$this->Html->link('Novo Empréstimo',array('controller' => 'Emprestimos', 'action' => 'add')); ?></li>
<br/>
<li><?=$this->Html->link('Buscar Empréstimos',array('controller' => 'Emprestimos', 'action' => 'index')); ?></li>
<br/>
<li><?=$this->Html->link('Todos Empréstimos',array('controller' => 'Emprestimos', 'action' => 'emprestimos')); ?></li>
    <?php $this->end(); ?>
<div id="main_div">
    <table>
        <tr>
            <td></td>
            <td><b><?=$this->Paginator->sort('aluno','ALUNO');?></b></td> 
            <td><b><?=$this->Paginator->sort('data_emprestimo','DATA EMPRÉSTIMO');?></b></td> 

            <td><b><?=$this->Paginator->sort('titulo','LIVRO');?></b></td> 
            <td><b><?=$this->Paginator->sort('prazo_devolucao','PRAZO DEVOLUÇÃO');?></b></td>
            <td><b><?=$this->Paginator->sort('data_devolucao','DATA DEVOLUÇÃO');?></b></td>
            <td><b>AÇÕES</b></td>
        </tr>

<?php foreach($emprestimos as $emp){ 
    $rowSpan = count($emp['Viewlte']);
    ?>
        <tr>
            <td rowspan="<?=$rowSpan;?>"><?= $this->Html->link($this->Html->image('icondetails.png'), 
                                 array('controller' => 'Emprestimos', 'action' => 'view', $emp['Emprestimo']['id']),
                                 array('escape' => false, 'title' => "Detalhes"));?></td>
            <td rowspan="<?=$rowSpan;?>"><?=$emp['Viewaluno']['nome']; ?></td>              
            <td rowspan="<?=$rowSpan;?>"><?=$this->Time->format($emp['Emprestimo']['data_emprestimo'], '%d/%m/%Y'); ?></td>
               <?php 
               if(empty($emp['Viewlte'])) echo "<td colspan='4'>".$this->Html->link($this->Html->image('trash.png'), 
                                 array('controller' => 'Emprestimos', 'action' => 'delete', $emp['Emprestimo']['id']),
                                 array('escape' => false, 'title' => "Deletar"), "Deseja excluir este esmpréstimo?").
                       "</td>";
               foreach($emp['Viewlte'] as $livro){ ?>
            <td><?=$livro['titulo']; ?></td>
            <td><?=$this->Time->format($livro['prazo_devolucao'], '%d/%m/%Y'); ?></td>
            <td><?=($livro['data_devolucao'] != null) ? 
                          $this->Time->format($livro['data_devolucao'], '%d/%m/%Y'):
                             "__/__/____"; ?></td>
            <td><?php if(!$livro['data_devolucao']){ 
                             echo $this->Biblioteca->DevolverLivroLink($livro['id']);

                             $date1 = date_create($this->Time->format($livro['prazo_devolucao'],"%Y/%m/%d"));
                             $date2 = new DateTime();
                             $date2->format("%Y/%m/%d");
                             $diff=date_diff($date1,$date2,false);
                             if($diff->days >= 0 && $diff->invert>0) echo " | " .
                                 $this->Biblioteca->ProrrogarPrazoLink($livro['id']);
                         }
                         echo "</td></tr>";
            }?>  
<?php  }  ?>
    </table>
    <br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>