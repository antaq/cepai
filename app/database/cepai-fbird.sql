CREATE TABLE email_template( 
      id  integer generated by default as identity     NOT NULL , 
      titulo varchar  (200)   , 
      mensagem blob sub_type 1   , 
      dt_created_at timestamp   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id integer    NOT NULL , 
      name blob sub_type 1    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id integer    NOT NULL , 
      system_group_id integer    NOT NULL , 
      system_program_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_preference( 
      id varchar  (255)    NOT NULL , 
      preference blob sub_type 1   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id integer    NOT NULL , 
      name blob sub_type 1    NOT NULL , 
      controller blob sub_type 1    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id integer    NOT NULL , 
      name blob sub_type 1    NOT NULL , 
      connection_name blob sub_type 1   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id integer    NOT NULL , 
      system_user_id integer    NOT NULL , 
      system_group_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_program( 
      id integer    NOT NULL , 
      system_user_id integer    NOT NULL , 
      system_program_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_users( 
      id integer    NOT NULL , 
      name blob sub_type 1    NOT NULL , 
      login blob sub_type 1    NOT NULL , 
      password blob sub_type 1    NOT NULL , 
      email blob sub_type 1   , 
      cd_telefone varchar  (20)   , 
      nm_cargo varchar  (200)   , 
      frontpage_id integer   , 
      system_unit_id integer   , 
      active char  (1)   , 
      accepted_term_policy_at blob sub_type 1   , 
      accepted_term_policy char  (1)   , 
      tb_empresa_id integer   , 
      tb_cidade_id integer   , 
      tb_area_porto_id integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_unit( 
      id integer    NOT NULL , 
      system_user_id integer    NOT NULL , 
      system_unit_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tb_area_porto( 
      id_area_porto  integer generated by default as identity     NOT NULL , 
      nm_area_porto varchar  (45)    NOT NULL , 
 PRIMARY KEY (id_area_porto)) ; 

CREATE TABLE tb_cidade( 
      id_cidade  integer generated by default as identity     NOT NULL , 
      nm_cidade varchar  (60)    NOT NULL , 
      cd_ibge varchar  (10)    NOT NULL , 
      tb_uf_id integer    NOT NULL , 
 PRIMARY KEY (id_cidade)) ; 

CREATE TABLE tb_complemento( 
      id_complemento  integer generated by default as identity    , 
      ds_complemento blob sub_type 1   , 
      dt_created_at timestamp   , 
      system_users_id integer   , 
      tb_ocorrencia_id integer   , 
 PRIMARY KEY (id_complemento)) ; 

CREATE TABLE tb_empresa( 
      id_empresa  integer generated by default as identity     NOT NULL , 
      nm_empresa varchar  (100)    NOT NULL , 
      cd_cnpj varchar  (20)    NOT NULL , 
      ds_endereco varchar  (250)   , 
      cd_cep varchar  (15)   , 
      nm_bairro varchar  (100)   , 
      ds_complemento varchar  (250)   , 
      cd_numero varchar  (10)   , 
      tb_cidade_id integer   , 
 PRIMARY KEY (id_empresa)) ; 

CREATE TABLE tb_gravidade( 
      id_gravidade  integer generated by default as identity     NOT NULL , 
      nm_gravidade varchar  (45)    NOT NULL , 
      cd_cor varchar  (8)    NOT NULL , 
 PRIMARY KEY (id_gravidade)) ; 

CREATE TABLE tb_midia_ocorrencia( 
      id_midia_ocorrencia  integer generated by default as identity    , 
      im_midia1 blob sub_type 1   , 
      im_midia2 blob sub_type 1   , 
      im_midia3 blob sub_type 1   , 
 PRIMARY KEY (id_midia_ocorrencia)) ; 

CREATE TABLE tb_ocorrencia( 
      id_ocorrencia  integer generated by default as identity     NOT NULL , 
      dt_ocorrencia timestamp    NOT NULL , 
      dt_created_at timestamp   , 
      dt_updated_at timestamp   , 
      dt_deleted_at timestamp   , 
      ic_mudar_empresa char(1)   , 
      nm_outro_motivo varchar  (255)   , 
      ds_resumo blob sub_type 1    NOT NULL , 
      qt_vitimas integer    NOT NULL , 
      im_midia1 blob sub_type 1   , 
      im_midia2 blob sub_type 1   , 
      im_midia3 blob sub_type 1   , 
      ds_endereco blob sub_type 1   , 
      tb_empresa_id integer   , 
      tb_tipo_ocorrencia_id integer    NOT NULL , 
      tb_gravidade_id integer    NOT NULL , 
      system_users_id integer    NOT NULL , 
 PRIMARY KEY (id_ocorrencia)) ; 

CREATE TABLE tb_perfil_usuario( 
      id_perfil_usuario  integer generated by default as identity     NOT NULL , 
      nm_perfil_usuario varchar  (45)    NOT NULL , 
 PRIMARY KEY (id_perfil_usuario)) ; 

CREATE TABLE tb_simulado( 
      id_simulado  integer generated by default as identity     NOT NULL , 
      dt_simulado timestamp   , 
      dt_created_at timestamp   , 
      ds_relatorio blob sub_type 1   , 
      system_users_id integer   , 
 PRIMARY KEY (id_simulado)) ; 

CREATE TABLE tb_tipo_ocorrencia( 
      id_tipo_ocorrencia  integer generated by default as identity     NOT NULL , 
      nm_tipo_ocorrencia varchar  (60)    NOT NULL , 
      nm_localizacao varchar  (255)   , 
      ds_complemento varchar  (255)   , 
 PRIMARY KEY (id_tipo_ocorrencia)) ; 

CREATE TABLE tb_uf( 
      id_uf  integer generated by default as identity     NOT NULL , 
      nm_uf varchar  (45)    NOT NULL , 
      sg_uf char  (2)    NOT NULL , 
      cd_ibge varchar  (10)    NOT NULL , 
 PRIMARY KEY (id_uf)) ; 

CREATE TABLE tb_usuario( 
      id_usuario  integer generated by default as identity     NOT NULL , 
      nm_usuario varchar  (200)    NOT NULL , 
      cd_cpf varchar  (15)    NOT NULL , 
      cd_telefone varchar  (20)    NOT NULL , 
      nm_cargo varchar  (60)    NOT NULL , 
      cd_senha varchar  (15)    NOT NULL , 
      cd_email varchar  (100)    NOT NULL , 
      ic_ativo char(1)   , 
      tb_perfil_usuario_id integer    NOT NULL , 
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

  
