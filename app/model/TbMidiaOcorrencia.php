<?php

class TbMidiaOcorrencia extends TRecord
{
    const TABLENAME  = 'tb_midia_ocorrencia';
    const PRIMARYKEY = 'id_midia_ocorrencia';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('im_midia1');
        parent::addAttribute('im_midia2');
        parent::addAttribute('im_midia3');
            
    }

    
}

