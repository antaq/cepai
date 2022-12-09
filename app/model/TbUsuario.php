<?php

class TbUsuario extends TRecord
{
    const TABLENAME  = 'tb_usuario';
    const PRIMARYKEY = 'id_usuario';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $tb_perfil_usuario;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nm_usuario');
        parent::addAttribute('cd_cpf');
        parent::addAttribute('cd_telefone');
        parent::addAttribute('nm_cargo');
        parent::addAttribute('cd_senha');
        parent::addAttribute('cd_email');
        parent::addAttribute('ic_ativo');
        parent::addAttribute('tb_perfil_usuario_id');
            
    }

    /**
     * Method set_tb_perfil_usuario
     * Sample of usage: $var->tb_perfil_usuario = $object;
     * @param $object Instance of TbPerfilUsuario
     */
    public function set_tb_perfil_usuario(TbPerfilUsuario $object)
    {
        $this->tb_perfil_usuario = $object;
        $this->tb_perfil_usuario_id = $object->id_perfil_usuario;
    }

    /**
     * Method get_tb_perfil_usuario
     * Sample of usage: $var->tb_perfil_usuario->attribute;
     * @returns TbPerfilUsuario instance
     */
    public function get_tb_perfil_usuario()
    {
    
        // loads the associated object
        if (empty($this->tb_perfil_usuario))
            $this->tb_perfil_usuario = new TbPerfilUsuario($this->tb_perfil_usuario_id);
    
        // returns the associated object
        return $this->tb_perfil_usuario;
    }

    
}

