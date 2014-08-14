<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->set("title_for_layout", "Buscar Empréstimo"); 
$this->extend('/Common/view');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').'<b> EMPRÉSTIMOS </b>');

echo $this->Html->script('jquery', false);
echo $this->Html->script('jquery-ui', false);
    echo $this->Html->script('ui.multiselect', false);
    echo     $this->Html->css('ui.multiselect', null, array('inline' => false));

        $this->start('sidebar');
    ?>
    <li><?=$this->Html->link('Novo Empréstimo',array('controller' => 'Emprestimos', 'action' => 'add')); ?></li>
    <br/>
    <li><?=$this->Html->link('Todos Empréstimos',array('controller' => 'Emprestimos', 'action' => 'emprestimos')); ?></li>
    <?php $this->end(); ?>
<div id="main_div">
    <div id="accordion"> 
        <h3 class="divh3">-> RA Aluno</h3>
        <div>
        <?= $this->Form->create(),   
            $this->Form->input("ra", array("type"=>"text", "label"=>"", 
                "class"=>"autocomplete", 'id' => 'ra')),
            $this->Form->input("tipo", array("type"=>"hidden", "value"=>"ra")  ),
            $this->Form->end("Buscar"); ?>
        </div>
        <h3 class="divh3">-> Data Empréstimo</h3>
        <div>
        <?= $this->Form->create(),   
            $this->Form->input("dataEmp", array("type"=>"text", "label"=>"", 
                'id' => 'dataEmp', 'class' => 'calendario')),
            $this->Form->input("tipo", array("type"=>"hidden", "value"=>"dataEmp")  ),
            $this->Form->end("Buscar"); ?>
        </div>
</div>
</div>
    <?php
 $scrip = 'var accentMap = { "ã": "a" , "Ã" : "a", "Â":"a", "â":"a", "à":"a", "À":"a", "á":"a","Á":"a",
                "é":"e" , "è" : "e", "É":"e", "È":"e", 
                "í": "i" , "Í":"i", "Ì":"i", "ì":"i",
                "õ":"o" , "Õ":"o","Ô":"o", "ô":"o", "Ó":"o", "ó":"o", "Ò":"o","ò":"o",
                "ú": "u" , "Ú" : "u", "Ù":"u", "ù":"u", "Ç":"c", "ç":"c"};
            var ras = [';
            foreach($ras as $key => $al){
                $scrip .= '{label:"'.$al.'" , value:"'.$key.'" },';
            }
            $scrip = substr($scrip, 0, strlen($scrip)-1);
        $scrip .= '];
           $(function(){
            var normalize = function( term ) {
                var ret = "";
                for ( var i = 0; i < term.length; i++ ) {
                  ret += accentMap[ term.charAt(i) ] || term.charAt(i);
                }
                return ret;
            };
            $(".calendario").datepicker(
                            {   defaultDate: "today",
                                dateFormat: "dd/mm/yy",
                                dayNames: ["Domingo","Segunda","Terça","Quarta","Quinta","Sexta","Sábado"],
                                dayNamesMin: ["D","S","T","Q","Q","S","S"],
                                dayNamesShort: ["Dom","Seg","Ter","Qua","Qui","Sex","Sáb"],
                                monthNames: ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],
                                monthNamesShort: ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"],
                                nextText: "Próx",
                                prevText: "Ante",
                                changeYear: true,
                                changeMonth: true,
                            }
                        );
            $( "#ra" ).autocomplete({source: ras});           
            $( ".autocomplete" ).autocomplete({
                select: function( event, ui ) {
                    $( "#ra" ).val( ui.item.label);
			return false;
		},focus: function( event, ui ) {
                    $( ".autocomplete" ).val( ui.item.label);
			return false;}
            })
            ;});';
    $this->Html->scriptStart(array('inline' => false));
    
    echo $scrip.
        '
            $(function() { $( ".autocomplete" ).autocomplete();
            $(".multiselect").multiselect();
            $(document).tooltip();
            $( "#accordion" ).accordion();
            
        });';
    $this->Html->scriptEnd();
    echo $this->Js->writeBuffer();
    ?>
