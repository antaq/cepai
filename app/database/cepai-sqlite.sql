PRAGMA foreign_keys=OFF; 

CREATE TABLE email_template( 
      id  INTEGER    NOT NULL  , 
      titulo varchar  (200)   , 
      mensagem text   , 
      dt_created_at datetime   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_program_id) REFERENCES system_program(id),
FOREIGN KEY(system_group_id) REFERENCES system_group(id)) ; 

CREATE TABLE system_preference( 
      id varchar  (255)   NOT NULL  , 
      preference text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
      controller text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
      connection_name text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_group_id) REFERENCES system_group(id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id)) ; 

CREATE TABLE system_user_program( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_program_id) REFERENCES system_program(id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id)) ; 

CREATE TABLE system_users( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
      login text   NOT NULL  , 
      password text   NOT NULL  , 
      email text   , 
      cd_telefone varchar  (20)   , 
      nm_cargo varchar  (200)   , 
      frontpage_id int   , 
      system_unit_id int   , 
      active char  (1)   , 
      accepted_term_policy_at text   , 
      accepted_term_policy char  (1)   , 
      tb_empresa_id int   , 
      tb_cidade_id int   , 
      tb_area_porto_id int   , 
 PRIMARY KEY (id),
FOREIGN KEY(system_unit_id) REFERENCES system_unit(id),
FOREIGN KEY(frontpage_id) REFERENCES system_program(id),
FOREIGN KEY(tb_empresa_id) REFERENCES tb_empresa(id_empresa),
FOREIGN KEY(tb_cidade_id) REFERENCES tb_cidade(id_cidade),
FOREIGN KEY(tb_area_porto_id) REFERENCES tb_area_porto(id_area_porto)) ; 

CREATE TABLE system_user_unit( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_unit_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id),
FOREIGN KEY(system_unit_id) REFERENCES system_unit(id)) ; 

CREATE TABLE tb_area_porto( 
      id_area_porto  INTEGER    NOT NULL  , 
      nm_area_porto varchar  (45)   NOT NULL  , 
 PRIMARY KEY (id_area_porto)) ; 

CREATE TABLE tb_cidade( 
      id_cidade  INTEGER    NOT NULL  , 
      nm_cidade varchar  (60)   NOT NULL  , 
      cd_ibge varchar  (10)   NOT NULL  , 
      tb_uf_id int   NOT NULL  , 
 PRIMARY KEY (id_cidade),
FOREIGN KEY(tb_uf_id) REFERENCES tb_uf(id_uf)) ; 

CREATE TABLE tb_complemento( 
      id_complemento  INTEGER    , 
      ds_complemento text   , 
      dt_created_at datetime   , 
      system_users_id int   , 
      tb_ocorrencia_id int   , 
 PRIMARY KEY (id_complemento),
FOREIGN KEY(system_users_id) REFERENCES system_users(id),
FOREIGN KEY(tb_ocorrencia_id) REFERENCES tb_ocorrencia(id_ocorrencia)) ; 

CREATE TABLE tb_empresa( 
      id_empresa  INTEGER    NOT NULL  , 
      nm_empresa varchar  (100)   NOT NULL  , 
      cd_cnpj varchar  (20)   NOT NULL  , 
      ds_endereco varchar  (250)   , 
      cd_cep varchar  (15)   , 
      nm_bairro varchar  (100)   , 
      ds_complemento varchar  (250)   , 
      cd_numero varchar  (10)   , 
      tb_cidade_id int   , 
 PRIMARY KEY (id_empresa),
FOREIGN KEY(tb_cidade_id) REFERENCES tb_cidade(id_cidade)) ; 

CREATE TABLE tb_gravidade( 
      id_gravidade  INTEGER    NOT NULL  , 
      nm_gravidade varchar  (45)   NOT NULL  , 
      cd_cor varchar  (8)   NOT NULL  , 
 PRIMARY KEY (id_gravidade)) ; 

CREATE TABLE tb_midia_ocorrencia( 
      id_midia_ocorrencia  INTEGER    , 
      im_midia1 text   , 
      im_midia2 text   , 
      im_midia3 text   , 
 PRIMARY KEY (id_midia_ocorrencia)) ; 

CREATE TABLE tb_ocorrencia( 
      id_ocorrencia  INTEGER    NOT NULL  , 
      dt_ocorrencia datetime   NOT NULL  , 
      dt_created_at datetime   , 
      dt_updated_at datetime   , 
      dt_deleted_at datetime   , 
      ic_mudar_empresa text   , 
      nm_outro_motivo varchar  (255)   , 
      ds_resumo text   NOT NULL  , 
      qt_vitimas int   NOT NULL  , 
      im_midia1 text   , 
      im_midia2 text   , 
      im_midia3 text   , 
      ds_endereco text   , 
      tb_empresa_id int   , 
      tb_tipo_ocorrencia_id int   NOT NULL  , 
      tb_gravidade_id int   NOT NULL  , 
      system_users_id int   NOT NULL  , 
 PRIMARY KEY (id_ocorrencia),
FOREIGN KEY(tb_tipo_ocorrencia_id) REFERENCES tb_tipo_ocorrencia(id_tipo_ocorrencia),
FOREIGN KEY(tb_gravidade_id) REFERENCES tb_gravidade(id_gravidade),
FOREIGN KEY(system_users_id) REFERENCES system_users(id),
FOREIGN KEY(tb_empresa_id) REFERENCES tb_empresa(id_empresa)) ; 

CREATE TABLE tb_perfil_usuario( 
      id_perfil_usuario  INTEGER    NOT NULL  , 
      nm_perfil_usuario varchar  (45)   NOT NULL  , 
 PRIMARY KEY (id_perfil_usuario)) ; 

CREATE TABLE tb_simulado( 
      id_simulado  INTEGER    NOT NULL  , 
      dt_simulado datetime   , 
      dt_created_at datetime   , 
      ds_relatorio text   , 
      system_users_id int   , 
 PRIMARY KEY (id_simulado),
FOREIGN KEY(system_users_id) REFERENCES system_users(id)) ; 

CREATE TABLE tb_tipo_ocorrencia( 
      id_tipo_ocorrencia  INTEGER    NOT NULL  , 
      nm_tipo_ocorrencia varchar  (60)   NOT NULL  , 
      nm_localizacao varchar  (255)   , 
      ds_complemento varchar  (255)   , 
 PRIMARY KEY (id_tipo_ocorrencia)) ; 

CREATE TABLE tb_uf( 
      id_uf  INTEGER    NOT NULL  , 
      nm_uf varchar  (45)   NOT NULL  , 
      sg_uf char  (2)   NOT NULL  , 
      cd_ibge varchar  (10)   NOT NULL  , 
 PRIMARY KEY (id_uf)) ; 

CREATE TABLE tb_usuario( 
      id_usuario  INTEGER    NOT NULL  , 
      nm_usuario varchar  (200)   NOT NULL  , 
      cd_cpf varchar  (15)   NOT NULL  , 
      cd_telefone varchar  (20)   NOT NULL  , 
      nm_cargo varchar  (60)   NOT NULL  , 
      cd_senha varchar  (15)   NOT NULL  , 
      cd_email varchar  (100)   NOT NULL  , 
      ic_ativo text   , 
      tb_perfil_usuario_id int   NOT NULL  , 
 PRIMARY KEY (id_usuario),
FOREIGN KEY(tb_perfil_usuario_id) REFERENCES tb_perfil_usuario(id_perfil_usuario)) ; 

 
 
  
