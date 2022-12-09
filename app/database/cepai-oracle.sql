CREATE TABLE email_template( 
      id number(10)    NOT NULL , 
      titulo varchar  (200)   , 
      mensagem varchar(3000)   , 
      dt_created_at timestamp(0)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id number(10)    NOT NULL , 
      name varchar(3000)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id number(10)    NOT NULL , 
      system_group_id number(10)    NOT NULL , 
      system_program_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_preference( 
      id varchar  (255)    NOT NULL , 
      preference varchar(3000)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id number(10)    NOT NULL , 
      name varchar(3000)    NOT NULL , 
      controller varchar(3000)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id number(10)    NOT NULL , 
      name varchar(3000)    NOT NULL , 
      connection_name varchar(3000)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      system_group_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_program( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      system_program_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_users( 
      id number(10)    NOT NULL , 
      name varchar(3000)    NOT NULL , 
      login varchar(3000)    NOT NULL , 
      password varchar(3000)    NOT NULL , 
      email varchar(3000)   , 
      cd_telefone varchar  (20)   , 
      nm_cargo varchar  (200)   , 
      frontpage_id number(10)   , 
      system_unit_id number(10)   , 
      active char  (1)   , 
      accepted_term_policy_at varchar(3000)   , 
      accepted_term_policy char  (1)   , 
      tb_empresa_id number(10)   , 
      tb_cidade_id number(10)   , 
      tb_area_porto_id number(10)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_unit( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      system_unit_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tb_area_porto( 
      id_area_porto number(10)    NOT NULL , 
      nm_area_porto varchar  (45)    NOT NULL , 
 PRIMARY KEY (id_area_porto)) ; 

CREATE TABLE tb_cidade( 
      id_cidade number(10)    NOT NULL , 
      nm_cidade varchar  (60)    NOT NULL , 
      cd_ibge varchar  (10)    NOT NULL , 
      tb_uf_id number(10)    NOT NULL , 
 PRIMARY KEY (id_cidade)) ; 

CREATE TABLE tb_complemento( 
      id_complemento number(10)   , 
      ds_complemento varchar(3000)   , 
      dt_created_at timestamp(0)   , 
      system_users_id number(10)   , 
      tb_ocorrencia_id number(10)   , 
 PRIMARY KEY (id_complemento)) ; 

CREATE TABLE tb_empresa( 
      id_empresa number(10)    NOT NULL , 
      nm_empresa varchar  (100)    NOT NULL , 
      cd_cnpj varchar  (20)    NOT NULL , 
      ds_endereco varchar  (250)   , 
      cd_cep varchar  (15)   , 
      nm_bairro varchar  (100)   , 
      ds_complemento varchar  (250)   , 
      cd_numero varchar  (10)   , 
      tb_cidade_id number(10)   , 
 PRIMARY KEY (id_empresa)) ; 

CREATE TABLE tb_gravidade( 
      id_gravidade number(10)    NOT NULL , 
      nm_gravidade varchar  (45)    NOT NULL , 
      cd_cor varchar  (8)    NOT NULL , 
 PRIMARY KEY (id_gravidade)) ; 

CREATE TABLE tb_midia_ocorrencia( 
      id_midia_ocorrencia number(10)   , 
      im_midia1 varchar(3000)   , 
      im_midia2 varchar(3000)   , 
      im_midia3 varchar(3000)   , 
 PRIMARY KEY (id_midia_ocorrencia)) ; 

CREATE TABLE tb_ocorrencia( 
      id_ocorrencia number(10)    NOT NULL , 
      dt_ocorrencia timestamp(0)    NOT NULL , 
      dt_created_at timestamp(0)   , 
      dt_updated_at timestamp(0)   , 
      dt_deleted_at timestamp(0)   , 
      ic_mudar_empresa char(1)   , 
      nm_outro_motivo varchar  (255)   , 
      ds_resumo varchar(3000)    NOT NULL , 
      qt_vitimas number(10)    NOT NULL , 
      im_midia1 varchar(3000)   , 
      im_midia2 varchar(3000)   , 
      im_midia3 varchar(3000)   , 
      ds_endereco varchar(3000)   , 
      tb_empresa_id number(10)   , 
      tb_tipo_ocorrencia_id number(10)    NOT NULL , 
      tb_gravidade_id number(10)    NOT NULL , 
      system_users_id number(10)    NOT NULL , 
 PRIMARY KEY (id_ocorrencia)) ; 

CREATE TABLE tb_perfil_usuario( 
      id_perfil_usuario number(10)    NOT NULL , 
      nm_perfil_usuario varchar  (45)    NOT NULL , 
 PRIMARY KEY (id_perfil_usuario)) ; 

CREATE TABLE tb_simulado( 
      id_simulado number(10)    NOT NULL , 
      dt_simulado timestamp(0)   , 
      dt_created_at timestamp(0)   , 
      ds_relatorio varchar(3000)   , 
      system_users_id number(10)   , 
 PRIMARY KEY (id_simulado)) ; 

CREATE TABLE tb_tipo_ocorrencia( 
      id_tipo_ocorrencia number(10)    NOT NULL , 
      nm_tipo_ocorrencia varchar  (60)    NOT NULL , 
      nm_localizacao varchar  (255)   , 
      ds_complemento varchar  (255)   , 
 PRIMARY KEY (id_tipo_ocorrencia)) ; 

CREATE TABLE tb_uf( 
      id_uf number(10)    NOT NULL , 
      nm_uf varchar  (45)    NOT NULL , 
      sg_uf char  (2)    NOT NULL , 
      cd_ibge varchar  (10)    NOT NULL , 
 PRIMARY KEY (id_uf)) ; 

CREATE TABLE tb_usuario( 
      id_usuario number(10)    NOT NULL , 
      nm_usuario varchar  (200)    NOT NULL , 
      cd_cpf varchar  (15)    NOT NULL , 
      cd_telefone varchar  (20)    NOT NULL , 
      nm_cargo varchar  (60)    NOT NULL , 
      cd_senha varchar  (15)    NOT NULL , 
      cd_email varchar  (100)    NOT NULL , 
      ic_ativo char(1)   , 
      tb_perfil_usuario_id number(10)    NOT NULL , 
 PRIMARY KEY (id_usuario)) ; 

 
  
 ALTER TABLE system_group_program ADD CONSTRAINT fk_system_group_program_1 FOREIGN KEY (system_program_id) references system_program(id); 
ALTER TABLE system_group_program ADD CONSTRAINT fk_system_group_program_2 FOREIGN KEY (system_group_id) references system_group(id); 
ALTER TABLE system_user_group ADD CONSTRAINT fk_system_user_group_1 FOREIGN KEY (system_group_id) references system_group(id); 
ALTER TABLE system_user_group ADD CONSTRAINT fk_system_user_group_2 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_user_program ADD CONSTRAINT fk_system_user_program_1 FOREIGN KEY (system_program_id) references system_program(id); 
ALTER TABLE system_user_program ADD CONSTRAINT fk_system_user_program_2 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_users ADD CONSTRAINT fk_system_user_1 FOREIGN KEY (system_unit_id) references system_unit(id); 
ALTER TABLE system_users ADD CONSTRAINT fk_system_user_2 FOREIGN KEY (frontpage_id) references system_program(id); 
ALTER TABLE system_users ADD CONSTRAINT fk_system_users_3 FOREIGN KEY (tb_empresa_id) references tb_empresa(id_empresa); 
ALTER TABLE system_users ADD CONSTRAINT fk_system_users_4 FOREIGN KEY (tb_cidade_id) references tb_cidade(id_cidade); 
ALTER TABLE system_users ADD CONSTRAINT fk_system_users_5 FOREIGN KEY (tb_area_porto_id) references tb_area_porto(id_area_porto); 
ALTER TABLE system_user_unit ADD CONSTRAINT fk_system_user_unit_1 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_user_unit ADD CONSTRAINT fk_system_user_unit_2 FOREIGN KEY (system_unit_id) references system_unit(id); 
ALTER TABLE tb_cidade ADD CONSTRAINT fk_tb_cidade_1 FOREIGN KEY (tb_uf_id) references tb_uf(id_uf); 
ALTER TABLE tb_complemento ADD CONSTRAINT fk_tb_complemento_2 FOREIGN KEY (system_users_id) references system_users(id); 
ALTER TABLE tb_complemento ADD CONSTRAINT fk_tb_complemento_3 FOREIGN KEY (tb_ocorrencia_id) references tb_ocorrencia(id_ocorrencia); 
ALTER TABLE tb_empresa ADD CONSTRAINT fk_tb_empresa_1 FOREIGN KEY (tb_cidade_id) references tb_cidade(id_cidade); 
ALTER TABLE tb_ocorrencia ADD CONSTRAINT fk_tb_ocorrencia_1 FOREIGN KEY (tb_tipo_ocorrencia_id) references tb_tipo_ocorrencia(id_tipo_ocorrencia); 
ALTER TABLE tb_ocorrencia ADD CONSTRAINT fk_tb_ocorrencia_2 FOREIGN KEY (tb_gravidade_id) references tb_gravidade(id_gravidade); 
ALTER TABLE tb_ocorrencia ADD CONSTRAINT fk_tb_ocorrencia_3 FOREIGN KEY (system_users_id) references system_users(id); 
ALTER TABLE tb_ocorrencia ADD CONSTRAINT fk_tb_ocorrencia_4 FOREIGN KEY (tb_empresa_id) references tb_empresa(id_empresa); 
ALTER TABLE tb_simulado ADD CONSTRAINT fk_tb_simulado_1 FOREIGN KEY (system_users_id) references system_users(id); 
ALTER TABLE tb_usuario ADD CONSTRAINT fk_tb_usuario_1 FOREIGN KEY (tb_perfil_usuario_id) references tb_perfil_usuario(id_perfil_usuario); 
 CREATE SEQUENCE email_template_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER email_template_id_seq_tr 

BEFORE INSERT ON email_template FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT email_template_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE tb_area_porto_id_area_porto_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tb_area_porto_id_area_porto_seq_tr 

BEFORE INSERT ON tb_area_porto FOR EACH ROW 

WHEN 

(NEW.id_area_porto IS NULL) 

BEGIN 

SELECT tb_area_porto_id_area_porto_seq.NEXTVAL INTO :NEW.id_area_porto FROM DUAL; 

END;
CREATE SEQUENCE tb_cidade_id_cidade_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tb_cidade_id_cidade_seq_tr 

BEFORE INSERT ON tb_cidade FOR EACH ROW 

WHEN 

(NEW.id_cidade IS NULL) 

BEGIN 

SELECT tb_cidade_id_cidade_seq.NEXTVAL INTO :NEW.id_cidade FROM DUAL; 

END;
CREATE SEQUENCE tb_complemento_id_complemento_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tb_complemento_id_complemento_seq_tr 

BEFORE INSERT ON tb_complemento FOR EACH ROW 

WHEN 

(NEW.id_complemento IS NULL) 

BEGIN 

SELECT tb_complemento_id_complemento_seq.NEXTVAL INTO :NEW.id_complemento FROM DUAL; 

END;
CREATE SEQUENCE tb_empresa_id_empresa_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tb_empresa_id_empresa_seq_tr 

BEFORE INSERT ON tb_empresa FOR EACH ROW 

WHEN 

(NEW.id_empresa IS NULL) 

BEGIN 

SELECT tb_empresa_id_empresa_seq.NEXTVAL INTO :NEW.id_empresa FROM DUAL; 

END;
CREATE SEQUENCE tb_gravidade_id_gravidade_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tb_gravidade_id_gravidade_seq_tr 

BEFORE INSERT ON tb_gravidade FOR EACH ROW 

WHEN 

(NEW.id_gravidade IS NULL) 

BEGIN 

SELECT tb_gravidade_id_gravidade_seq.NEXTVAL INTO :NEW.id_gravidade FROM DUAL; 

END;
CREATE SEQUENCE tb_midia_ocorrencia_id_midia_ocorrencia_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tb_midia_ocorrencia_id_midia_ocorrencia_seq_tr 

BEFORE INSERT ON tb_midia_ocorrencia FOR EACH ROW 

WHEN 

(NEW.id_midia_ocorrencia IS NULL) 

BEGIN 

SELECT tb_midia_ocorrencia_id_midia_ocorrencia_seq.NEXTVAL INTO :NEW.id_midia_ocorrencia FROM DUAL; 

END;
CREATE SEQUENCE tb_ocorrencia_id_ocorrencia_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tb_ocorrencia_id_ocorrencia_seq_tr 

BEFORE INSERT ON tb_ocorrencia FOR EACH ROW 

WHEN 

(NEW.id_ocorrencia IS NULL) 

BEGIN 

SELECT tb_ocorrencia_id_ocorrencia_seq.NEXTVAL INTO :NEW.id_ocorrencia FROM DUAL; 

END;
CREATE SEQUENCE tb_perfil_usuario_id_perfil_usuario_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tb_perfil_usuario_id_perfil_usuario_seq_tr 

BEFORE INSERT ON tb_perfil_usuario FOR EACH ROW 

WHEN 

(NEW.id_perfil_usuario IS NULL) 

BEGIN 

SELECT tb_perfil_usuario_id_perfil_usuario_seq.NEXTVAL INTO :NEW.id_perfil_usuario FROM DUAL; 

END;
CREATE SEQUENCE tb_simulado_id_simulado_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tb_simulado_id_simulado_seq_tr 

BEFORE INSERT ON tb_simulado FOR EACH ROW 

WHEN 

(NEW.id_simulado IS NULL) 

BEGIN 

SELECT tb_simulado_id_simulado_seq.NEXTVAL INTO :NEW.id_simulado FROM DUAL; 

END;
CREATE SEQUENCE tb_tipo_ocorrencia_id_tipo_ocorrencia_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tb_tipo_ocorrencia_id_tipo_ocorrencia_seq_tr 

BEFORE INSERT ON tb_tipo_ocorrencia FOR EACH ROW 

WHEN 

(NEW.id_tipo_ocorrencia IS NULL) 

BEGIN 

SELECT tb_tipo_ocorrencia_id_tipo_ocorrencia_seq.NEXTVAL INTO :NEW.id_tipo_ocorrencia FROM DUAL; 

END;
CREATE SEQUENCE tb_uf_id_uf_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tb_uf_id_uf_seq_tr 

BEFORE INSERT ON tb_uf FOR EACH ROW 

WHEN 

(NEW.id_uf IS NULL) 

BEGIN 

SELECT tb_uf_id_uf_seq.NEXTVAL INTO :NEW.id_uf FROM DUAL; 

END;
CREATE SEQUENCE tb_usuario_id_usuario_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tb_usuario_id_usuario_seq_tr 

BEFORE INSERT ON tb_usuario FOR EACH ROW 

WHEN 

(NEW.id_usuario IS NULL) 

BEGIN 

SELECT tb_usuario_id_usuario_seq.NEXTVAL INTO :NEW.id_usuario FROM DUAL; 

END;
 
  
