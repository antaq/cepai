<?php

class TbOcorrenciaForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'cepai';
    private static $activeRecord = 'TbOcorrencia';
    private static $primaryKey = 'id_ocorrencia';
    private static $formName = 'form_TbOcorrenciaForm';

    use Adianti\Base\AdiantiFileSaveTrait;

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
        $this->form->setFormTitle("Cadastro de Ocorrência");


        $ic_mudar_empresa = new TRadioGroup('ic_mudar_empresa');
        $tb_empresa_id = new TDBCombo('tb_empresa_id', 'cepai', 'TbEmpresa', 'id_empresa', '{nm_empresa}','id_empresa asc'  );
        $dt_ocorrencia = new TDateTime('dt_ocorrencia');
        $tb_tipo_ocorrencia_id = new TDBCombo('tb_tipo_ocorrencia_id', 'cepai', 'TbTipoOcorrencia', 'id_tipo_ocorrencia', '{nm_tipo_ocorrencia}','id_tipo_ocorrencia asc'  );
        $nm_outro_motivo = new TEntry('nm_outro_motivo');
        $ds_endereco = new TEntry('ds_endereco');
        $tb_gravidade_id = new TDBCombo('tb_gravidade_id', 'cepai', 'TbGravidade', 'id_gravidade', '{nm_gravidade}','id_gravidade asc'  );
        $id_ocorrencia = new THidden('id_ocorrencia');
        $system_users_id = new THidden('system_users_id');
        $qt_vitimas = new TNumeric('qt_vitimas', '0', ',', '.', true, true );
        $ds_resumo = new TText('ds_resumo');
        $im_midia1 = new TFile('im_midia1');
        $im_midia2 = new TFile('im_midia2');
        $im_midia3 = new TFile('im_midia3');

        $ic_mudar_empresa->setChangeAction(new TAction([$this,'OnChangeMudarEmpresa']));
        $tb_tipo_ocorrencia_id->setChangeAction(new TAction([$this,'onChangeTipoOcorrencia']));

        $ic_mudar_empresa->addValidation("Mudar Empresa", new TRequiredValidator()); 
        $dt_ocorrencia->addValidation("Dt ocorrencia", new TRequiredValidator()); 
        $tb_tipo_ocorrencia_id->addValidation("Tb tipo ocorrencia id", new TRequiredValidator()); 
        $tb_gravidade_id->addValidation("Tb gravidade id", new TRequiredValidator()); 
        $qt_vitimas->addValidation("Qt vitimas", new TRequiredValidator()); 
        $ds_resumo->addValidation("Ds resumo", new TRequiredValidator()); 

        $ic_mudar_empresa->addItems(["1"=>"Sim","2"=>"Não"]);
        $ic_mudar_empresa->setLayout('horizontal');
        $ic_mudar_empresa->setBooleanMode();
        $dt_ocorrencia->setMask('dd/mm/yyyy hh:ii');
        $dt_ocorrencia->setDatabaseMask('yyyy-mm-dd hh:ii');
        $system_users_id->setValue(TSession::getValue("userid"));
        $qt_vitimas->setAllowNegative(false);

        $qt_vitimas->setMaxLength(999999);
        $nm_outro_motivo->setMaxLength(255);

        $tb_empresa_id->enableSearch();
        $tb_gravidade_id->enableSearch();
        $tb_tipo_ocorrencia_id->enableSearch();

        $im_midia1->enableFileHandling();
        $im_midia2->enableFileHandling();
        $im_midia3->enableFileHandling();

        $im_midia2->setSize('100%');
        $im_midia1->setSize('100%');
        $im_midia3->setSize('100%');
        $id_ocorrencia->setSize(200);
        $qt_vitimas->setSize('100%');
        $ds_endereco->setSize('100%');
        $ic_mudar_empresa->setSize(80);
        $system_users_id->setSize(200);
        $tb_empresa_id->setSize('100%');
        $dt_ocorrencia->setSize('100%');
        $ds_resumo->setSize('100%', 70);
        $nm_outro_motivo->setSize('100%');
        $tb_gravidade_id->setSize('100%');
        $tb_tipo_ocorrencia_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel(new TImage('fas:building #057AAF')."Mudar empresa", '#F7FAFD', '18px', 'B', '100%'),$ic_mudar_empresa],[],[new TLabel("Empresa", '#F7FAFD', '16px', null, '100%'),$tb_empresa_id]);
        $row1->layout = ['col-sm-12','col-sm-2',' col-sm-12'];

        $row2 = $this->form->addFields([new TFormSeparator("Separador", '#33333300', '18', '#eee')]);
        $row2->layout = [' col-sm-12'];

        $row3 = $this->form->addFields([new TLabel(new TImage('fas:book #0689C6')."Insira os dados da Ocorrência", '#F7FAFD', '18px', 'B')],[new TLabel("Data da ocorrência", '#F7FAFD', '16px', null, '100%'),$dt_ocorrencia],[],[new TLabel("Tipo de ocorrência", '#F7FAFD', '16px', null, '100%'),$tb_tipo_ocorrencia_id],[],[new TLabel("Outro motivo", '#F7FAFD', '16px', null, '100%'),$nm_outro_motivo],[],[new TLabel("Endereço", '#F7FAFD', '16px', null, '100%'),$ds_endereco],[],[new TLabel("Gravidade", '#F7FAFD', '16px', null, '100%'),$tb_gravidade_id],[]);
        $row3->layout = ['col-sm-12','col-sm-12','col-sm-2','col-sm-12','col-sm-2',' col-sm-12','col-sm-2',' col-sm-12','col-sm-2','col-sm-12','col-sm-2'];

        $row4 = $this->form->addFields([$id_ocorrencia,$system_users_id]);
        $row4->layout = ['col-sm-12'];

        $row5 = $this->form->addFields([new TLabel("Quantidade de vitimas", '#F7FAFD', '16px', null, '100%'),$qt_vitimas],[],[new TLabel("Resumo da ocorrência", '#F7FAFD', '16px', null, '100%'),$ds_resumo],[],[new TLabel("Imagem 1", '#F7FAFD', '16px', null, '100%'),$im_midia1],[],[new TLabel("Imagem 2", '#F7FAFD', '16px', null, '100%'),$im_midia2],[],[new TLabel("Imagem 3", '#F7FAFD', '16px', null, '100%'),$im_midia3]);
        $row5->layout = [' col-sm-12','col-sm-2','col-sm-12','col-sm-2',' col-sm-12','col-sm-2',' col-sm-12','col-sm-2',' col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Concluir", new TAction([$this, 'onSave']), 'fas:check-circle #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-success'); 

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["CEPAI","Cadastro de Ocorrência"]));
        }
        $container->add($this->form);

        parent::add($container);

    }

    public static function OnChangeMudarEmpresa($param = null) 
    {
        try 
        {
            //code here
            if($param['key'] == 1)
            {
                TScript::create("$(\"[name='tb_empresa_id']\").closest('.fb-field-container').show()");
                TScript::create("$(\"[name='ds_endereco']\").closest('.fb-field-container').show()");
            }
            else{
                TScript::create("$(\"[name='tb_empresa_id']\").closest('.fb-field-container').hide()");
                TScript::create("$(\"[name='ds_endereco']\").closest('.fb-field-container').hide()");
            }

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public static function onChangeTipoOcorrencia($param = null) 
    {
        try 
        {
            //code here
            if($param['key'] != '7')
            {
                TScript::create("$(\"[name='nm_outro_motivo']\").closest('.fb-field-container').hide()");
            }
            else{
                TScript::create("$(\"[name='nm_outro_motivo']\").closest('.fb-field-container').show()");
            }

            if($param['key'] != '5')
            {
                TScript::create("$(\"[name='ds_endereco']\").closest('.fb-field-container').hide()");
            }
            else{
                TScript::create("$(\"[name='ds_endereco']\").closest('.fb-field-container').show()");
            }

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new TbOcorrencia(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $im_midia1_dir = 'uploads/';
            $im_midia2_dir = 'uploads/';
            $im_midia3_dir = 'uploads/';  

            $object->store(); // save the object 

            $this->saveFile($object, $data, 'im_midia1', $im_midia1_dir);
            $this->saveFile($object, $data, 'im_midia2', $im_midia2_dir);
            $this->saveFile($object, $data, 'im_midia3', $im_midia3_dir);
            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            // get the generated {PRIMARY_KEY}
            $data->id_ocorrencia = $object->id_ocorrencia; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            //Abrir transacao
            TTransaction::open(self::$database);

            //Settar as classes 
            OcorrenciaService::notificar($object); 
            //Fechar a transacao
            TTransaction::close();

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('OcorrenciasListCard', 'onShow', $loadPageParam); 

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

                $object = new TbOcorrencia($key); // instantiates the Active Record 

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

        TScript::create("$(\"[name='nm_outro_motivo']\").closest('.fb-field-container').hide()");
        TScript::create("$(\"[name='ds_endereco']\").closest('.fb-field-container').hide()");
        TScript::create("$(\"[name='tb_empresa_id']\").closest('.fb-field-container').hide()");
    } 

}

