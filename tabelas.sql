﻿UPDATE emprestimos_livros SET data_devolucao = now() WHERE id = 174

revoke all from biblioteca_admin
drop group biblioteca_admin 
select * from users
/*create user biblioteca_user password '123'

GRANT SELECT, INSERT ON users TO biblioteca_user
select * from Viewlivrosdetalhes;
GRANT SELECT, INSERT, UPDATE, DELETE ON alunos, users, livros, titulos, users, alunos,emprestimos,autors,assuntos,classificacaos, editoras, autors_titulos, 
	idiomas,livros,localizacaos, titulos, Viewlivrosdetalhes, viewltes, emprestimos_livros,
	classificacaos_titulos, assuntos_titulos, Viewtitulosdetalhes,
	viewltes, viewalunos, enderecos TO biblioteca_user

GRANT SELECT,  UPDATE, USAGE ON users_id_seq, autors_id_seq, editoras_id_seq, titulos_id_seq, enderecos_id_seq, localizacaos_id_seq,
	idiomas_id_seq, assuntos_id_seq, classificacaos_id_seq, livros_id_seq, emprestimos_id_seq, emprestimos_livros_id_seq TO biblioteca_user
	
GRANT ALL ON ALL SEQUENCES IN SCHEMA public TO biblioteca_user
GRANT ALL PRIVILEGES ON DATABASE biblioteca to biblioteca_user
create user padrao password '123'
create group biblioteca with user usuario_biblioteca
create group biblioteca_admin with user padrao
grant all on database biblioteca
	to biblioteca_user
grant all on 
	users, alunos,emprestimos,autors,assuntos,classificacaos, editoras, autors_titulos, 
	idiomas,livros,localizacaos, titulos, Viewlivrosdetalhes, viewltes, emprestimos_livros,
	classificacaos_titulos, assuntos_titulos, Viewtitulosdetalhes
	to biblioteca_user;
create schema admin;
alter table emprestimos set schema admin;*/

drop table autors_livros
drop table assuntos_livros
drop table livros
drop table localizacaos
drop table idiomas cascade
drop table autors
drop table alunos
drop table users
select * from users
select * from userbibliotecas

create table enderecos(id serial primary key, logradouro varchar(40), 
	numero varchar(8), bairro varchar(30), cidade varchar(30), cep varchar(8))

CREATE TABLE users (id serial PRIMARY KEY, username VARCHAR(50),password VARCHAR(50),role VARCHAR(20),created TIMESTAMP DEFAULT NULL,
	nome varchar(50), sobrenome varchar(50), endereco_id int, email varchar(60),modified TIMESTAMP DEFAULT NULL, 
	    foreign key (endereco_id) references enderecos(id))
	    
create table titulos(id serial primary key, titulo varchar(255), resenha text,localizacao_id int,
	constraint fk_livro_localizacao foreign key(localizacao_id) references localizacaos)

select setval('livros_id_seq', 100000, true)

create table livros(id serial primary key, titulo_id int, editora_id int, cod_barras varchar(100), 
	disponivel boolean not null default(true),edicao varchar(20), situacao smallint, resenha text, ano int, data_aquisicao date, 
	idioma_id int,  
		constraint fk_livro_idioma foreign key(idioma_id) references idiomas,
		constraint fk_livro_editora foreign key(editora_id) references editoras,
		constraint fk_livro_titulo foreign key (titulo_id) references titulos (id))


alter table emprestimos_livros add constraint emprestimolivros_livro_id_fkey foreign key
	(livro_id) references livros on update cascade

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
create table localizacaos(id serial primary key, localizacao varchar(80))
create table idiomas(id serial primary key, idioma varchar(80))
create table assuntos(id serial primary key, assunto varchar(80))
create table autors(id serial primary key, autor varchar(80))
create table editoras(id serial primary key, editora varchar(80))
create table alunos(ra int, ano_serie int) inherits(Users)
alter table alunos add primary key (id)

