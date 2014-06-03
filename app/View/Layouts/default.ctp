<?php
echo $this->Html->script('jquery', false);
echo $this->Html->script('jquery-ui', false);
echo $this->Html->script('easyaspie', false);
echo $this->Html->script('superfish', false);
echo $this->Html->script('modernizr', false);
echo $this->Html->script('jquery.fancybox', false);
echo $this->Html->css('jquery.fancybox', false);
echo $this->Html->css('fastwork', false);
echo $this->Html->css('jquery-ui');
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
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
                
                ?>
<script>
  $(function(){
      $('nav').easyPie();
      $(document).tooltip();
      $('.fancybox').fancybox();
});

</script>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?=$this->Html->link('Biblioteca','../'); ?></h1>

                        <div id="inner" style="display:none; width: 400px;">
                            <?=$this->element('login'); ?>
                        </div>
<nav>
<ul class="nav">
    <?=$this->fetch('menu-principal'); ?>
        <?php if($this->Session->check('Auth.User')){
            echo "<li>".$this->Html->link('Logout',array('controller' => 'Users', 'action' => 'logout'))."</li>";
        }else{ ?>
        <li><a href="#inner" class="fancybox">Login</a></li>
        <?php } ?>
</ul>
</nav>
                </div>
                <div id="fastwork"><?php echo $this->fetch('fastwork'); ?>
                    <div style="float:right;">
                      <?php if($this->Session->check('Auth.User')){  ?>
                      Seja bem vindo <?= $this->Session->read('Auth.User.username'); }?>
                    </div>
                </div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			
		</div>
	</div>
</body>
</html>

