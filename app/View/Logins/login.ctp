<?php
    echo $this->Html->script('jquery', false);
    echo $this->Html->script('jquery-ui', false);
    echo $this->Html->css('jquery-ui', null, array('inline' => false));

   echo $this->Form->create(),
           $this->Form->input("usuario"),
           $this->Form->input("senha",array("type" => "password")),
          $this->Form->end("Logar");
    ?>