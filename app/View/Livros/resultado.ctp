<?php
$this->set("title_for_layout", "Resultado da Busca"); 
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' LIVROS ',array('controller' => 'Livros', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' BUSCAR ',array('controller' => 'Livros', 'action' => 'buscar')).
        $this->Html->image('../img/arrow.png').'<b> RESULTADO </b>');
?>
<table>
    <tr>
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
               <td><?=$this->Html->link($l[0]['titulo'],array('controller' => 'Titulos', 'action' => 'view',$l[0]['id'])); ?></td>
               <td><?php
                                $txt = "";
                                $autor = explode(',',$l[0]['autores']);
                                foreach($autor as $a){
                                    $txt .= str_replace(array('"','{','}'), '',$a).'<br>';
                                }
                                echo $txt;
                           ?>
               </td>
               <td><?=$l[0]['localizacao']; ?></td>
               <td><?php
                                $txt = "";
                                $cla = explode(',',$l[0]['classificacaos']);
                                foreach($cla as $a){
                                    $txt .= str_replace(array('"','{','}'), '',$a).'<br>';
                                }
                                echo $txt;
                           ?>
               </td>
               <td><?php
                                $txt = "";
                                $ass = explode(',',$l[0]['assuntos']);
                                foreach($ass as $a){
                                    $txt .= str_replace(array('"','{','}'), '',$a).'<br>';
                                }
                                echo $txt;
                           ?>
               </td>
               <td><?=$l[0]['exemplares']; ?></td>
               <td><?=$l[0]['disponiveis']; ?></td>
        </tr>
<?php  }  ?>

</table>
