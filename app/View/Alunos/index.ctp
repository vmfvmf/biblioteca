<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->set("title_for_layout", "Buscar Aluno"); 
$this->extend('/Common/view');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').'<b> BUSCAR ALUNOS </b>');

echo $this->Html->script('jquery', false);
echo $this->Html->script('jquery-ui', false);
    echo $this->Html->script('ui.multiselect', false);
    echo     $this->Html->css('ui.multiselect', null, array('inline' => false));

        $this->start('sidebar');
    ?>
    <li><?=$this->Html->link('Novo Aluno',array('controller' => 'Alunos', 'action' => 'add')); ?></li>
    <br/>
    <li><?=$this->Html->link('Todos Alunos',array('controller' => 'Alunos', 'action' => 'alunos')); ?></li>
    <?php $this->end(); ?>
<div id="main_div">
    <div id="accordion"> 
        <h3 class="divh3">Por Nome</h3>
            <div>
                <?php
                    echo $this->Form->create(),
                         $this->Form->input("nome", array("type"=>"text", "label"=>"", 
                             "class"=>"autocomplete", 'id'=>'nome')),
                         $this->Form->input("tipo", array("type"=>"hidden", "value"=>"nome")  ),
                         $this->Form->end("Buscar");
                ?>
            </div>

        <h3 class="divh3">Por RA</h3>
        <div>
        <?php echo $this->Form->create(),   
                $this->Form->input("ra", array("type"=>"text", "label"=>"", 
                    "class"=>"autocomplete", 'id' => 'ra')),
                $this->Form->input("tipo", array("type"=>"hidden", "value"=>"ra")  ),
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
            var names = [';
            foreach($nomes as $key => $al){
                $scrip .= '{label:"'.$al.'" , value:"'.$key.'" },';
            }
            $scrip = substr($scrip, 0, strlen($scrip)-1);
        $scrip .= ']; var ras = [';
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
            $( "#nome" ).autocomplete({
                source: function( request, response ) {
                        var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
                        response( $.grep( names, function( value ) {
                          value = value.label || value.value || value;
                          return matcher.test( value ) || matcher.test( normalize( value ) );
                        }) );
                      }}); 
            $( "#ra" ).autocomplete({source: ras});           
            $( ".autocomplete" ).autocomplete({
                select: function( event, ui ) {
                    $( this ).val(ui.item.value);
                    $( ".autocomplete" ).val( ui.item.label);
			return false;
		},focus: function( event, ui ) {
                    $( ".autocomplete" ).val( ui.item.label);
			return false;}
            });});';
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
