<?php
    class TitulosController extends AppController{
        
        public  $name = "Titulos";
        
        public function index() {
            $this->paginate = array('limit' => 10,'contain' => array('Autor'), 'recursive' => 0);//, 'order' => array( 'Livro.' => 'asc'));
            $titulos = $this->paginate('Viewtitulosdetalhe');
                        
            $this->set(compact('titulos'));
           // pr($titulos);
        }
        
        public function add(){
            if ($this->data){
                if($this->Titulo->save($this->data)){
                    $this->Session->setFlash(__('Cadastrado com sucesso!', null),
                            'default', 
                             array('class' => 'notice success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            self::getDepends();
        }
        
        public function edit($id = null){
           if (!$id) {
                throw new NotFoundException(__('Invalid titulo'));
            }
            $titulo = $this->Titulo->find('first', array(
                'conditions' => array('Titulo.id' => $id ), // URL to fetch the required page
                'recursive' => 1
            ));
            if (!$titulo) {
                throw new NotFoundException(__('Invalid titulo'));
            }
            if ($this->request->is(array('$titulo', 'put'))) {
                $this->Titulo->id = $id;
            if ($this->Titulo->save($this->request->data)) {
                $this->Session->setFlash(__('Atualizado com sucesso!', null),
                            'default', 
                             array('class' => 'notice success'));
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
                    $this->Session->setFlash(__('Excluído com sucesso!', null),
                            'default', 
                             array('class' => 'notice'));
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
            }
        }
        
        public function getAutors(){
            $autors = $this->Titulo->Autor->find('list',array('fields' => array( 'id', 'autor'),
                                'order'=>'autor'));
            $this->set(compact('autors'));
        }
        
        
        
        public function getLocalizacao(){
            $localizacao = $this->Titulo->Localizacao->find('list',array('fields' => array( 'id', 'localizacao'),
                                'order'=>'localizacao'));
            $this->set(compact('localizacao'));
        }
        
    }      
?>