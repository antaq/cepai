<?php

class TbPerfilUsuario extends TRecord
{
    const TABLENAME  = 'tb_perfil_usuario';
    const PRIMARYKEY = 'id_perfil_usuario';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nm_perfil_usuario');
            
    }

    /**
     * Method getTbUsuarios
     */
    public function getTbUsuarios()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tb_perfil_usuario_id', '=', $this->id_perfil_usuario));
        return TbUsuario::getObjects( $criteria );
    }

    public function set_tb_usuario_tb_perfil_usuario_to_string($tb_usuario_tb_perfil_usuario_to_string)
    {
        if(is_array($tb_usuario_tb_perfil_usuario_to_string))
        {
            $values = TbPerfilUsuario::where('id_perfil_usuario', 'in', $tb_usuario_tb_perfil_usuario_to_string)->getIndexedArray('id_perfil_usuario', 'id_perfil_usuario');
            $this->tb_usuario_tb_perfil_usuario_to_string = implode(', ', $values);
        }
        else
        {
            $this->tb_usuario_tb_perfil_usuario_to_string = $tb_usuario_tb_perfil_usuario_to_string;
        }

        $this->vdata['tb_usuario_tb_perfil_usuario_to_string'] = $this->tb_usuario_tb_perfil_usuario_to_string;
    }

    public function get_tb_usuario_tb_perfil_usuario_to_string()
    {
        if(!empty($this->tb_usuario_tb_perfil_usuario_to_string))
        {
            return $this->tb_usuario_tb_perfil_usuario_to_string;
        }
    
        $values = TbUsuario::where('tb_perfil_usuario_id', '=', $this->id_perfil_usuario)->getIndexedArray('tb_perfil_usuario_id','{tb_perfil_usuario->id_perfil_usuario}');
        return implode(', ', $values);
    }

    
}

