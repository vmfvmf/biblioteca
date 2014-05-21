<?php
echo $this->Html->script('jquery', false);
echo $this->Html->script('jquery-ui', false);
echo $this->Html->script('easyaspie', false);
echo $this->Html->script('superfish', false);
echo $this->Html->script('modernizr', false);
echo $this->Html->css('fastwork', false);
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
                echo $this->Html->css('easy');
                echo $this->Html->css('jquery-ui');
                echo $this->Html->css('jquery-ui-min');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
                
                ?>
<script>
  $(function(){
      $('nav').easyPie();
});

</script>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?=$this->Html->link('Biblioteca','../'); ?></h1>
<nav>
<ul class="nav">
    <li><a href="#">Inicio</a></li>
    <li>
        <a href="#">Cadastros</a>
        <ul>
            <li><?=$this->Html->link('Alunos',array('controller' => 'Alunos', 'action' => 'index')); ?></li>
            <li><?=$this->Html->link('Assuntos',array('controller' => 'Assuntos', 'action' => 'index')); ?></li>
            <li><?=$this->Html->link('Autores',array('controller' => 'Autors', 'action' => 'index')); ?></li>
            <li><?=$this->Html->link('Classificações',array('controller' => 'Classificacaos', 'action' => 'index')); ?></li>
            <li><?=$this->Html->link('Editoras',array('controller' => 'Editoras', 'action' => 'index')); ?></li>
            <li><?=$this->Html->link('Empréstimos',array('controller' => 'Emprestimos', 'action' => 'index')); ?></li>
            <li><?=$this->Html->link('Livros',array('controller' => 'Livros', 'action' => 'index')); ?></li>
            <li><?=$this->Html->link('Localizações',array('controller' => 'Localizacaos', 'action' => 'index')); ?></li>
            <li><?=$this->Html->link('Relatórios',array('controller' => 'Relatorios', 'action' => 'index')); ?></li>
            <li><?=$this->Html->link('Títulos',array('controller' => 'Titulos', 'action' => 'index')); ?></li>
        </ul>
    </li>
</ul>
</nav>
                </div>
                <div id="fastwork"><? echo $this->fetch('fastwork'); ?></div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			
		</div>
	</div>
</body>
</html>

