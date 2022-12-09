<?php

class TbCidade extends TRecord
{
    const TABLENAME  = 'tb_cidade';
    const PRIMARYKEY = 'id_cidade';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $tb_uf;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nm_cidade');
        parent::addAttribute('cd_ibge');
        parent::addAttribute('tb_uf_id');
            
    }

    /**
     * Method set_tb_uf
     * Sample of usage: $var->tb_uf = $object;
     * @param $object Instance of TbUf
     */
    public function set_tb_uf(TbUf $object)
    {
        $this->tb_uf = $object;
        $this->tb_uf_id = $object->id_uf;
    }

    /**
     * Method get_tb_uf
     * Sample of usage: $var->tb_uf->attribute;
     * @returns TbUf instance
     */
    public function get_tb_uf()
    {
    
        // loads the associated object
        if (empty($this->tb_uf))
            $this->tb_uf = new TbUf($this->tb_uf_id);
    
        // returns the associated object
        return $this->tb_uf;
    }

    /**
     * Method getTbEmpresas
     */
    public function getTbEmpresas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tb_cidade_id', '=', $this->id_cidade));
        return TbEmpresa::getObjects( $criteria );
    }

    public function set_tb_empresa_tb_cidade_to_string($tb_empresa_tb_cidade_to_string)
    {
        if(is_array($tb_empresa_tb_cidade_to_string))
        {
            $values = TbCidade::where('id_cidade', 'in', $tb_empresa_tb_cidade_to_string)->getIndexedArray('id_cidade', 'id_cidade');
            $this->tb_empresa_tb_cidade_to_string = implode(', ', $values);
        }
        else
        {
            $this->tb_empresa_tb_cidade_to_string = $tb_empresa_tb_cidade_to_string;
        }

        $this->vdata['tb_empresa_tb_cidade_to_string'] = $this->tb_empresa_tb_cidade_to_string;
    }

    public function get_tb_empresa_tb_cidade_to_string()
    {
        if(!empty($this->tb_empresa_tb_cidade_to_string))
        {
            return $this->tb_empresa_tb_cidade_to_string;
        }
    
        $values = TbEmpresa::where('tb_cidade_id', '=', $this->id_cidade)->getIndexedArray('tb_cidade_id','{tb_cidade->id_cidade}');
        return implode(', ', $values);
    }

    
}

