<?php

class TbGravidadeForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'cepai';
    private static $activeRecord = 'TbGravidade';
    private static $primaryKey = 'id_gravidade';
    private static $formName = 'form_TbGravidadeForm';

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
        $this->form->setFormTitle("Cadastro de Gravidade");


        $nm_gravidade = new TEntry('nm_gravidade');
        $cd_cor = new TEntry('cd_cor');
        $id_gravidade = new THidden('id_gravidade');

        $nm_gravidade->addValidation("Nm gravidade", new TRequiredValidator()); 
        $cd_cor->addValidation("Nm gravidade", new TRequiredValidator()); 

        $cd_cor->setMaxLength(45);
        $nm_gravidade->setMaxLength(45);

        $cd_cor->setSize('100%');
        $id_gravidade->setSize(200);
        $nm_gravidade->setSize('100%');

        $row1 = $this->form->addFields([new TLabel(new TImage('fas:signal #0689C6')."Insira os dados da Gravidade da ocorrência", '#F7FAFD', '18px', 'B')],[]);
        $row1->layout = [' col-sm-12',' col-sm-12'];

        $row2 = $this->form->addFields([new TLabel("Gravidade", '#F7FAFD', '16px', null, '100%'),$nm_gravidade]);
        $row2->layout = [' col-sm-12'];

        $row3 = $this->form->addFields([new TLabel("Cor", '#F7FAFD', '16px', null, '100%'),$cd_cor]);
        $row3->layout = [' col-sm-12'];

        $row4 = $this->form->addFields([$id_gravidade]);
        $row4->layout = [' col-sm-12'];

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

            $object = new TbGravidade(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            // get the generated {PRIMARY_KEY}
            $data->id_gravidade = $object->id_gravidade; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('TbGravidadeHeaderList', 'onShow', $loadPageParam); 

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

                $object = new TbGravidade($key); // instantiates the Active Record 

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

