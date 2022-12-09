<?php

class TbAreaPorto extends TRecord
{
    const TABLENAME  = 'tb_area_porto';
    const PRIMARYKEY = 'id_area_porto';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nm_area_porto');
            
    }

    
}

