<?php

class TbUf extends TRecord
{
    const TABLENAME  = 'tb_uf';
    const PRIMARYKEY = 'id_uf';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nm_uf');
        parent::addAttribute('sg_uf');
        parent::addAttribute('cd_ibge');
            
    }

    /**
     * Method getTbCidades
     */
    public function getTbCidades()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tb_uf_id', '=', $this->id_uf));
        return TbCidade::getObjects( $criteria );
    }

    public function set_tb_cidade_tb_uf_to_string($tb_cidade_tb_uf_to_string)
    {
        if(is_array($tb_cidade_tb_uf_to_string))
        {
            $values = TbUf::where('id_uf', 'in', $tb_cidade_tb_uf_to_string)->getIndexedArray('id_uf', 'id_uf');
            $this->tb_cidade_tb_uf_to_string = implode(', ', $values);
        }
        else
        {
            $this->tb_cidade_tb_uf_to_string = $tb_cidade_tb_uf_to_string;
        }

        $this->vdata['tb_cidade_tb_uf_to_string'] = $this->tb_cidade_tb_uf_to_string;
    }

    public function get_tb_cidade_tb_uf_to_string()
    {
        if(!empty($this->tb_cidade_tb_uf_to_string))
        {
            return $this->tb_cidade_tb_uf_to_string;
        }
    
        $values = TbCidade::where('tb_uf_id', '=', $this->id_uf)->getIndexedArray('tb_uf_id','{tb_uf->id_uf}');
        return implode(', ', $values);
    }

    
}

