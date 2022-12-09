<?php

class TbTipoOcorrenciaForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'cepai';
    private static $activeRecord = 'TbTipoOcorrencia';
    private static $primaryKey = 'id_tipo_ocorrencia';
    private static $formName = 'form_TbTipoOcorrenciaForm';

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
        $this->form->setFormTitle("Cadastro de Tipo de Ocorrência");


        $nm_tipo_ocorrencia = new TEntry('nm_tipo_ocorrencia');
        $nm_localizacao = new TEntry('nm_localizacao');
        $ds_complemento = new TText('ds_complemento');
        $id_tipo_ocorrencia = new THidden('id_tipo_ocorrencia');

        $nm_tipo_ocorrencia->addValidation("Nm tipo ocorrencia", new TRequiredValidator()); 

        $nm_localizacao->setMaxLength(255);
        $nm_tipo_ocorrencia->setMaxLength(60);

        $nm_localizacao->setSize('100%');
        $id_tipo_ocorrencia->setSize(200);
        $nm_tipo_ocorrencia->setSize('100%');
        $ds_complemento->setSize('100%', 70);

        $row1 = $this->form->addFields([new TLabel(new TImage('fas:exclamation-triangle #0689C6')."Insira os dados do Tipo de ocorrência", '#F7FAFD', '18px', 'B', '100%')],[]);
        $row1->layout = [' col-sm-12',' col-sm-12'];

        $row2 = $this->form->addFields([new TLabel("Tipo de Ocorrência", '#F7FAFD', '16px', null, '100%'),$nm_tipo_ocorrencia]);
        $row2->layout = [' col-sm-12'];

        $row3 = $this->form->addFields([new TLabel("Localização", '#F7FAFD', '16px', null, '100%'),$nm_localizacao]);
        $row3->layout = [' col-sm-12'];

        $row4 = $this->form->addFields([new TLabel("Complemento", '#F7FAFD', '16px', null, '100%'),$ds_complemento]);
        $row4->layout = [' col-sm-12'];

        $row5 = $this->form->addFields([$id_tipo_ocorrencia]);
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

            $object = new TbTipoOcorrencia(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            // get the generated {PRIMARY_KEY}
            $data->id_tipo_ocorrencia = $object->id_tipo_ocorrencia; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('TbTipoOcorrenciaHeaderList', 'onShow', $loadPageParam); 

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

                $object = new TbTipoOcorrencia($key); // instantiates the Active Record 

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

