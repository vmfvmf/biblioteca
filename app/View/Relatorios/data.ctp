<br>
<hr>
<br>
<h1>DADOS DO ALUNO</h1>
<table>
    <tr>
        <td colspan="6"><hr></td>
    </tr>
    <tr>
        <td><b>NOME</b></td>
        <td><?=$aluno['Aluno']['nome'];?></td>
        <td><b>RA</b></td>
        <td><?=$aluno['Aluno']['ra'];?></td>
        <td><b>SÉRIE</b></td>
        <td><?=$aluno['Aluno']['ano_serie'];?></td>
    </tr>
</table>
<br>
<hr>
<br>
<h1>5 LIVROS MAIS EMPRESTADOS</h1>
<table>
    <thead>
        <td><b>TÍTULO</b></td>
        <td><b>QTD EMPRÉSTIMOS</b></td>
        <td><b>PRIMEIRO EMPRÉSTIMO</b></td>
        <td><b>ULTIMO EMPRÉSTIMO</b></td>
    </thead>
    <?php foreach ($dados as $d){?>
    <tr>
        <td><?=$d[0]['titulo'];?></td>
        <td><?=$d['0']['count'];?></td>
        <td><?=$this->Time->format($d['0']['min'], '%d/%m/%Y'); ?></td>
        <td><?=$this->Time->format($d['0']['max'], '%d/%m/%Y'); ?></td>
    </tr>
    <?php }?>
</table>
<br>
<hr>
<br>
<h1>DEVOLUÇÕES ATRASADAS</h1>
<table>
    <thead>
        <td><b>TÍTULO</b></td>
        <td><b>DATA EMPRÉSTIMO</b></td>
        <td><b>PRAZO DEVOLUÇÃO</b></td>
        <td><b>DATA DEVOLUÇÃO</b></td>
        <td><b>DIAS DE ATRASO</b></td>
    </thead>
    <?php foreach ($atrasos as $d){?>
    <tr>
        <td><?=$d['0']['titulo'];?></td>
        <td><?=$this->Time->format($d['0']['data_emprestimo'], '%d/%m/%Y'); ?></td>
        <td><?=$this->Time->format($d['0']['prazo_devolucao'], '%d/%m/%Y'); ?></td>
        <td><?=$this->Time->format($d['0']['data_devolucao'], '%d/%m/%Y'); ?></td>
        <td><?=$d[0]['atraso']; ?></td>
    </tr>
    <?php }?>
</table>