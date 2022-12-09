<?php

class UsersRegisterForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'cepai';
    private static $activeRecord = 'SystemUsers';
    private static $primaryKey = 'id';
    private static $formName = 'form_UsersRegisterForm';

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
        $this->form->setFormTitle("Solicitação de Acesso");


        $name = new TEntry('name');
        $login = new TEntry('login');
        $cd_telefone = new TEntry('cd_telefone');
        $password = new TPassword('password');
        $tb_cidade_id = new TDBCombo('tb_cidade_id', 'cepai', 'TbCidade', 'id_cidade', '{nm_cidade}','id_cidade asc'  );
        $tb_empresa_id = new TDBCombo('tb_empresa_id', 'cepai', 'TbEmpresa', 'id_empresa', '{nm_empresa}','id_empresa asc'  );
        $tb_area_porto_id = new TDBCombo('tb_area_porto_id', 'cepai', 'TbAreaPorto', 'id_area_porto', '{nm_area_porto}','id_area_porto asc'  );
        $id = new THidden('id');
        $frontpage_id = new THidden('frontpage_id');
        $active = new THidden('active');

        $name->addValidation("Name", new TRequiredValidator()); 
        $login->addValidation("Login", new TRequiredValidator()); 
        $password->addValidation("Senha", new TRequiredValidator()); 
        $tb_cidade_id->addValidation("Cidade", new TRequiredValidator()); 
        $tb_empresa_id->addValidation("Empresa", new TRequiredValidator()); 
        $tb_area_porto_id->addValidation("Área do Porto", new TRequiredValidator()); 
        $cd_telefone->addValidation("Telefone", new TNumericValidator(), []); 

        $active->setValue('N');
        $frontpage_id->setValue('50');

        $tb_cidade_id->enableSearch();
        $tb_empresa_id->enableSearch();
        $tb_area_porto_id->enableSearch();

        $id->setSize(200);
        $active->setSize(200);
        $name->setSize('100%');
        $login->setSize('100%');
        $password->setSize('100%');
        $frontpage_id->setSize(200);
        $cd_telefone->setSize('100%');
        $tb_cidade_id->setSize('100%');
        $tb_empresa_id->setSize('100%');
        $tb_area_porto_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Nome Completo", '#F7FAFD', '16px', null, '100%'),$name]);
        $row1->layout = ['col-sm-12'];

        $row2 = $this->form->addFields([new TLabel("E-mail", '#F7FAFD', '16px', null, '100%'),$login],[new TLabel("Telefone", '#F7FAFD', '16px', null, '100%'),$cd_telefone],[new TLabel("Senha", '#F7FAFD', '16px', null, '100%'),$password]);
        $row2->layout = ['col-sm-12',' col-sm-12','col-sm-12'];

        $row3 = $this->form->addFields([new TLabel("Cidade", '#F7FAFD', '16px', null),$tb_cidade_id],[new TLabel("Empresa", '#F7FAFD', '16px', null),$tb_empresa_id],[new TLabel("Área do Porto:", '#F7FAFD', '16px', null),$tb_area_porto_id]);
        $row3->layout = [' col-sm-12',' col-sm-12',' col-sm-12'];

        $row4 = $this->form->addFields([$id,$frontpage_id,$active]);
        $row4->layout = ['col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Concluir Cadastro", new TAction([$this, 'onSave']), 'fas:check-circle #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-success'); 

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        }
        $container->add($this->form);

        parent::add($container);

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new SystemUsers(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data
            $object->password = md5($object->password);
            
            $object->store(); // save the object 

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            $pos_action = new TAction(['LoginForm', 'onLoad']);
            new TMessage('info', "Registro salvo", $pos_action);

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

                $object = new SystemUsers($key); // instantiates the Active Record 

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

