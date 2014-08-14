<?php
App::uses('HtmlHelper', 'View/Helper');
class BibliotecaHelper extends HtmlHelper{ 
    public $helpers = array('Html');
    
    public function ProrrogarPrazoLink($id_livro_emprestimo){
        return $this->Html->link($this->Html->image('extend.png'), 
                            array('controller' => 'Emprestimos','action' => 'prorrogar',$id_livro_emprestimo),
                            array('escape' => false, 'title' => "Renovar"), "Deseja renovar este esmpréstimo?");
    }
    
    public function DevolverLivroLink($id_livro_emprestimo){
            return $this->Html->link($this->Html->image('recycle.png'), 
                        array('controller' => 'Emprestimos','action' => 'devolver',$id_livro_emprestimo),
                        array('escape' => false, 'title' => "Devolver"), "Registrar devolução?");
    }
    
    
    public function DetalhesAluno($id_aluno){
        return $this->Html->link($this->Html->image('icondetails.png'), 
                        array('controller' => 'Alunos','action' => 'view',$id_aluno),
                        array('escape' => false, 'title' => "Detalhes"));
    }
    
    public function EditarAluno($id_aluno){
        return $this->Html->link($this->Html->image('edit.png'), 
                        array('controller' => 'Alunos','action' => 'edit',$id_aluno),
                        array('escape' => false, 'title' => "Editar"));
    }
    
    public function ExcluirAluno($id_aluno){
        return $this->Html->link($this->Html->image('trash.png'), 
                        array('controller' => 'Alunos', 'action' => 'delete',$id_aluno),
                        array('escape' => false, 'title' => "Deletar"), "Deseja excluir este aluno?");
    }
    
    public function DetalhesTitulo($id_titulo){
        return $this->Html->link($this->Html->image('icondetails.png'), 
                        array('controller' => 'Titulos','action' => 'view',$id_titulo),
                        array('escape' => false, 'title' => "Detalhes"));
    }
    
    public function DetalhesLivro($id_livro){
        return $this->Html->link($this->Html->image('icondetails.png'), 
                        array('controller' => 'Livros','action' => 'view',$id_livro),
                        array('escape' => false, 'title' => "Detalhes"));
    }
    
    public function TodosLivros(){
        return $this->Html->link('Todos Livros',
                        array('controller' => 'Livros','action' => 'todos'));
    }
    
    public function TodosEmprestimosLivro($id_livro){
        return $this->Html->link('Empréstimos Livro',
                        array('controller' => 'Emprestimos','action' => 'resultado/livro/'.$id_livro));
    }
    
    public function BuscarLivro(){
        return $this->Html->link('Buscar Livro',
                        array('controller' => 'Livros','action' => 'index'));
    }
    
    public function NovoLivro(){
        return $this->Html->link('Novo Livro',
                        array('controller' => 'Livros','action' => 'add'));
    }
}



