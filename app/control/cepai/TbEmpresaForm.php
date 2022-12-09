<?php

class TbEmpresaForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'cepai';
    private static $activeRecord = 'TbEmpresa';
    private static $primaryKey = 'id_empresa';
    private static $formName = 'form_TbEmpresaForm';

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
        $this->form->setFormTitle("Cadastro de Empresa");


        $nm_empresa = new TEntry('nm_empresa');
        $cd_cnpj = new TEntry('cd_cnpj');
        $id_empresa = new THidden('id_empresa');
        $ds_endereco = new TEntry('ds_endereco');
        $cd_cep = new TEntry('cd_cep');
        $cd_numero = new TEntry('cd_numero');
        $ds_complemento = new TText('ds_complemento');
        $nm_bairro = new TEntry('nm_bairro');
        $tb_cidade_id = new TDBCombo('tb_cidade_id', 'cepai', 'TbCidade', 'id_cidade', '{nm_cidade}','id_cidade asc'  );

        $nm_empresa->addValidation("Nm empresa", new TRequiredValidator()); 
        $cd_cnpj->addValidation("Cd cnpj", new TRequiredValidator()); 

        $tb_cidade_id->enableSearch();

        $cd_cnpj->setMaxLength(20);
        $nm_empresa->setMaxLength(100);

        $cd_cep->setSize('100%');
        $cd_cnpj->setSize('100%');
        $id_empresa->setSize(200);
        $cd_numero->setSize('100%');
        $nm_bairro->setSize('100%');
        $nm_empresa->setSize('100%');
        $ds_endereco->setSize('100%');
        $tb_cidade_id->setSize('100%');
        $ds_complemento->setSize('100%', 70);

        $row1 = $this->form->addFields([new TLabel(new TImage('fas:building #0689C6')."Insira os dados da Empresa", '#F7FAFD', '18px', 'B', '100%')],[]);
        $row1->layout = [' col-sm-12',' col-sm-12'];

        $row2 = $this->form->addFields([new TLabel("Empresa", '#F7FAFD', '14px', null, '100%'),$nm_empresa]);
        $row2->layout = [' col-sm-12'];

        $row3 = $this->form->addFields([new TLabel("CNPJ", '#F7FAFD', '14px', null, '100%'),$cd_cnpj,$id_empresa]);
        $row3->layout = [' col-sm-12'];

        $row4 = $this->form->addFields([new TLabel("Endereço", '#F7FAFD', '14px', null, '100%'),$ds_endereco]);
        $row4->layout = [' col-sm-12'];

        $row5 = $this->form->addFields([new TLabel("CEP", '#F7FAFD', '14px', null, '100%'),$cd_cep],[new TLabel("Número", '#F7FAFD', '14px', null, '100%'),$cd_numero]);
        $row5->layout = [' col-sm-6',' col-sm-6'];

        $row6 = $this->form->addFields([new TLabel("Complemento", '#F7FAFD', '14px', null, '100%'),$ds_complemento]);
        $row6->layout = [' col-sm-12',' col-sm-6'];

        $row7 = $this->form->addFields([new TLabel("Bairro", '#F7FAFD', '14px', null, '100%'),$nm_bairro],[new TLabel("Cidade", '#F7FAFD', '14px', null, '100%'),$tb_cidade_id]);
        $row7->layout = [' col-sm-6',' col-sm-6'];

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

            $object = new TbEmpresa(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            // get the generated {PRIMARY_KEY}
            $data->id_empresa = $object->id_empresa; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('TbEmpresaHeaderList', 'onShow', $loadPageParam); 

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

                $object = new TbEmpresa($key); // instantiates the Active Record 

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

