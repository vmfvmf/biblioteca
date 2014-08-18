<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->set("title_for_layout", "Resultado da Busca"); 
$this->extend('/Common/view');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' ALUNOS ',array('controller' => 'Alunos', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> RESULTADO </b>');

echo $this->Html->script('jquery', false);
echo $this->Html->script('jquery-ui', false);
echo $this->Html->script('ui.multiselect', false);
echo     $this->Html->css('ui.multiselect', null, array('inline' => false));
    $this->start('sidebar');
    ?>
    <li><?=$this->Html->link('Novo Aluno',array('controller' => 'Alunos', 'action' => 'add')); ?></li>
    <br/>
    <li><?=$this->Html->link('Buscar Aluno',array('controller' => 'Alunos', 'action' => 'index')); ?></li>
    <br/>
    <li><?=$this->Html->link('Todos Alunos',array('controller' => 'Alunos', 'action' => 'alunos')); ?></li>

    <?php $this->end(); ?>
<div id="main_div">
    <table>
    <tr>
            <td><b>RA</b></td> 
            <td><b>NOME</b></td>
            <td><b>EMAIL</b></td>
            <td><b>AÇÃO</b></td>
    </tr>

<?php foreach($alunos as $l){ ?>
    <tr>
               <td><?=$l['Aluno']['username']; ?></td>
               <td><?=$l['Aluno']['nome']; ?></td>
               <td><?=$l['Aluno']['email']; ?></td>
               <td><?=$this->Biblioteca->DetalhesAluno($l['Aluno']['id']).' | '.
                        $this->Biblioteca->EditarAluno($l['Aluno']['id']); ?></td>
        </tr>
<?php  }  ?>

</table>
</div>

    <br/>