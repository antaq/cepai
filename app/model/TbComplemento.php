<?php

class TbComplemento extends TRecord
{
    const TABLENAME  = 'tb_complemento';
    const PRIMARYKEY = 'id_complemento';
    const IDPOLICY   =  'serial'; // {max, serial}

    const CREATEDAT  = 'dt_created_at';

    private $system_users;
    private $tb_ocorrencia;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('ds_complemento');
        parent::addAttribute('dt_created_at');
        parent::addAttribute('system_users_id');
        parent::addAttribute('tb_ocorrencia_id');
            
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
     * Method set_tb_ocorrencia
     * Sample of usage: $var->tb_ocorrencia = $object;
     * @param $object Instance of TbOcorrencia
     */
    public function set_tb_ocorrencia(TbOcorrencia $object)
    {
        $this->tb_ocorrencia = $object;
        $this->tb_ocorrencia_id = $object->id_ocorrencia;
    }

    /**
     * Method get_tb_ocorrencia
     * Sample of usage: $var->tb_ocorrencia->attribute;
     * @returns TbOcorrencia instance
     */
    public function get_tb_ocorrencia()
    {
    
        // loads the associated object
        if (empty($this->tb_ocorrencia))
            $this->tb_ocorrencia = new TbOcorrencia($this->tb_ocorrencia_id);
    
        // returns the associated object
        return $this->tb_ocorrencia;
    }

    
}