create table emprestimos(id serial primary key, aluno_id int not null, 
  data_emprestimo timestamp default now(), 
		foreign key (aluno_id) references alunos(id))
create table emprestimos_livros(id serial primary key, emprestimo_id int, titulo_id int not null, prorrogado int default 0,
	livro_id int not null, data_devolucao date, prazo_devolucao timestamp default now()+INTERVAL '7days',
	foreign key (titulo_id) references titulos(id),
	foreign key (livro_id) references livros(id))

/* ATUALIZA STATUS DO LIVRO EMPRESTADO PARA INDISPONIVEL E INSERE ID DO TITULO  */
drop trigger trg_livro_emprestado on emprestimos_livros
CREATE TRIGGER trg_livro_emprestado
		BEFORE INSERT ON emprestimos_livros
		FOR EACH ROW EXECUTE PROCEDURE livro_emprestado();
CREATE or replace FUNCTION livro_emprestado() RETURNS TRIGGER AS
	$$
		DECLARE li Livros%ROWTYPE;
		BEGIN
			UPDATE livros SET disponivel = FALSE WHERE id = NEW.livro_id;
			SELECT INTO li * FROM livros WHERE id = NEW.livro_id;
			NEW.titulo_id := li.titulo_id;
			RETURN NEW;
		END;
	$$ LANGUAGE "plpgsql";

select * from emprestimos_livros

select * from viewltes select * from emprestimos_livros

/* VERIFICA SE USERNAME ESTÁ DISPONIVEL E SE INDISPONIVEL NEGA O CADASTRO  */
drop trigger trg_username_free on users
CREATE TRIGGER trg_username_free
		BEFORE INSERT ON users
		FOR EACH ROW EXECUTE PROCEDURE username_free();
CREATE or replace FUNCTION username_free() RETURNS TRIGGER AS
	$$
		BEGIN
			PERFORM username FROM users WHERE username = NEW.username;
			IF  FOUND THEN
				RAISE EXCEPTION 'RA JÁ CADASTRADO.';
			ELSE
				RETURN NEW;
			END IF;
		END;
	$$ LANGUAGE "plpgsql";

/* VERIFICA SE LIVRO ESTÁ DISPONÍVEL PARA EMPRÉSTIMO E INSERE TITULO_ID E ATUALIZA COMO INDISPONÍVEL*/
CREATE TRIGGER trg_livro_devolvido
		BEFORE INSERT ON emprestimos_livros
		FOR EACH ROW EXECUTE PROCEDURE livro_emprestado();
CREATE or replace FUNCTION livro_emprestado() RETURNS TRIGGER AS
	$$
		DECLARE 
			r Livros.disponivel%type;
			n Titulos.id%type;
		BEGIN
			SELECT INTO r disponivel FROM livros WHERE id = NEW.livro_id;
			IF(r) THEN
				SELECT INTO n titulo_id FROM livros WHERE id = NEW.livro_id;
					NEW.titulo_id := n;
					update livros set disponivel = false where id = NEW.livro_id;
					RETURN NEW;
			ELSE RAISE EXCEPTION 'ESTE LIVRO ESTÁ INDISPONÍVEL PARA EMPRÉSTIMO.';
				return null;
			END IF;
			
		END;
	$$ LANGUAGE "plpgsql";

/* ATUALIZA PRAZO DE ENTREGA DO LIVRO SELECIONADO SE PRAZO NÃO VENCIDO E ATUALIZA DATA DE DEVOLUÇÃO
	E STATUS DO LIVRO DEVOLVIDO */
DROP TRIGGER trg_livro_devolvido ON emprestimos_livros
CREATE TRIGGER trg_livro_devolvido
		BEFORE UPDATE ON emprestimos_livros
		FOR EACH ROW EXECUTE PROCEDURE livro_devolvido_prorrogado();
