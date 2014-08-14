<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->set("title_for_layout", "Resultado da Busca"); 
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' LIVROS ',array('controller' => 'Livros', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> RESULTADO </b>');

if($this->Session->read('Auth.User.role') == 'sadmin' ||
        $this->Session->read('Auth.User.role') == 'admin'){
    $this->extend('/Common/view');
$this->start('sidebar');
?>
<ul>
<li><?=$this->Html->link('Novo Livro',array('controller' => 'Livros', 'action' => 'add')); ?></li>
<br/>
<li><?=$this->Html->link('Buscar Livro',array('controller' => 'Livros', 'action' => 'index')); ?></li>
</ul>
<?php $this->end(); 
        }?>

<div id="main_div">
    <table>
        <tr>
            <td></td>
            <td><b>TÍTULO</b></td> 
            <td><b>AUTORES</b></td>
            <td><b>LOCALIZAÇÃO</b></td>
            <td><b>CLASSIFICAÇÕES</b></td>
            <td><b>ASSUNTOS</b></td>
            <td><b>EXEMPLARES</b></td>
            <td><b>DISPONÍVEIS</b></td>
        </tr>

<?php foreach($livros as $l){ ?>
        <tr>
            <td><?= $this->Biblioteca->DetalhesTitulo($l['Viewtitulosdetalhe']['id']);?></td>
            <td><?=$l['Viewtitulosdetalhe']['titulo']; ?></td>
            <td><?php
                                $txt = "";
                                $autor = explode(',',$l['Viewtitulosdetalhe']['autores']);
                                foreach($autor as $a){
                                    $txt .= str_replace(array('"','{','}'), '',$a).'<br>';
                                }
                                echo $txt;
                           ?>
            </td>
            <td><?=$l['Viewtitulosdetalhe']['localizacao']; ?></td>
            <td><?php
                                $txt = "";
                                $cla = explode(',',$l['Viewtitulosdetalhe']['classificacaos']);
                                foreach($cla as $a){
                                    $txt .= str_replace(array('"','{','}'), '',$a).'<br>';
                                }
                                echo $txt;
                           ?>
            </td>
            <td><?php
                                $txt = "";
                                $ass = explode(',',$l['Viewtitulosdetalhe']['assuntos']);
                                foreach($ass as $a){
                                    $txt .= str_replace(array('"','{','}'), '',$a).'<br>';
                                }
                                echo $txt;
                           ?>
            </td>
            <td><?=$l['Viewtitulosdetalhe']['exemplares']; ?></td>
            <td><?=$l['Viewtitulosdetalhe']['disponiveis']; ?></td>
        </tr>
<?php  }  ?>

    </table>

</div>