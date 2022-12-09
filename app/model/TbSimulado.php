<?php

class TbSimulado extends TRecord
{
    const TABLENAME  = 'tb_simulado';
    const PRIMARYKEY = 'id_simulado';
    const IDPOLICY   =  'serial'; // {max, serial}

    const CREATEDAT  = 'dt_created_at';

    private $system_users;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('dt_simulado');
        parent::addAttribute('dt_created_at');
        parent::addAttribute('ds_relatorio');
        parent::addAttribute('system_users_id');
            
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

    
}

