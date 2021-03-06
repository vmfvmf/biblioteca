<?php
    class AlunosController extends AppController{
        
        public  $name = "Alunos";
        public $uses = array("Aluno", "Viewaluno");
        
        public function todos() {
            $this->paginate = array('limit' => 10);//, 'order' => array( 'Livro.' => 'asc'));
            $alunos = $this->paginate('Viewaluno');
                        
            $this->set(compact('alunos'));
        }
        //return $this->redirect($this->referer());
        public function add(){
            if ($this->data){
                if($this->Aluno->saveAll($this->data)){
                    $this->Aluno->saveField('role', 'user');
                    $this->Aluno->saveField('password', $this->data['Aluno']['username']);
                    $this->Session->setFlash(__('Aluno cadastrado.', null),
                            'default', 
                             array('class' => 'notice success'));
                    
                    return $this->redirect(array('action' => 'index'));
                }
            }
        }
        
        public function edit($id = null){
            if (!$id) {
                throw new NotFoundException(__('Invalid aluno'));
            }
            $aluno = $this->Aluno->findById($id);
            if (!$aluno) {
                throw new NotFoundException(__('Invalid aluno'));
            }
            if ($this->request->is(array('$aluno', 'put'))) {
                $this->Aluno->id = $id;
            if ($this->Aluno->save($this->request->data)) {
                $this->Session->setFlash(__('Aluno atualizado.', null),
                            'default', 
                             array('class' => 'notice success'));
                return $this->redirect(array('action' => 'index'));
            }
                $this->Session->setFlash(__('Não foi possível atualizar aluno.'));
            }
            if (!$this->request->data) {
                $this->request->data = $aluno;
            }
        }
        
        public function delete($id = null){
            if($id){
                if($this->Aluno->delete($id)){
                    $this->Session->setFlash(__('Aluno excluído.', null),
                            'default', 
                             array('class' => 'notice'));
                }
                return $this->redirect($this->referer());
            }
        }
        
        
        public function view($aluno_id = null){
            if($aluno_id){
                $aluno = $this->Viewaluno->read(null, $aluno_id);
                $this->set(compact("aluno"));
            }
        }
        
        public function getNomes(){
            $nomes = $this->Aluno->find('list',array('fields' => array( 'id', 'nome'),
                                'order'=>'nome'));
            $this->set(compact('nomes'));
        }
        
        public function getRAs(){
            $ras = $this->Aluno->find('list',array('fields' => array( 'id', 'username'),
                                'order'=>'username'));
            $this->set(compact('ras'));
        }
        
        public function index(){
            if ($this->data){
                switch($this->data["Aluno"]["tipo"]){
                    case "nome":
                        return $this->redirect(array('controller' => 'Alunos', 'action' => 'resultado',
                            $this->data["Aluno"]["tipo"],$this->data["Aluno"]["nome"]));
                    case "ra":
                        return $this->redirect(array('controller' => 'Alunos', 'action' => 'resultado',
                            $this->data["Aluno"]["tipo"],$this->data["Aluno"]["ra"]));
                }
            }
            self::getNomes();
            self::getRAs();            
        }
        
        public function resultado($tipo = null, $valor = null){
            if($tipo && $valor){
                switch($tipo){
                    case "nome":
                        $alunos = $this->Aluno->find('all',array(
                            'conditions'=>array("nome ilike '%".$valor."%'")));
                        $this->set(compact('alunos'));
                        //self::checkRetornoBusca($alunos);
                        break;
                    case "ra":
                        $alunos = $this->Aluno->find('all',array(
                            'conditions'=>array("username ilike '%".$valor."%'")));
                        $this->set(compact('alunos'));
                        //self::checkRetornoBusca($alunos);
                        break;
                }
                //pr($alunos);exit(0);
            }else{
                $this->paginate = array('limit' => 10, 'recursive' => 1,
                    'order' => array( 'Viewlivrosdetalhe.titulo' => 'asc'));
                $livros = $this->paginate('Viewlivrosdetalhe');
                $this->set(compact('livros'));
            }
                
        }
        
        public function getLocalizacao(){
            $localizacao = $this->Titulo->Localizacao->find('list',array('fields' => array( 'id', 'nome'),
                                'order'=>'nome'));
            $this->set(compact('localizacao'));
        }
        
    }      
?>