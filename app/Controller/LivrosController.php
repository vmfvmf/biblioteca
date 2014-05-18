<?php
    class LivrosController extends AppController{
        
        public  $name = "Livros";
        
        public function index() {
            $this->paginate = array('limit' => 10, 'recursive' => 2,
              'order' => array( 'Livro.Titulo.titulo' => 'asc'));
            $livros = $this->paginate('Livro');
            $this->set(compact('livros'));
             
            //pr($livros);exit(0);//    
        }
        
        public function add(){
            if ($this->data){
                if($this->Livro->save($this->data)){
                    $this->Session->setFlash("Livro adicionado com sucesso");
                    $this->data = array();
                }
            }
            self::getTitulosList();
            self::getEditoras();
            self::getIdiomas();
        }
        
        public function edit($id = null){
            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }
            $livro = $this->Livro->findById($id);
            if (!$livro) {
                throw new NotFoundException(__('Invalid Livro'));
            }
            if ($this->request->is(array('livro', 'put'))) {
                $this->Livro->id = $id;
            if ($this->Livro->save($this->request->data)) {
                $this->Session->setFlash(__('Your livro has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
                $this->Session->setFlash(__('Unable to update your livro.'));
            }
            if (!$this->request->data) {
                $this->request->data = $livro;
            }
            self::getTitulosList();
            self::getEditoras();
            self::getIdiomas();
        }
        
        public function delete($id = null){
            if($id){
                if($this->Livro->delete($id)){
                    $this->Session->setFlash("Livro excluido com sucesso!");
                }
                $this->redirect(array('controller' => 'Livros', 'action' => 'index'));
            }
        }
        
        public function view($id = null){
            if($id){
                $this->paginate = array('limit' => 10, 'recursive' => 2,
                    'order' => array( 'Livro.Titulo.titulo' => 'asc'),
                    'conditions' => array('Livro.id =' => $id));
                $livros = $this->paginate('Livro');
                $this->set(compact("livros"));
                //pr($livros);exit(0);
            }
        }
        
        public function getTitulosList(){
            $titulos = $this->Livro->Titulo->find('list',array('fields' => array( 'id', 'titulo'),
                                'order'=>'titulo'));
            $this->set(compact('titulos'));
        }
        
        public function getTitulos(){
           $this->Livro->Titulo->Behaviors->load('Containable');
           $titulos = $this->Livro->Titulo->find('all');
           $this->set(compact('titulos'));
           //pr($titulos); exit(0);
        }
        public function getAutors(){
            $autor = $this->Livro->Titulo->Autor->find('list',array('fields' => array( 'id', 'nome'),
                                'order'=>'nome'));
            $this->set(compact('autor'));
        }
        
        function autoComplete() {
            if ($this->request->is('ajax'))
            {
                $query = $this->params['url']['query'];
                $this->set('query', $query);

                $local = $this->Localizacao->find('all', array(
                    'conditions' => array(
                        'OR' => array(
                            'Localizacao.nome LIKE' => '%'.$query.'%'
                        )),
                    'fields' => array(
                        'Localizacao.id', 'Localizacao.nome'
                        )
                    ));

                $locais = array();
                $id = array();
                foreach ($local as $cust) {
                    array_push($locais, $cust['Localizacao']['nome']);
                    array_push($id, $cust['Localizacao']['id']);
                }
                $this->set('suggestions', $locais);
                $this->set('data', $id);
                $this->set('_serialize', array('query', 'suggestions', 'data'));        
            }
        }
        
        public function getIdiomas(){
            $idiomas = $this->Livro->Idioma->find('list',array('fields' => array( 'id', 'nome'),
                                'order'=>'nome'));
            $this->set(compact('idiomas'));
        }
        
        public function getEditoras(){
            $editoras = $this->Livro->Editora->find('list',array('fields' => array( 'id', 'editora'),
                                'order'=>'editora'));
            $this->set(compact('editoras'));
        }
        
        function auto_complete() { 
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
        } 
    }
        
?>
