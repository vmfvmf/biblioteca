<?php
    class TitulosController extends AppController{
        
        public  $name = "Titulos";
        
        public function index() {
            $this->paginate = array('limit' => 10);//, 'order' => array( 'Livro.' => 'asc'));
            $titulos = $this->paginate('Titulo');
                        
            $this->set(compact('titulos'));
        }
        
        public function add(){
            if ($this->data){
                if($this->Titulo->save($this->data)){
                    $this->Session->setFlash(__('Titulo adicionado.'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            self::getLocalizacao();
            self::getAutors();
            self::getClassificacaos();
            self::getAssuntos();
        }
        
        public function edit($id = null){
           if (!$id) {
                throw new NotFoundException(__('Invalid titulo'));
            }
            $titulo = $this->Titulo->findById($id);
            if (!$titulo) {
                throw new NotFoundException(__('Invalid titulo'));
            }
            if ($this->request->is(array('$titulo', 'put'))) {
                $this->Titulo->id = $id;
            if ($this->Titulo->save($this->request->data)) {
                $this->Session->setFlash(__('Titulo atualizado.'));
                return $this->redirect(array('action' => 'index'));
            }
                $this->Session->setFlash(__('Não foi possível atualizar titulo.'));
            }
            if (!$this->request->data) {
                $this->request->data = $titulo;
            }
            self::getDepends();
        }
        
        public function getDepends(){
            self::getLocalizacao();
            self::getAutors();
            self::getClassificacaos();
            self::getAssuntos();
        }
        
        public function delete($id = null){
            if($id){
                if($this->Titulo->delete($id)){
                    $this->Session->setFlash("Titulo excluido com sucesso!");
                }
                $this->redirect(array('controller' => 'Titulos', 'action' => 'index'));
            }
        }
        
        public function getClassificacaos(){
            $classificacaos = $this->Titulo->Classificacao->find('list',array('fields' => array( 'id', 'classificacao'),
                                'order'=>'classificacao'));
            $this->set(compact('classificacaos'));
        }
        
        public function getAssuntos(){
            $assuntos = $this->Titulo->Assunto->find('list',array('fields' => array( 'id', 'assunto'),
                                'order'=>'assunto'));
            $this->set(compact('assuntos'));
        }
        
        public function view($id = null){
            if($id){
                $titulo = $this->Titulo->read(null, $id);
                $this->set(compact("titulo"));
                self::getLocalizacao();
            self::getAutors();
            self::getCategorias();
                //pr($titulo);exit(0);
            }
        }
        
        public function getAutors(){
            $autors = $this->Titulo->Autor->find('list',array('fields' => array( 'id', 'nome'),
                                'order'=>'nome'));
            $this->set(compact('autors'));
        }
        
        
        
        public function getLocalizacao(){
            $localizacao = $this->Titulo->Localizacao->find('list',array('fields' => array( 'id', 'nome'),
                                'order'=>'nome'));
            $this->set(compact('localizacao'));
        }
        
     /*   function auto_complete() { 
            $localizacaos = $this->Localizacao->find('all', array( 
                'conditions' => array( 
                    'Localizacao.nome LIKE' => $this->params['url']['autoCompleteText'].'%' 
                ), 
                'fields' => array('nome'), 
                'limit' => 3, 
                'recursive'=>-1, 
            )); 
            $localizacaos2 = Set::Extract($localizacaos,'{n}.Localizacao.nome'); 
            $this->set('localizacaos', $localizacaos2); 
            $this->layout = 'ajax';     
          } */
    }      
?>