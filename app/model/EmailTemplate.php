<?php

class EmailTemplate extends TRecord
{
    const TABLENAME  = 'email_template';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const CREATEDAT  = 'dt_created_at';
    const ATUALIZACAO = '1';
    const TEMPLATE1 = '2';
    const TEMPLATE2 = '3';
    const TEMPLATE3 = '4';

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('titulo');
        parent::addAttribute('mensagem');
        parent::addAttribute('dt_created_at');
            
    }

    
}

