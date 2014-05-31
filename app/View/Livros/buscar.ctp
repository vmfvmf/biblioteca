<?php
$this->set("title_for_layout", "Buscar Livro"); 
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' LIVROS ',array('controller' => 'Livros', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> BUSCAR </b>');

echo $this->Html->script('jquery', false);
echo $this->Html->script('jquery-ui', false);
    echo $this->Html->script('ui.multiselect', false);
    echo     $this->Html->css('ui.multiselect', null, array('inline' => false));
?>
    <div id="accordion"> 
        <h3 class="divh3">Por Título</h3>
            <div>
                <?php
                    echo $this->Form->create(),
                         $this->Form->input("titulo", array("type"=>"text", "label"=>"Título", "class"=>"autocomplete")),
                         $this->Form->input("tipo", array("type"=>"hidden", "value"=>"titulo")  ),
                         $this->Form->end("Buscar");
                ?>
            </div>

        <h3 class="divh3">Por Autores</h3>
        <div>
        <?php echo $this->Form->create(),   
                $this->Form->input('Autor', array(
                                 'label' => __('Autores',true),
                                 'type' => 'select',
                                 'options'=>$autor,
                                  'class' => 'multiselect',
                                  'multiple' => 'multiple',
                                  'style' => 'clear: none !important; width:460px; height:200px;')), 
                $this->Form->input("tipo", array("type"=>"hidden", "value"=>"autors")  ),
                $this->Form->end("Buscar"); ?>
        </div>
        <h3 class="divh3">Por Classificação</h3>
        <div>
        <?php echo $this->Form->create(),   
                $this->Form->input('Classificacao', array(
                                  'label' => __('Classificações',true),
                                  'type' => 'select',
                                    'class' => 'multiselect',
                                  'multiple' => 'multiple',
                                  'options'=>$classificacaos,
                    'style' => 'clear: none !important; width:460px; height:200px;')),
                $this->Form->input("tipo", array("type"=>"hidden", "value"=>"classificacaos")  ),
                $this->Form->end("Buscar"); ?>
        </div>
        <h3 class="divh3">Por Assuntos</h3>
        <div>
       <?php echo  $this->Form->create(),   
          $this->Form->input('Assunto', array(
                              'label' => __('Assuntos',true),
                              'type' => 'select',
                                'class' => 'multiselect',
                              'multiple' => 'multiple',
                              'options'=>$assuntos,
              'style' => 'clear: none !important; width:460px; height:200px;')),
               $this->Form->input("tipo", array("type"=>"hidden", "value"=>"asuntos")  ),
           $this->Form->end("Buscar");?>
        </div>

</div>
    <?php
    $scrip = 'var accentMap = { "ã": "a" , "Ã" : "a", "Â":"a", "â":"a", "à":"a", "À":"a", "á":"a","Á":"a",
                "é":"e" , "è" : "e", "É":"e", "È":"e", 
                "í": "i" , "Í":"i", "Ì":"i", "ì":"i",
                "õ":"o" , "Õ":"o","Ô":"o", "ô":"o", "Ó":"o", "ó":"o", "Ò":"o","ò":"o",
                "ú": "u" , "Ú" : "u", "Ù":"u", "ù":"u", "Ç":"c", "ç":"c"};
            var names = [';
        foreach($titulos as $key => $al){
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
            $( ".autocomplete" ).autocomplete(
             {
                source: function( request, response ) {
                        var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
                        response( $.grep( names, function( value ) {
                          value = value.label || value.value || value;
                          return matcher.test( value ) || matcher.test( normalize( value ) );
                        }) );
                      },
                select: function( event, ui ) {
                    $( "#titulo_id" ).val(ui.item.value);
                    $( ".autocomplete" ).val( ui.item.label);
                    $.get("data/"+ui.item.value,function(data,status)
                                  { /*$("#rel_div").html(data);*/ } );
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