CREATE or replace FUNCTION livro_devolvido_prorrogado() RETURNS TRIGGER AS
	$$
		BEGIN
			IF (not OLD.data_devolucao isnull AND 
				not OLD.data_devolucao = NEW.data_devolucao ) THEN 
				raise exception 'ESTE LIVRO JÁ FOI DEVOLVIDO';
				RETURN OLD;
			ELSIF (not OLD.data_devolucao isnull AND 
				NEW.prazo_devolucao <> OLD.prazo_devolucao ) THEN 
				raise exception 'ESTE LIVRO JÁ FOI DEVOLVIDO E O PRAZO NÃO PODE SER PRORROGADO';
				RETURN OLD;
			ELSIF (OLD.data_devolucao isnull) THEN
				IF(NEW.prazo_devolucao > OLD.prazo_devolucao) THEN
					IF(OLD.prazo_devolucao < now()::DATE) THEN
						raise exception 'PRAZO VENCIDO, PRORROGAMENTO INDISPONÍVEL';
						RETURN OLD;
					ELSE RETURN NEW;
					END IF;
				ELSE	
					update livros set disponivel = TRUE where id = OLD.livro_id;
					RETURN NEW;	
				END IF	;
			ELSE 
				RETURN NEW;
			END IF;
		END;
	$$ LANGUAGE "plpgsql";


SELECT concat( t.titulo , ' - ',l.cod_barras) as "titulo", l.id as 
                    "livro_id" FROM livros l inner join titulos t
                     ON l.titulo_id = t.id ;
                     update livros set cod_barras = 'asdasdas'

/* VIEW QUE CONTEM DADOS DO ALUNO E SEUS EMPRESTIMOS */
drop view viewltes
CREATE OR REPLACE VIEW ViewLTEs AS SELECT t.titulo, t.id as "titulo_id", 
	el.livro_id as "livro_id", e.id as "emprestimo_id", e.aluno_id as "aluno_id",  a.email,
	(a.nome || ' ' || a.sobrenome) as "aluno", a.username,e.data_emprestimo, el.data_devolucao, el.prazo_devolucao, el.id
	FROM emprestimos_livros el
	INNER JOIN emprestimos e ON e.id = el.emprestimo_id
	INNER JOIN titulos t ON t.id = el.titulo_id
	INNER JOIN alunos a ON a.id = e.aluno_id
drop view viewalunos 
CREATE OR REPLACE VIEW viewalunos AS SELECT a.id as aluno_id, a.id,(a.nome || ' ' || a.sobrenome) as nome, a.username as "ra", a.email,
e.logradouro, e.numero, e.cep, e.cidade, e.bairro FROM alunos a INNER JOIN enderecos e ON a.endereco_id = e.id;
			
select count(*) from viewltes where aluno_id = 1 and titulo_id = 6

SELECT titulo, data_emprestimo,data_devolucao, data_prev_dev
                    FROM ViewLTE WHERE aluno_id = 1
                    ORDER BY titulo ASC LIMIT 5

sELECT titulo, data_emprestimo,data_devolucao, prazo_devolucao, extract("days" from (data_devolucao - prazo_devolucao)) 
                     FROM ViewLTEs WHERE aluno_id = 1 AND data_devolucao > prazo_devolucao
                     ORDER BY titulo ASC LIMIT 5

drop function get_titulo_editoras(int); 
CREATE or replace FUNCTION get_titulo_editoras(int) RETURNS VARCHAR[] AS
	$$
		DECLARE
			r Editoras.editora%type;
			a varchar[];
		BEGIN
			FOR r IN SELECT DISTINCT editora FROM livros l INNER JOIN editoras e ON l.editora_id = e.id WHERE l.titulo_id = $1
			LOOP
				--RAISE NOTICE 'editora %',r.editora;
				a := a || r; 
			END LOOP;
			RETURN a;
		END;
	$$ LANGUAGE "plpgsql";

