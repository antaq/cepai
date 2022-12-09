<?php

class TbUfForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'cepai';
    private static $activeRecord = 'TbUf';
    private static $primaryKey = 'id_uf';
    private static $formName = 'form_TbUfForm';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Cadastro de Estado");


        $nm_uf = new TEntry('nm_uf');
        $sg_uf = new TEntry('sg_uf');
        $cd_ibge = new TEntry('cd_ibge');
        $id_uf = new THidden('id_uf');

        $nm_uf->addValidation("Nome do Estado", new TRequiredValidator()); 
        $sg_uf->addValidation("Sigla do Estado", new TRequiredValidator()); 
        $cd_ibge->addValidation("Nome do Estado", new TRequiredValidator()); 

        $sg_uf->setMaxLength(2);
        $nm_uf->setMaxLength(45);
        $cd_ibge->setMaxLength(45);

        $id_uf->setSize(200);
        $nm_uf->setSize('100%');
        $sg_uf->setSize('100%');
        $cd_ibge->setSize('100%');

        $row1 = $this->form->addFields([new TLabel(new TImage('fas:flag #0689C6')."Insira os dados do Estado", '#F7FAFD', '18px', 'B', '100%')],[]);
        $row1->layout = [' col-sm-12','col-sm-2'];

        $row2 = $this->form->addFields([new TLabel("Nome do Estado", '#F7FAFD', '16px', null, '100%'),$nm_uf]);
        $row2->layout = [' col-sm-12'];

        $row3 = $this->form->addFields([new TLabel("Sigla do Estado", '#F7FAFD', '16px', null, '100%'),$sg_uf]);
        $row3->layout = [' col-sm-12'];

        $row4 = $this->form->addFields([new TLabel("Código IBGE", '#F7FAFD', '16px', null, '100%'),$cd_ibge]);
        $row4->layout = [' col-sm-12'];

        $row5 = $this->form->addFields([$id_uf]);
        $row5->layout = [' col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Concluir", new TAction([$this, 'onSave']), 'fas:check-circle #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-success'); 

        parent::setTargetContainer('adianti_right_panel');

        $btnClose = new TButton('closeCurtain');
        $btnClose->class = 'btn btn-sm btn-default';
        $btnClose->style = 'margin-right:10px;';
        $btnClose->onClick = "Template.closeRightPanel();";
        $btnClose->setLabel("Fechar");
        $btnClose->setImage('fas:times');

        $this->form->addHeaderWidget($btnClose);

        parent::add($this->form);

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new TbUf(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            // get the generated {PRIMARY_KEY}
            $data->id_uf = $object->id_uf; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('TbUfHeaderList', 'onShow', $loadPageParam); 

                        TScript::create("Template.closeRightPanel();"); 
        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode> 

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new TbUf($key); // instantiates the Active Record 

                $this->form->setData($object); // fill the form 

                TTransaction::close(); // close the transaction 
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(true);

    }

    public function onShow($param = null)
    {

    } 

}

