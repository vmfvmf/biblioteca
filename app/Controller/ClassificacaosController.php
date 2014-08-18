<?php
    class ClassificacaosController extends AppController{
        
        public  $name = "Classificacaos";
        
        public function index() {
            $this->paginate = array('limit' => 10, 'order' => array('classificacao' => 'asc'));
            $classificacao = $this->paginate('Classificacao');
            $this->set(compact('classificacao'));
        }
        
        public function add(){
            if ($this->data){
                if($this->Classificacao->save($this->data)){
                    $this->Session->setFlash(__('Classificação cadastrada', null),
                            'default', 
                             array('class' => 'notice success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
        }
        
        public function edit($id = null){
            if (!$id) {
                throw new NotFoundException(__('Invalid assunto'));
            }
            $ass = $this->Classificacao->findById($id);
            if (!$ass) {
                throw new NotFoundException(__('Invalid assunto'));
            }
            if ($this->request->is(array('$ass', 'put'))) {
                $this->Classificacao->id = $id;
            if ($this->Classificacao->save($this->request->data)) {
                $this->Session->setFlash(__('Classificação atualizada', null),
                            'default', 
                             array('class' => 'notice success'));
                return $this->redirect(array('action' => 'index'));
            }
                $this->Session->setFlash(__('Não foi possível atualizar o classificação.'));
            }
            if (!$this->request->data) {
                $this->request->data = $ass;
            }
        }
        
        public function delete($id = null){
            if($id){
                if($this->Classificacao->delete($id)){
                    $this->Session->setFlash(__('Classificação excluída', null),
                            'default', 
                             array('class' => 'notice'));
                }
                $this->redirect(array('controller' => 'Classificacaos', 'action' => 'index'));
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