CREATE or replace FUNCTION get_titulo_autores(int) RETURNS VARCHAR[] AS
	$$
		DECLARE 
			r Autors.autor%type;
			a varchar[];
		BEGIN
			FOR r IN SELECT DISTINCT autor FROM autors a INNER JOIN autors_titulos al
				ON a.id = al.autor_id INNER JOIN titulos t ON t.id = al.titulo_id WHERE t.id = $1
			LOOP
				--RAISE NOTICE 'editora %',r.editora;
				a := a || r; 
			END LOOP;
			RETURN a;
		END;
	$$ LANGUAGE "plpgsql";

CREATE or replace FUNCTION get_titulo_classificacaos(int) RETURNS VARCHAR[] AS
	$$
		DECLARE 
			r Classificacaos.classificacao%type;
			a varchar[];
		BEGIN
			FOR r IN SELECT DISTINCT classificacao FROM classificacaos c INNER JOIN classificacaos_titulos cl
				ON c.id = cl.classificacao_id INNER JOIN titulos t ON t.id = cl.titulo_id WHERE t.id = $1
			LOOP
				--RAISE NOTICE 'editora %',r.editora;
				a := a || r; 
			END LOOP;
			RETURN a;
		END;
	$$ LANGUAGE "plpgsql";

CREATE or replace FUNCTION get_titulo_assuntos(int) RETURNS VARCHAR[] AS
	$$
		DECLARE 
			r Assuntos.assunto%type;
			a varchar[];
		BEGIN
			FOR r IN SELECT DISTINCT assunto FROM assuntos a INNER JOIN assuntos_titulos al
				ON a.id = al.assunto_id INNER JOIN titulos t ON t.id = al.titulo_id WHERE t.id = $1
			LOOP
				--RAISE NOTICE 'editora %',r.editora;
				a := a || r; 
			END LOOP;
			RETURN a;
		END;
	$$ LANGUAGE "plpgsql";


CREATE or replace FUNCTION count_titulos(int) RETURNS BIGINT AS
	$$
			SELECT COUNT(*) FROM livros WHERE titulo_id = $1;
	$$ LANGUAGE sql;

CREATE or replace FUNCTION count_titulos_disponiveis(int) RETURNS BIGINT AS
	$$
			SELECT COUNT(*) FROM livros WHERE titulo_id = $1 AND disponivel;
	$$ LANGUAGE sql;

select get_titulo_assuntos(21)
select * from viewtitulosdetalhes

drop view Viewtitulosdetalhes cascade
CREATE OR REPLACE VIEW Viewtitulosdetalhes AS 
	SELECT t.id as "id", t.titulo, t.resenha,l.localizacao,
	(select get_titulo_editoras(t.id)) as "editoras",
	(select get_titulo_autores(t.id)) as "autores",
	(select get_titulo_classificacaos(t.id)) as "classificacaos",
	(select get_titulo_assuntos(t.id)) as "assuntos",
	(select count_titulos(t.id)) as exemplares,
	(select count_titulos_disponiveis(t.id)) as "disponiveis"
	FROM titulos t INNER JOIN localizacaos l ON t.localizacao_id = l.id

drop view  Viewlivrosdetalhes 
CREATE OR REPLACE VIEW Viewlivrosdetalhes AS
	SELECT l.*, v.titulo, v.resenha,v.autores, v.classificacaos, v.assuntos, 
	CASE WHEN NOT l.disponivel THEN 
		(SELECT el.prazo_devolucao FROM emprestimos_livros el 
			WHERE l.id = el.livro_id AND data_devolucao ISNULL),
		(SELECT el.id FROM emprestimos_livros el 
			WHERE l.id = el.livro_id AND data_devolucao ISNULL)
		ELSE NULL END AS prazo_devolucao,
	e.editora, i.idioma, v.localizacao
	FROM livros l INNER JOIN editoras e ON e.id = l.editora_id
		INNER JOIN idiomas i ON i.id = l.idioma_id
		INNER JOIN viewtitulosdetalhes v ON l.titulo_id = v.id;


SELECT t.id FROM titulos t 
	INNER JOIN autors_titulos ta ON t.id = ta.titulo_id WHERE ta.autor_id IN (5,15,14,3) 


