
<?php  
if(!$this->Session->check('Auth.User') ||
       $this->Session->read('Auth.User.role') === 'user'  ){ ?>
    <li><?=$this->Html->link('Livros',array('controller' => 'Livros', 'action' => 'index')); ?></li>
<?php }else if($this->Session->read('Auth.User.role') === 'sadmin' ||
        $this->Session->read('Auth.User.role') === 'admin') { ?>
<li>
        <a href='#'>Cadastros</a>
        <ul>
            <li><?=$this->Html->link('Alunos',array('controller' => 'Alunos', 'action' => 'index'));?></li>
            <li><?=$this->Html->link('Assuntos',array('controller' => 'Assuntos', 'action' => 'index'));?></li>
            <li><?=$this->Html->link('Autores',array('controller' => 'Autors', 'action' => 'index'));?></li>
            <li><?=$this->Html->link('Classificações',array('controller' => 'Classificacaos', 'action' => 'index'));?></li>
            <li><?=$this->Html->link('Editoras',array('controller' => 'Editoras', 'action' => 'index'));?></li>
            <li><?=$this->Html->link('Empréstimos',array('controller' => 'Emprestimos', 'action' => 'index'));?></li>
            <li><?=$this->Html->link('Idiomas',array('controller' => 'Idiomas', 'action' => 'index'));?></li>
            <li><?=$this->Html->link('Livros',array('controller' => 'Livros', 'action' => 'index'));?></li>
            <li><?=$this->Html->link('Localizações',array('controller' => 'Localizacaos', 'action' => 'index'));?></li>
            <li><?=$this->Html->link('Títulos',array('controller' => 'Titulos', 'action' => 'index'));?></li>
        </ul>
    </li>
<li><?=$this->Html->link('Relatórios',array('controller' => 'Relatorios', 'action' => 'index')); ?></li>
<?php }  ?>