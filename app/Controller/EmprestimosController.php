<?php
    class EmprestimosController extends AppController{
        
        public  $name = "Emprestimos";
        public $uses = array("Livro","Viewaluno","Viewlivrosdetalhe","Emprestimo", "Viewlte", "Emprestimos_livro");
        
        public function emprestimos() {
            $this->paginate = array('limit' => 10);
            $emprestimos = $this->paginate('Emprestimo');
            $this->set(compact('emprestimos'));
        }
        
        public function resultado($tipo = null, $valor = null){
            if($tipo && $valor){
                switch($tipo){
                    case "dataEmp":
                        $this->paginate = array('limit' => 10,
                            'conditions' => array("date(data_emprestimo) <=  '".
                                str_replace('-','/',$valor)."'"),
                            'order' => array('data_emprestimo' => 'DESC'));
                        $emprestimos = $this->paginate('Emprestimo');
                        if(!$emprestimos ){
                            $this->Session->setFlash(__('Busca sem resultado!', null),
                            'default', array('class' => 'notice'));
                            return $this->redirect(array('action' => 'index'));
                        }
                        $this->set(compact('emprestimos'));
                        break;
                    case "ra":
                        $this->paginate = array('limit' => 10,
                            'conditions' => array("Viewaluno.ra ilike  " => '%'.$valor.'%'),
                                'order' => array("Emprestimo.data_emprestimo" => "DESC"));
                        $emprestimos = $this->paginate('Emprestimo');
                        if(!$emprestimos ){
                            $this->Session->setFlash(__('Busca sem resultado!', null),
                            'default', array('class' => 'notice'));
                            return $this->redirect(array('action' => 'index'));
                        }
                        $this->set(compact('emprestimos'));
                        break;
                    case "livro":
                        $emps = $this->Viewlte->find('all',array(
                            'conditions' => array('livro_id'=>$valor)));
                        $valor = "";
                        foreach ($emps as $id) {
                            $valor .= $id['Viewlte']['emprestimo_id'] . ',';
                        }
                        $valor = substr($valor, 0, strlen($valor) - 1);
                        $this->paginate = array('limit' => 10,
                            'conditions' => "Emprestimo.id in (".$valor.")",
                                'order' => array("Emprestimo.data_emprestimo" => "DESC"));
                        $emprestimos = $this->paginate('Emprestimo');
                        if(!$emprestimos ){
                            $this->Session->setFlash(__('Busca sem resultado!', null),
                            'default', array('class' => 'notice'));
                            return $this->redirect(array('action' => 'index'));
                        }
                        $this->set(compact('emprestimos'));
                        break;
                }
            }else{
                $this->paginate = array('limit' => 10, 'recursive' => 1,
                    'order' => array( 'Viewlivrosdetalhe.titulo' => 'asc'));
                $livros = $this->paginate('Viewlivrosdetalhe');
                $this->set(compact('livros'));
            }
                
        }
        
        public function index(){
            if ($this->data){
                switch($this->data["Livro"]["tipo"]){
                    case "dataEmp":
                        return $this->redirect(array('controller' => 'Emprestimos', 'action' => 'resultado',
                            $this->data["Livro"]["tipo"],  str_replace("/","-",$this->data["Livro"]["dataEmp"])));
                    case "ra":
                        return $this->redirect(array('controller' => 'Emprestimos', 'action' => 'resultado',
                            $this->data["Livro"]["tipo"],$this->data["Livro"]["ra"]));
                        
                }
            }
            self::getRAs();
        }
        
        
        
        public function add(){
            if ($this->data){
                if (empty($this->data["Livro"]["Livro"])){ 
                    $this->Session->setFlash(__('Selecione um livro!', null),
                            'default');
                    return $this->redirect(array('action' => 'add'));
                    }
                if($this->Emprestimo->save($this->data)){
                    $email = $this->Emprestimo->Viewaluno->query(
                            "SELECT email FROM ALUNOS WHERE id = ".$this->data['Emprestimo']['aluno_id']); 
                    $this->Session->setFlash(__('Cadastrado com sucesso!', null),
                            'default', 
                             array('class' => 'notice success'));
                    //self::viewpdf($email[0][0]['email']);
                    //return $this->redirect(array('action' => 
                    //    'viewpdf/'.$email[0][0]['email'].'/'.$this->Emprestimo->id));
                    $this->Session->setFlash(__('Registrado com sucesso!', null),
                            'default', array('class' => 'notice success'));
                return $this->redirect(array('action' => 'index'));
                }
            }
            self::getAlunos();
            self::getLivros();
        }
        
        public function edit($id = null){
            if (!$id) {
                throw new NotFoundException(__('Invalid'));
            }
            $emp = $this->Emprestimolivros->findById($id);
            if (!$emp) {
                throw new NotFoundException(__('Invalid'));
            }
            if ($this->request->is(array('emprestimo', 'put'))) {
                $this->Emprestimolivros->id = $id;
            if ($this->Emprestimolivros->save($this->request->data)) {
                $this->Session->setFlash(__('Atualizado com sucesso!', null),
                            'default', 
                             array('class' => 'notice success'));
                return $this->redirect(array('action' => 'index'));
            }
                $this->Session->setFlash(__('Unable to update your titulo.'));
            }
            if (!$this->request->data) {
                $this->request->data = $emp;
            }
            self::getAlunos();
            self::getLivros();
        }
        
        public function devolver($id = null){
            if($id){
                $empL = $this->Emprestimos_livro->findById($id);
                if($empL){
                    $empL['Emprestimos_livro']['data_devolucao'] = date('d/m/Y', time());
                    if($this->Emprestimos_livro->save($empL)){
                        $this->Session->setFlash(__('Devolução bem sucedida!', null),
                                'default', 
                                 array('class' => 'notice success'));
                        return $this->redirect($this->referer());

                    }
                }
                $this->Session->setFlash(__('Não foi possível registrar devolução!', null),
                            'default', 
                             array());
                return $this->redirect($this->referer());
            }
        }
        
        public function prorrogar($id = null){
            if($id){
                if(!$this->Emprestimo->prorrogaPrazo($id)){
                
                }
                $this->Session->setFlash(__('Prazo Prorrogado!', null),
                            'default', 
                             array('class' => 'notice success'));
                return $this->redirect($this->referer());
            }
        }
        
        public function delete($id = null){
            if($id){
                if($this->Emprestimo->delete($id)){
                    $this->Session->setFlash(__('Deletado com sucesso!', null),
                            'default', array('class' => 'notice'));
                }
                return $this->redirect($this->referer());
            }
        }
        
        public function view($id = null){
            if($id){
                $emprestimo = $this->Viewlte->find('all',array('conditions' => 
                    array('emprestimo_id' => $id)));
                $this->set(compact("emprestimo"));
            }               
        }
       
        function viewpdf($email,$emp_id){ 
            $emprestimos = $this->Emprestimo->Viewlte->query(
                    "SELECT * FROM Viewltes WHERE emprestimo_id = ".$emp_id); 
            $this->set(compact("email"));
            $this->set(compact("emprestimos"));
            $this->layout = 'pdf'; //this will use the pdf.ctp layout 
            $this->render();
        }
       
        public function getAlunos(){
            $alunos = $this->Viewaluno->find('list', array('fields'=>array('aluno_id','ra')));
            if(isset($alunos)){
                $this->set(compact('alunos'));
            }else{
                $this->Session->setFlash(__('Não há alunos cadastrados!', null));
                return $this->redirect(array('action' => 'index'));
            }
        }
        
        public function aluno_nome($id = null){
            if(!$id){ return "Não há cadastro";}
            $a = $this->Viewaluno->query("SELECT nome FROM Viewalunos WHERE aluno_id =".$id);
            $this->set(compact('a'));
            $this->layout = "ajax";
        }
        
        public function livro_detalhes($id = null){
            if(!$id){ return "Não há cadastro";}
            $l = $this->Viewlivrosdetalhe->find("all",array(
                'conditions' => array('Viewlivrosdetalhe.disponivel' => 'true', 
                    ' Viewlivrosdetalhe.id = ' => $id )));
            $this->set(compact('l'));
            $this->layout = "ajax";
        }
        
        public function email($email,$file){
            App::uses('CakeEmail', 'Network/Email');
            $Email = new CakeEmail('gmail');
            $Email->to($email);
            $Email->from('acessaescoladeitapeva@gmail.com','BIBLIOTECA');
            $Email->addAttachments('/tmp/'.$file);
            $Email->message('teste gjhgjhj jhgh');
            $Email->subject('Comprovante empréstimo');
            if($Email->send()){
                $this->Session->setFlash(__('Comprovante enviado para '.$email.' com sucesso.', null),
                            'default', array('class' => 'notice success'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        
        public function getNomes(){
            $nomes = $this->Viewaluno->find('list',array('fields' => array( 'aluno_id', 'nome'),
                                'order'=>'nome'));
            $this->set(compact('nomes'));
        }
        
        public function getRAs(){
            $ras = $this->Viewaluno->find('list',array('fields' => array( 'aluno_id', 'ra'),
                                'order'=>'ra'));
            $this->set(compact('ras'));
        }
        
        public function getLivros(){
            $livros = $this->Livro->find('list', array('fields'=>array('id'),
                'conditions'=>array('disponivel' => 'true')));
            if($livros){
                $this->set(compact('livros'));
            }else{
                $this->Session->setFlash(__('Não há livros disponíveis!', null));
                return $this->redirect(array('action' => 'index'));
            }
        }
        
    }      
?>
