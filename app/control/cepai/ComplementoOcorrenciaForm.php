<?php

class ComplementoOcorrenciaForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'cepai';
    private static $activeRecord = 'TbComplemento';
    private static $primaryKey = 'id_complemento';
    private static $formName = 'form_ComplementoOcorrenciaForm';

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
        $this->form->setFormTitle("Cadastrar Complemento");


        $id_complemento = new THidden('id_complemento');
        $ds_complemento = new TText('ds_complemento');
        $system_users_id = new THidden('system_users_id');
        $tb_ocorrencia_id = new THidden('tb_ocorrencia_id');

        $ds_complemento->addValidation("complemento", new TRequiredValidator()); 

        $system_users_id->setValue(TSession::getValue("userid"));
        $tb_ocorrencia_id->setValue($param["id_ocorrencia"] ?? "");

        $id_complemento->setSize(200);
        $system_users_id->setSize(200);
        $tb_ocorrencia_id->setSize(200);
        $ds_complemento->setSize('100%', 110);

        $row1 = $this->form->addFields([new TLabel(new TImage('fas:address-card #057AAF')."Insira os dados do Complemento da Ocorrência", '#F7FAFD', '18px', 'B', '100%'),$id_complemento]);
        $row1->layout = ['col-sm-12'];

        $row2 = $this->form->addFields([new TLabel("Escreva o complemento", '#F7FAFD', '15px', null, '100%'),$ds_complemento]);
        $row2->layout = ['col-sm-12'];

        $row3 = $this->form->addFields([$system_users_id,$tb_ocorrencia_id]);
        $row3->layout = ['col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Concluir", new TAction([$this, 'onSave']), 'fas:check-circle #F7FAFD');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-info'); 

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

            $object = new TbComplemento(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $loadPageParam = [];
            $loadPageParam["key"] = $object->tb_ocorrencia_id;
            

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }
    

            // get the generated {PRIMARY_KEY}
            $data->id_complemento = $object->id_complemento; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            //TApplication::loadPage('DetalhesFormView', 'onShow', $loadPageParam); 
            TApplication::loadPage('DetalhesFormView', 'onShow', $loadPageParam); 

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

                $object = new TbComplemento($key); // instantiates the Active Record 

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

