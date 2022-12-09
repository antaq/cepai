<?php

class TbOcorrencia extends TRecord
{
    const TABLENAME  = 'tb_ocorrencia';
    const PRIMARYKEY = 'id_ocorrencia';
    const IDPOLICY   =  'serial'; // {max, serial}

    const DELETEDAT  = 'dt_deleted_at';
    const CREATEDAT  = 'dt_created_at';
    const UPDATEDAT  = 'dt_updated_at';

    private $tb_tipo_ocorrencia;
    private $tb_gravidade;
    private $system_users;
    private $tb_empresa;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('dt_ocorrencia');
        parent::addAttribute('dt_created_at');
        parent::addAttribute('dt_updated_at');
        parent::addAttribute('dt_deleted_at');
        parent::addAttribute('ic_mudar_empresa');
        parent::addAttribute('nm_outro_motivo');
        parent::addAttribute('ds_resumo');
        parent::addAttribute('qt_vitimas');
        parent::addAttribute('im_midia1');
        parent::addAttribute('im_midia2');
        parent::addAttribute('im_midia3');
        parent::addAttribute('ds_endereco');
        parent::addAttribute('tb_empresa_id');
        parent::addAttribute('tb_tipo_ocorrencia_id');
        parent::addAttribute('tb_gravidade_id');
        parent::addAttribute('system_users_id');
            
    }

    /**
     * Method set_tb_tipo_ocorrencia
     * Sample of usage: $var->tb_tipo_ocorrencia = $object;
     * @param $object Instance of TbTipoOcorrencia
     */
    public function set_tb_tipo_ocorrencia(TbTipoOcorrencia $object)
    {
        $this->tb_tipo_ocorrencia = $object;
        $this->tb_tipo_ocorrencia_id = $object->id_tipo_ocorrencia;
    }

    /**
     * Method get_tb_tipo_ocorrencia
     * Sample of usage: $var->tb_tipo_ocorrencia->attribute;
     * @returns TbTipoOcorrencia instance
     */
    public function get_tb_tipo_ocorrencia()
    {
    
        // loads the associated object
        if (empty($this->tb_tipo_ocorrencia))
            $this->tb_tipo_ocorrencia = new TbTipoOcorrencia($this->tb_tipo_ocorrencia_id);
    
        // returns the associated object
        return $this->tb_tipo_ocorrencia;
    }
    /**
     * Method set_tb_gravidade
     * Sample of usage: $var->tb_gravidade = $object;
     * @param $object Instance of TbGravidade
     */
    public function set_tb_gravidade(TbGravidade $object)
    {
        $this->tb_gravidade = $object;
        $this->tb_gravidade_id = $object->id_gravidade;
    }

    /**
     * Method get_tb_gravidade
     * Sample of usage: $var->tb_gravidade->attribute;
     * @returns TbGravidade instance
     */
    public function get_tb_gravidade()
    {
    
        // loads the associated object
        if (empty($this->tb_gravidade))
            $this->tb_gravidade = new TbGravidade($this->tb_gravidade_id);
    
        // returns the associated object
        return $this->tb_gravidade;
    }
    /**
     * Method set_system_users
     * Sample of usage: $var->system_users = $object;
     * @param $object Instance of SystemUsers
     */
    public function set_system_users(SystemUsers $object)
    {
        $this->system_users = $object;
        $this->system_users_id = $object->id;
    }

    /**
     * Method get_system_users
     * Sample of usage: $var->system_users->attribute;
     * @returns SystemUsers instance
     */
    public function get_system_users()
    {
    
        // loads the associated object
        if (empty($this->system_users))
            $this->system_users = new SystemUsers($this->system_users_id);
    
        // returns the associated object
        return $this->system_users;
    }
    /**
     * Method set_tb_empresa
     * Sample of usage: $var->tb_empresa = $object;
     * @param $object Instance of TbEmpresa
     */
    public function set_tb_empresa(TbEmpresa $object)
    {
        $this->tb_empresa = $object;
        $this->tb_empresa_id = $object->id_empresa;
    }

    /**
     * Method get_tb_empresa
     * Sample of usage: $var->tb_empresa->attribute;
     * @returns TbEmpresa instance
     */
    public function get_tb_empresa()
    {
    
        // loads the associated object
        if (empty($this->tb_empresa))
            $this->tb_empresa = new TbEmpresa($this->tb_empresa_id);
    
        // returns the associated object
        return $this->tb_empresa;
    }

    /**
     * Method getTbComplementos
     */
    public function getTbComplementos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tb_ocorrencia_id', '=', $this->id_ocorrencia));
        return TbComplemento::getObjects( $criteria );
    }

    public function set_tb_complemento_system_users_to_string($tb_complemento_system_users_to_string)
    {
        if(is_array($tb_complemento_system_users_to_string))
        {
            $values = SystemUsers::where('id', 'in', $tb_complemento_system_users_to_string)->getIndexedArray('name', 'name');
            $this->tb_complemento_system_users_to_string = implode(', ', $values);
        }
        else
        {
            $this->tb_complemento_system_users_to_string = $tb_complemento_system_users_to_string;
        }

        $this->vdata['tb_complemento_system_users_to_string'] = $this->tb_complemento_system_users_to_string;
    }

    public function get_tb_complemento_system_users_to_string()
    {
        if(!empty($this->tb_complemento_system_users_to_string))
        {
            return $this->tb_complemento_system_users_to_string;
        }
    
        $values = TbComplemento::where('tb_ocorrencia_id', '=', $this->id_ocorrencia)->getIndexedArray('system_users_id','{system_users->name}');
        return implode(', ', $values);
    }

    public function set_tb_complemento_tb_ocorrencia_to_string($tb_complemento_tb_ocorrencia_to_string)
    {
        if(is_array($tb_complemento_tb_ocorrencia_to_string))
        {
            $values = TbOcorrencia::where('id_ocorrencia', 'in', $tb_complemento_tb_ocorrencia_to_string)->getIndexedArray('id_ocorrencia', 'id_ocorrencia');
            $this->tb_complemento_tb_ocorrencia_to_string = implode(', ', $values);
        }
        else
        {
            $this->tb_complemento_tb_ocorrencia_to_string = $tb_complemento_tb_ocorrencia_to_string;
        }

        $this->vdata['tb_complemento_tb_ocorrencia_to_string'] = $this->tb_complemento_tb_ocorrencia_to_string;
    }

    public function get_tb_complemento_tb_ocorrencia_to_string()
    {
        if(!empty($this->tb_complemento_tb_ocorrencia_to_string))
        {
            return $this->tb_complemento_tb_ocorrencia_to_string;
        }
    
        $values = TbComplemento::where('tb_ocorrencia_id', '=', $this->id_ocorrencia)->getIndexedArray('tb_ocorrencia_id','{tb_ocorrencia->id_ocorrencia}');
        return implode(', ', $values);
    }

    
}

