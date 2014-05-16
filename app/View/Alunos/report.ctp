<?php
$this->set("title_for_layout", "Escolas");  
$this->layout = 'print';
?>
<?php echo $this->Html->link(__('Export to excel'), array('action' => 'export_xls')); ?>
<div class='relatorio'>
<h1>DIRETORIA DE ENSINO DE ITAPEVA | CIE - 20305</h1>

<table>
    <thead>
        <td><b>MUNICÍPIO</b></td>     
        <td><b>ESCOLAS ESTADUAIS</b></td> 
            <td><b>CIE</b></td> 
            <td><b>ENDEREÇO</b></td> 
            <td><b>TELEFONE</b></td> 
    </thead>
    
<? foreach($escolas as $escola){  ?>
        <tr>
               <td><?=$escola['Cidade']['nome']; ?></td>
               <td><?=$escola['Escola']['nome']; ?></td>
               <td><?=$escola['Escola']['cie']; ?></td>
               <td><?=$escola['Escola']['rua'].', '.$escola['Escola']['numero'].' - '.$escola['Escola']['bairro']; ?> </td>
               <td>
                   
                   <? 
                        $contatos = '';
                        
                        foreach($escola['Escolacontato'] as $contato){ 
                            if($contato['tipo'] == 'C' || $contato['tipo'] == 'T') {
                                $contatos .= $contato['contato'] . ' / ';
                            }
                         }  
                         echo $contatos;
                         ?>

               </td>
        </tr>
<?  }  ?>
</table>
</div>
<br/>
<br/>
