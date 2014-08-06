<?php 
    if (isset($l)){ ?>
    <tr>
           <td><?=$l[0]['Viewlivrosdetalhe']['id'];?></td>
           <td><?=$l[0]['Viewlivrosdetalhe']['titulo'];?></td>
           <td><?=$l[0]['Viewlivrosdetalhe']['editora'];?></td>
           <td><?=$l[0]['Viewlivrosdetalhe']['edicao'];?></td>
           <td><a href="#" class="rem-livro">remover</a></td>
    <tr>
<?php } ?>