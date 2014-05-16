<?php
    class LocalizacaosController extends AppController{
        
        public  $name = "Localizacaos";
        public  $helpers = array("AutoComplete", "Js");
        //$javascript->link('jquery/jquery.min', false);
        //$javascript->link('webroot/js/View/Helper/autocomplete', false);


        public function index() {
            $this->paginate = array('limit' => 10);//, 'order' => array( 'Livro.' => 'asc'));
            $livros = $this->paginate('Livro');
                        
            $this->set(compact('livros'));
            //   pr($copias);exit(0);//    
        }
        
        public function add(){
            if ($this->data){
                if($this->Localizacao->save($this->data)){
                    $this->Session->setFlash("Localização adicionada com sucesso");
                    $this->data = array();
                }
            }
        }
        
        public function edit($id = null){
            if($this->data){
                if ($this->Copia->save($this->data)) {
                    $this->Session->setFlash("Alteracoes armazenadas com sucesso!");
                }
                $this->redirect(array('controller' => 'Copias', 'action' => 'view',$id));
            }else{
                $this->data = $this->Copia->read(null, $id);
            }
        }
        
        public function delete($id = null){
            if($id){
                if($this->Copia->delete($id)){
                    $this->Session->setFlash("Livro excluido com sucesso!");
                }
                $this->redirect(array('controller' => 'Copias', 'action' => 'index'));
            }
        }
        
        public function view($id = null){
            if($id){
                $copia = $this->Copia->read(null, $id);
                $this->set(compact("copia"));
                //pr($escola);exit(0);
            }
        }
        
        public function getTitulo(){
            $titulo = $this->Livro->Titulo->find('list',array('fields' => array( 'id', 'titulo')));
            $this->set(compact('titulo'));
        }
        
        public function getAutors(){
            $autor = $this->Livro->Autor->find('list',array('fields' => array( 'id', 'nome'),
                                'order'=>'nome'));
            $this->set(compact('autor'));
        }
        
        public function getLocalizacao(){
            $localizacao = $this->Livro->Localizacao->find('list',array('fields' => array( 'id', 'nome'),
                                'order'=>'nome'));
            $this->set(compact('localizacao'));
        }
        
        function auto_complete() { 
               $localizacao = $this->Localizacao->find('all', array( 
                    'conditions' => array( 
                        'Localizacao.nome LIKE' => $this->params['url']['autoCompleteText'].'%' 
                    ), 
                    'fields' => array('nome'), 
                    'limit' => 3, 
                    'recursive'=>-1
                )); 
                $localizacao = Set::Extract($localizacao,'{n}.Localizacao.nome'); 
                $this->set('localizacao', $localizacao); 
                $this->layout = 'ajax';   
      } 
    }
        
?>
