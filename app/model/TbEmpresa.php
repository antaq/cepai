<?php

class TbEmpresa extends TRecord
{
    const TABLENAME  = 'tb_empresa';
    const PRIMARYKEY = 'id_empresa';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $tb_cidade;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nm_empresa');
        parent::addAttribute('cd_cnpj');
        parent::addAttribute('ds_endereco');
        parent::addAttribute('cd_cep');
        parent::addAttribute('nm_bairro');
        parent::addAttribute('ds_complemento');
        parent::addAttribute('cd_numero');
        parent::addAttribute('tb_cidade_id');
            
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
     * Method getTbOcorrencias
     */
    public function getTbOcorrencias()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tb_empresa_id', '=', $this->id_empresa));
        return TbOcorrencia::getObjects( $criteria );
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
    
        $values = TbOcorrencia::where('tb_empresa_id', '=', $this->id_empresa)->getIndexedArray('tb_empresa_id','{tb_empresa->id_empresa}');
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
    
        $values = TbOcorrencia::where('tb_empresa_id', '=', $this->id_empresa)->getIndexedArray('tb_tipo_ocorrencia_id','{tb_tipo_ocorrencia->id_tipo_ocorrencia}');
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
    
        $values = TbOcorrencia::where('tb_empresa_id', '=', $this->id_empresa)->getIndexedArray('tb_gravidade_id','{tb_gravidade->id_gravidade}');
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
    
        $values = TbOcorrencia::where('tb_empresa_id', '=', $this->id_empresa)->getIndexedArray('system_users_id','{system_users->name}');
        return implode(', ', $values);
    }

    
}

