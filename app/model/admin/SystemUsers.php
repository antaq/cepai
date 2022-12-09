<?php

class SystemUsers extends TRecord
{
    const TABLENAME  = 'system_users';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}

    private $system_unit;
    private $frontpage;
    private $tb_empresa;
    private $tb_cidade;
    private $tb_area_porto;

    private $unit;
    private $system_user_groups = array();
    private $system_user_programs = array();
    private $system_user_units = array();
            

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('name');
        parent::addAttribute('login');
        parent::addAttribute('password');
        parent::addAttribute('email');
        parent::addAttribute('cd_telefone');
        parent::addAttribute('nm_cargo');
        parent::addAttribute('frontpage_id');
        parent::addAttribute('system_unit_id');
        parent::addAttribute('active');
        parent::addAttribute('accepted_term_policy_at');
        parent::addAttribute('accepted_term_policy');
        parent::addAttribute('tb_empresa_id');
        parent::addAttribute('tb_cidade_id');
        parent::addAttribute('tb_area_porto_id');
    
    }

    /**
     * Method set_system_unit
     * Sample of usage: $var->system_unit = $object;
     * @param $object Instance of SystemUnit
     */
    public function set_system_unit(SystemUnit $object)
    {
        $this->system_unit = $object;
        $this->system_unit_id = $object->id;
    }

    /**
     * Method get_system_unit
     * Sample of usage: $var->system_unit->attribute;
     * @returns SystemUnit instance
     */
    public function get_system_unit()
    {
    
        // loads the associated object
        if (empty($this->system_unit))
            $this->system_unit = new SystemUnit($this->system_unit_id);
    
        // returns the associated object
        return $this->system_unit;
    }
    /**
     * Method set_system_program
     * Sample of usage: $var->system_program = $object;
     * @param $object Instance of SystemProgram
     */
    public function set_frontpage(SystemProgram $object)
    {
        $this->frontpage = $object;
        $this->frontpage_id = $object->id;
    }

    /**
     * Method get_frontpage
     * Sample of usage: $var->frontpage->attribute;
     * @returns SystemProgram instance
     */
    public function get_frontpage()
    {
    
        // loads the associated object
        if (empty($this->frontpage))
            $this->frontpage = new SystemProgram($this->frontpage_id);
    
        // returns the associated object
        return $this->frontpage;
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
     * Method set_tb_cidade
     * Sample of usage: $var->tb_cidade = $object;
     * @param $object Instance of TbCidade
     */
    public function set_tb_cidade(TbCidade $object)
    {
        $this->tb_cidade = $object;
        $this->tb_cidade_id = $object->id_cidade;
    }

    /**
     * Method get_tb_cidade
     * Sample of usage: $var->tb_cidade->attribute;
     * @returns TbCidade instance
     */
    public function get_tb_cidade()
    {
    
        // loads the associated object
        if (empty($this->tb_cidade))
            $this->tb_cidade = new TbCidade($this->tb_cidade_id);
    
        // returns the associated object
        return $this->tb_cidade;
    }
    /**
     * Method set_tb_area_porto
     * Sample of usage: $var->tb_area_porto = $object;
     * @param $object Instance of TbAreaPorto
     */
    public function set_tb_area_porto(TbAreaPorto $object)
    {
        $this->tb_area_porto = $object;
        $this->tb_area_porto_id = $object->id_area_porto;
    }

    /**
     * Method get_tb_area_porto
     * Sample of usage: $var->tb_area_porto->attribute;
     * @returns TbAreaPorto instance
     */
    public function get_tb_area_porto()
    {
    
        // loads the associated object
        if (empty($this->tb_area_porto))
            $this->tb_area_porto = new TbAreaPorto($this->tb_area_porto_id);
    
        // returns the associated object
        return $this->tb_area_porto;
    }

    /**
     * Method getTbOcorrencias
     */
    public function getTbOcorrencias()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('system_users_id', '=', $this->id));
        return TbOcorrencia::getObjects( $criteria );
    }
    /**
     * Method getTbComplementos
     */
    public function getTbComplementos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('system_users_id', '=', $this->id));
        return TbComplemento::getObjects( $criteria );
    }
    /**
     * Method getTbSimulados
     */
    public function getTbSimulados()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('system_users_id', '=', $this->id));
        return TbSimulado::getObjects( $criteria );
    }

    public function set_tb_ocorrencia_tb_empresa_to_string($tb_ocorrencia_tb_empresa_to_string)
    {
        if(is_array($tb_ocorrencia_tb_empresa_to_string))
        {
            $values = TbEmpresa::where('id_empresa', 'in', $tb_ocorrencia_tb_empresa_to_string)->getIndexedArray('id_empresa', 'id_empresa');
            $this->tb_ocorrencia_tb_empresa_to_string = implode(', ', $values);
        }
        else
        {
            $this->tb_ocorrencia_tb_empresa_to_string = $tb_ocorrencia_tb_empresa_to_string;
        }

        $this->vdata['tb_ocorrencia_tb_empresa_to_string'] = $this->tb_ocorrencia_tb_empresa_to_string;
    }

    public function get_tb_ocorrencia_tb_empresa_to_string()
    {
        if(!empty($this->tb_ocorrencia_tb_empresa_to_string))
        {
            return $this->tb_ocorrencia_tb_empresa_to_string;
        }
    
        $values = TbOcorrencia::where('system_users_id', '=', $this->id)->getIndexedArray('tb_empresa_id','{tb_empresa->id_empresa}');
        return implode(', ', $values);
    }

    public function set_tb_ocorrencia_tb_tipo_ocorrencia_to_string($tb_ocorrencia_tb_tipo_ocorrencia_to_string)
    {
        if(is_array($tb_ocorrencia_tb_tipo_ocorrencia_to_string))
        {
            $values = TbTipoOcorrencia::where('id_tipo_ocorrencia', 'in', $tb_ocorrencia_tb_tipo_ocorrencia_to_string)->getIndexedArray('id_tipo_ocorrencia', 'id_tipo_ocorrencia');
            $this->tb_ocorrencia_tb_tipo_ocorrencia_to_string = implode(', ', $values);
        }
        else
        {
            $this->tb_ocorrencia_tb_tipo_ocorrencia_to_string = $tb_ocorrencia_tb_tipo_ocorrencia_to_string;
        }

        $this->vdata['tb_ocorrencia_tb_tipo_ocorrencia_to_string'] = $this->tb_ocorrencia_tb_tipo_ocorrencia_to_string;
    }

    public function get_tb_ocorrencia_tb_tipo_ocorrencia_to_string()
    {
        if(!empty($this->tb_ocorrencia_tb_tipo_ocorrencia_to_string))
        {
            return $this->tb_ocorrencia_tb_tipo_ocorrencia_to_string;
        }
    
        $values = TbOcorrencia::where('system_users_id', '=', $this->id)->getIndexedArray('tb_tipo_ocorrencia_id','{tb_tipo_ocorrencia->id_tipo_ocorrencia}');
        return implode(', ', $values);
    }

    public function set_tb_ocorrencia_tb_gravidade_to_string($tb_ocorrencia_tb_gravidade_to_string)
    {
        if(is_array($tb_ocorrencia_tb_gravidade_to_string))
        {
            $values = TbGravidade::where('id_gravidade', 'in', $tb_ocorrencia_tb_gravidade_to_string)->getIndexedArray('id_gravidade', 'id_gravidade');
            $this->tb_ocorrencia_tb_gravidade_to_string = implode(', ', $values);
        }
        else
        {
            $this->tb_ocorrencia_tb_gravidade_to_string = $tb_ocorrencia_tb_gravidade_to_string;
        }

        $this->vdata['tb_ocorrencia_tb_gravidade_to_string'] = $this->tb_ocorrencia_tb_gravidade_to_string;
    }

    public function get_tb_ocorrencia_tb_gravidade_to_string()
    {
        if(!empty($this->tb_ocorrencia_tb_gravidade_to_string))
        {
            return $this->tb_ocorrencia_tb_gravidade_to_string;
        }
    
        $values = TbOcorrencia::where('system_users_id', '=', $this->id)->getIndexedArray('tb_gravidade_id','{tb_gravidade->id_gravidade}');
        return implode(', ', $values);
    }

    public function set_tb_ocorrencia_system_users_to_string($tb_ocorrencia_system_users_to_string)
    {
        if(is_array($tb_ocorrencia_system_users_to_string))
        {
            $values = SystemUsers::where('id', 'in', $tb_ocorrencia_system_users_to_string)->getIndexedArray('name', 'name');
            $this->tb_ocorrencia_system_users_to_string = implode(', ', $values);
        }
        else
        {
            $this->tb_ocorrencia_system_users_to_string = $tb_ocorrencia_system_users_to_string;
        }

        $this->vdata['tb_ocorrencia_system_users_to_string'] = $this->tb_ocorrencia_system_users_to_string;
    }

    public function get_tb_ocorrencia_system_users_to_string()
    {
        if(!empty($this->tb_ocorrencia_system_users_to_string))
        {
            return $this->tb_ocorrencia_system_users_to_string;
        }
    
        $values = TbOcorrencia::where('system_users_id', '=', $this->id)->getIndexedArray('system_users_id','{system_users->name}');
        return implode(', ', $values);
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
    
        $values = TbComplemento::where('system_users_id', '=', $this->id)->getIndexedArray('system_users_id','{system_users->name}');
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
    
        $values = TbComplemento::where('system_users_id', '=', $this->id)->getIndexedArray('tb_ocorrencia_id','{tb_ocorrencia->id_ocorrencia}');
        return implode(', ', $values);
    }

    public function set_tb_simulado_system_users_to_string($tb_simulado_system_users_to_string)
    {
        if(is_array($tb_simulado_system_users_to_string))
        {
            $values = SystemUsers::where('id', 'in', $tb_simulado_system_users_to_string)->getIndexedArray('name', 'name');
            $this->tb_simulado_system_users_to_string = implode(', ', $values);
        }
        else
        {
            $this->tb_simulado_system_users_to_string = $tb_simulado_system_users_to_string;
        }

        $this->vdata['tb_simulado_system_users_to_string'] = $this->tb_simulado_system_users_to_string;
    }

    public function get_tb_simulado_system_users_to_string()
    {
        if(!empty($this->tb_simulado_system_users_to_string))
        {
            return $this->tb_simulado_system_users_to_string;
        }
    
        $values = TbSimulado::where('system_users_id', '=', $this->id)->getIndexedArray('system_users_id','{system_users->name}');
        return implode(', ', $values);
    }

    /**
     * Return the user' group's
     * @return Collection of SystemGroup
     */
    public function getSystemUserGroups()
    {
        return parent::loadAggregate('SystemGroup', 'SystemUserGroup', 'system_user_id', 'system_group_id', $this->id);
    }

    /**
     * Return the user' unit's
     * @return Collection of SystemUnit
     */
    public function getSystemUserUnits()
    {
        return parent::loadAggregate('SystemUnit', 'SystemUserUnit', 'system_user_id', 'system_unit_id', $this->id);
    }

    /**
     * Return the user' program's
     * @return Collection of SystemProgram
     */
    public function getSystemUserPrograms()
    {
        return parent::loadAggregate('SystemProgram', 'SystemUserProgram', 'system_user_id', 'system_program_id', $this->id);
    }

    /**
     * Returns the frontpage name
     */
    public function get_frontpage_name()
    {
        // loads the associated object
        if (empty($this->frontpage))
            $this->frontpage = new SystemProgram($this->frontpage_id);

        // returns the associated object
        return $this->frontpage->name;
    }

    /**
     * Returns the unit
     */
    public function get_unit()
    {
        // loads the associated object
        if (empty($this->unit))
            $this->unit = new SystemUnit($this->system_unit_id);

        // returns the associated object
        return $this->unit;
    }

    /**
     * Add a Group to the user
     * @param $object Instance of SystemGroup
     */
    public function addSystemUserGroup(SystemGroup $systemgroup)
    {
        $object = new SystemUserGroup;
        $object->system_group_id = $systemgroup->id;
        $object->system_user_id = $this->id;
        $object->store();
    }

    /**
     * Add a Unit to the user
     * @param $object Instance of SystemUnit
     */
    public function addSystemUserUnit(SystemUnit $systemunit)
    {
        $object = new SystemUserUnit;
        $object->system_unit_id = $systemunit->id;
        $object->system_user_id = $this->id;
        $object->store();
    }

    /**
     * Add a program to the user
     * @param $object Instance of SystemProgram
     */
    public function addSystemUserProgram(SystemProgram $systemprogram)
    {
        $object = new SystemUserProgram;
        $object->system_program_id = $systemprogram->id;
        $object->system_user_id = $this->id;
        $object->store();
    }

    /**
     * Get user group ids
     */
    public function getSystemUserGroupIds( $as_string = false )
    {
        $groupids = array();
        $groups = $this->getSystemUserGroups();
        if ($groups)
        {
            foreach ($groups as $group)
            {
                $groupids[] = $group->id;
            }
        }
    
        if ($as_string)
        {
            return implode(',', $groupids);
        }
    
        return $groupids;
    }

    /**
     * Get user unit ids
     */
    public function getSystemUserUnitIds( $as_string = false )
    {
        $unitids = array();
        $units = $this->getSystemUserUnits();
        if ($units)
        {
            foreach ($units as $unit)
            {
                $unitids[] = $unit->id;
            }
        }
    
        if ($as_string)
        {
            return implode(',', $unitids);
        }
    
        return $unitids;
    }

    /**
     * Get user group names
     */
    public function getSystemUserGroupNames()
    {
        $groupnames = array();
        $groups = $this->getSystemUserGroups();
        if ($groups)
        {
            foreach ($groups as $group)
            {
                $groupnames[] = $group->name;
            }
        }
    
        return implode(',', $groupnames);
    }

    /**
     * Reset aggregates
     */
    public function clearParts()
    {
        SystemUserGroup::where('system_user_id', '=', $this->id)->delete();
        SystemUserUnit::where('system_user_id', '=', $this->id)->delete();
        SystemUserProgram::where('system_user_id', '=', $this->id)->delete();
    }

    /**
     * Delete the object and its aggregates
     * @param $id object ID
     */
    public function delete($id = NULL)
    {
        // delete the related System_userSystem_user_group objects
        $id = isset($id) ? $id : $this->id;
    
        SystemUserGroup::where('system_user_id', '=', $id)->delete();
        SystemUserUnit::where('system_user_id', '=', $id)->delete();
        SystemUserProgram::where('system_user_id', '=', $id)->delete();
    
        // delete the object itself
        parent::delete($id);
    }

    /**
     * Validate user login
     * @param $login String with user login
     */
    public static function validate($login)
    {
        $user = self::newFromLogin($login);
    
        if ($user instanceof SystemUsers)
        {
            if ($user->active == 'N')
            {
                throw new Exception(_t('Inactive user'));
            }
        }
        else
        {
            throw new Exception(_t('User not found'));
        }
    
        return $user;
    }

    /**
     * Authenticate the user
     * @param $login String with user login
     * @param $password String with user password
     * @returns TRUE if the password matches, otherwise throw Exception
     */
    public static function authenticate($login, $password)
    {
        $user = self::newFromLogin($login);
        if ($user->password !== md5($password))
        {
            throw new Exception(_t('Wrong password'));
        }
    
        return $user;
    }

    /**
     * Returns a SystemUser object based on its login
     * @param $login String with user login
     */
    static public function newFromLogin($login)
    {
        return SystemUsers::where('login', '=', $login)->first();
    }

    /**
     * Returns a SystemUser object based on its e-mail
     * @param $email String with user email
     */
    static public function newFromEmail($email)
    {
        return SystemUsers::where('email', '=', $email)->first();
    }

    /**
     * Return the programs the user has permission to run
     */
    public function getPrograms()
    {
        $programs = array();
    
        foreach( $this->getSystemUserGroups() as $group )
        {
            foreach( $group->getSystemPrograms() as $prog )
            {
                $programs[$prog->controller] = true;
            }
        }
            
        foreach( $this->getSystemUserPrograms() as $prog )
        {
            $programs[$prog->controller] = true;
        }
    
        return $programs;
    }

    /**
     * Return the programs the user has permission to run
     */
    public function getProgramsList()
    {
        $programs = array();
    
        foreach( $this->getSystemUserGroups() as $group )
        {
            foreach( $group->getSystemPrograms() as $prog )
            {
                $programs[$prog->controller] = $prog->name;
            }
        }
            
        foreach( $this->getSystemUserPrograms() as $prog )
        {
            $programs[$prog->controller] = $prog->name;
        }
    
        asort($programs);
        return $programs;
    }

    /**
     * Check if the user is within a group
     */
    public function checkInGroup( SystemGroup $group )
    {
        $user_groups = array();
        foreach( $this->getSystemUserGroups() as $user_group )
        {
            $user_groups[] = $user_group->id;
        }

        return in_array($group->id, $user_groups);
    }

    /**
     *
     */
    public static function getInGroups( $groups )
    {
        $collection = [];
        $users = self::all();
        if ($users)
        {
            foreach ($users as $user)
            {
                foreach ($groups as $group)
                {
                    if ($user->checkInGroup($group))
                    {
                        $collection[] = $user;
                    }
                }
            }
        }
        return $collection;
    }

    /**
     * Clone the entire object and related ones
     */
    public function cloneUser()
    {
        $groups   = $this->getSystemUserGroups();
        $units    = $this->getSystemUserUnits();
        $programs = $this->getSystemUserPrograms();
        unset($this->id);
        $this->name .= ' (clone)';
        $this->store();
        if ($groups)
        {
            foreach ($groups as $group)
            {
                $this->addSystemUserGroup( $group );
            }
        }
        if ($units)
        {
            foreach ($units as $unit)
            {
                $this->addSystemUserUnit( $unit );
            }
        }
        if ($programs)
        {
            foreach ($programs as $program)
            {
                $this->addSystemUserProgram( $program );
            }
        }
    }

            
}

