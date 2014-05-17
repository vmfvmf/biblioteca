drop table autors_livros
drop table assuntos_livros
drop table livros
drop table localizacaos
drop table idiomas cascade
drop table autors
drop table teste

create table titulos(id serial primary key, titulo varchar(255), localizacao_id int,
	constraint fk_livro_localizacao foreign key(localizacao_id) references localizacaos)

create table livros(id serial primary key, titulo_id int, editora_id int, cod_barras varchar(100), 
	disponivel boolean not null default(true),edicao varchar(20), situacao smallint, obs text, ano int, data_aquisicao date, 
	idioma_id int,  
		constraint fk_livro_idioma foreign key(idioma_id) references idiomas,
		constraint fk_livro_editora foreign key(editora_id) references editoras,
		constraint fk_livro_titulo foreign key (titulo_id) references titulos (id))



create table autors_titulos(titulo_id int,autor_id int,
		foreign key (autor_id) references autors(id),
		foreign key (titulo_id) references titulos(id))

create table classificacaos_titulos(titulo_id int,classificacao_id int,
		foreign key (classificacao_id) references classificacaos(id),
		foreign key (titulo_id) references titulos(id))

create table assuntos_titulos(assunto_id int,titulo_id int,
		foreign key (assunto_id) references assuntos(id),
		foreign key (titulo_id) references titulos(id))


create table classificacaos(id serial primary key, classificacao varchar(80))
create table localizacaos(id serial primary key, nome varchar(80))
create table idiomas(id serial primary key, nome varchar(80))
create table assuntos(id serial primary key, assunto varchar(80))
create table autors(id serial primary key, nome varchar(80))
create table editoras(id serial primary key, editora varchar(80))
create table alunos(id serial primary key, nome varchar(80), ra varchar(20))
create table emprestimos(id serial primary key, aluno_id int not null, livro_id int not null,
	data_emprestimo timestamp default now(), data_devolucao timestamp,
		foreign key (aluno_id) references alunos(id),
		foreign key (livro_id) references livros(id))

CREATE TRIGGER trg_livro_emprestado
		AFTER INSERT ON emprestimos
		FOR EACH ROW EXECUTE PROCEDURE livro_emprestado();

CREATE or replace FUNCTION livro_emprestado() RETURNS TRIGGER AS
	$$
		BEGIN
			update livros set disponivel = FALSE where id = NEW.livro_id;
			return NEW;
		END;
	$$ LANGUAGE "plpgsql";

DROP TRIGGER trg_livro_devolvido ON emprestimos
CREATE TRIGGER trg_livro_devolvido
		BEFORE UPDATE ON emprestimos
		FOR EACH ROW EXECUTE PROCEDURE livro_devolvido();

CREATE or replace FUNCTION livro_devolvido() RETURNS TRIGGER AS
	$$
		BEGIN
			IF (not OLD.data_devolucao isnull) THEN 
				raise exception 'ESTE LIVRO JÁ FOI DEVOLVIDO';
				/*USING ERRCODE = 'no_puede';*/
				RETURN OLD;
			ELSE 
				update livros set disponivel = TRUE where id = OLD.livro_id;
				RETURN NEW;
			END IF;
		END;
	$$ LANGUAGE "plpgsql";

SELECT concat( t.titulo , ' - ',l.cod_barras) as "titulo", l.id as 
                    "livro_id" FROM livros l inner join titulos t
                     ON l.titulo_id = t.id ;
                     update livros set cod_barras = 'asdasdas'