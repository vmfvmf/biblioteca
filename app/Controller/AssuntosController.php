<?php
    class AssuntosController extends AppController{
        
        public  $name = "Assuntos";
        
        public function index() {
            $this->paginate = array('limit' => 10);//, 'order' => array( 'Livro.' => 'asc'));
            $assuntos = $this->paginate('Assunto');
                        
            $this->set(compact('assuntos'));
            //pr($autors); exit(0);
        }
        
        public function add(){
            if ($this->data){
                if($this->Assunto->save($this->data)){
                    $this->Session->setFlash(__('Assunto cadastrado.'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
        }
        
        public function edit($id = null){
            if (!$id) {
                throw new NotFoundException(__('Invalid assunto'));
            }
            $ass = $this->Assunto->findById($id);
            if (!$ass) {
                throw new NotFoundException(__('Invalid assunto'));
            }
            if ($this->request->is(array('$ass', 'put'))) {
                $this->Assunto->id = $id;
            if ($this->Assunto->save($this->request->data)) {
                $this->Session->setFlash(__('Assunto atualizado.'));
                return $this->redirect(array('action' => 'index'));
            }
                $this->Session->setFlash(__('Não foi possível atualizar o assunto.'));
            }
            if (!$this->request->data) {
                $this->request->data = $ass;
            }
        }
        
        public function delete($id = null){
            if($id){
                if($this->Titulo->delete($id)){
                    $this->Session->setFlash("Titulo excluido com sucesso!");
                }
                $this->redirect(array('controller' => 'Titulos', 'action' => 'index'));
            }
        }
        
        public function getCategorias(){
            $categorias = $this->Titulo->Categoria->find('list',array('fields' => array( 'id', 'categoria'),
                                'order'=>'categoria'));
            $this->set(compact('categorias'));
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