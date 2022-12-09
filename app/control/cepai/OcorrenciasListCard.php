<?php

class OcorrenciasListCard extends TPage
{
    private $form; // form
    private $cardView; // listing
    private $pageNavigation;
    private $loaded;
    private $filter_criteria;
    private static $database = 'cepai';
    private static $activeRecord = 'TbOcorrencia';
    private static $primaryKey = 'id_ocorrencia';
    private static $formName = 'form_OcorrenciasListCard';
    private $showMethods = ['onReload', 'onSearch'];

    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);

        // define the form title
        $this->form->setFormTitle("Ocorrências");

        $tb_tipo_ocorrencia_id = new TDBCombo('tb_tipo_ocorrencia_id', 'cepai', 'TbTipoOcorrencia', 'id_tipo_ocorrencia', '{nm_tipo_ocorrencia}','id_tipo_ocorrencia asc'  );
        $tb_gravidade_id = new TDBCombo('tb_gravidade_id', 'cepai', 'TbGravidade', 'id_gravidade', '{nm_gravidade}','id_gravidade asc'  );

        $tb_gravidade_id->setSize('100%');
        $tb_tipo_ocorrencia_id->setSize('100%');

        $tb_gravidade_id->enableSearch();
        $tb_tipo_ocorrencia_id->enableSearch();

        $row1 = $this->form->addFields([new TLabel("Buscar por Tipo de Ocorrência", '#F7FAFD', '14px', null, '100%'),$tb_tipo_ocorrencia_id],[new TLabel("Buscar por Gravidade", '#F7FAFD', '14px', null, '100%'),$tb_gravidade_id]);
        $row1->layout = [' col-sm-6',' col-sm-6'];

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $btn_onshow = $this->form->addAction("Cadastrar Ocorrência", new TAction(['TbOcorrenciaForm', 'onShow']), 'fas:plus #FFFFFF');
        $this->btn_onshow = $btn_onshow;
        $btn_onshow->addStyleClass('btn-success'); 

        $btn_onsearch = $this->form->addHeaderAction("Buscar", new TAction([$this, 'onSearch']), 'fas:search #F7FAFD');
        $this->btn_onsearch = $btn_onsearch;

        $this->cardView = new TCardView;

        $this->cardView->setContentHeight(170);
        $this->cardView->setTitleTemplate('{tb_tipo_ocorrencia->nm_tipo_ocorrencia}');
        $this->cardView->setColorAttribute('tb_gravidade->cd_cor');
        $this->cardView->setItemTemplate("<div style=\"padding: 1rem;\">
    <p style=\"color: #F7FAFD;\">
    <span style=\"color: #F7FAFD; background-color: #0689C655; padding: 0.3rem; border-radius: 0.8rem; font-size: 0.8rem;\">Criado por</span>
     <br>{system_users->name}</p>
    <p style=\"color: #F7FAFD;\"><span style=\"color: #F7FAFD; background-color: #0689C655; padding: 0.3rem; border-radius: 0.8rem; font-size: 0.8rem;\">Data da Ocorrência</span> <br> {dt_ocorrencia}</p>
    <p style=\"color: #F7FAFD;\"><span style=\"color: #F7FAFD; background-color: #0689C655; padding: 0.3rem; border-radius: 0.8rem; font-size: 0.8rem;\">Quantidade de Vítimas</span> <br> {qt_vitimas}</p>

<hr style=\"border-color: #10517B\">
    <p style=\"font-style:italic; text-align: center;font-size:0.9rem\">Clique abaixo para ver detalhes</p>
</div>");

        $this->cardView->setItemDatabase(self::$database);

        $this->filter_criteria = new TCriteria;

        $action_DetalhesFormView_onShow = new TAction(['DetalhesFormView', 'onShow'], ['key'=> '{id_ocorrencia}']);

        $this->cardView->addAction($action_DetalhesFormView_onShow, "Ver Detalhes", 'fas:external-link-alt #0689C6'); 

        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->enableCounters();
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));

        $panel = new TPanelGroup;
        $panel->add($this->cardView);

        $panel->addFooter($this->pageNavigation);

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add(TBreadCrumb::create(["CEPAI","Ver Ocorrências"]));
        $container->add($this->form);
        $container->add($panel);

        parent::add($container);

    }

    /**
     * Register the filter in the session
     */
    public function onSearch()
    {
        // get the search form data
        $data = $this->form->getData();
        $filters = [];

        TSession::setValue(__CLASS__.'_filter_data', NULL);
        TSession::setValue(__CLASS__.'_filters', NULL);

        if (isset($data->tb_tipo_ocorrencia_id) AND ( (is_scalar($data->tb_tipo_ocorrencia_id) AND $data->tb_tipo_ocorrencia_id !== '') OR (is_array($data->tb_tipo_ocorrencia_id) AND (!empty($data->tb_tipo_ocorrencia_id)) )) )
        {

            $filters[] = new TFilter('tb_tipo_ocorrencia_id', '=', $data->tb_tipo_ocorrencia_id);// create the filter 
        }

        if (isset($data->tb_gravidade_id) AND ( (is_scalar($data->tb_gravidade_id) AND $data->tb_gravidade_id !== '') OR (is_array($data->tb_gravidade_id) AND (!empty($data->tb_gravidade_id)) )) )
        {

            $filters[] = new TFilter('tb_gravidade_id', '=', $data->tb_gravidade_id);// create the filter 
        }

        $param = array();
        $param['offset']     = 0;
        $param['first_page'] = 1;

        // fill the form with data again
        $this->form->setData($data);

        // keep the search data in the session
        TSession::setValue(__CLASS__.'_filter_data', $data);
        TSession::setValue(__CLASS__.'_filters', $filters);

        $this->onReload($param);
    }

    public function onReload($param = NULL)
    {
        try
        {

            // open a transaction with database 'cepai'
            TTransaction::open(self::$database);

            // creates a repository for TbOcorrencia
            $repository = new TRepository(self::$activeRecord);
            $limit = 15;

            $criteria = clone $this->filter_criteria;

            if (empty($param['order']))
            {
                $param['order'] = 'dt_created_at';    
            }

            if (empty($param['direction']))
            {
                $param['direction'] = 'desc';
            }

            $criteria->setProperties($param); // order, offset
            $criteria->setProperty('limit', $limit);

            if($filters = TSession::getValue(__CLASS__.'_filters'))
            {
                foreach ($filters as $filter) 
                {
                    $criteria->add($filter);       
                }
            }

            // load the objects according to criteria
            $objects = $repository->load($criteria, FALSE);

            $this->cardView->clear();
            if ($objects)
            {
                // iterate the collection of active records
                foreach ($objects as $object)
                {

                    $object->dt_ocorrencia = call_user_func(function($value, $object, $row) 
                    {
                        if(!empty(trim($value)))
                        {
                            try
                            {
                                $date = new DateTime($value);
                                return $date->format('d/m/Y');
                            }
                            catch (Exception $e)
                            {
                                return $value;
                            }
                        }
                    }, $object->dt_ocorrencia, $object, null);

                    $this->cardView->addItem($object);

                }
            }

            // reset the criteria for record count
            $criteria->resetProperties();
            $count= $repository->count($criteria);

            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($limit); // limit

            // close the transaction
            TTransaction::close();
            $this->loaded = true;
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }

    public function onShow($param = null)
    {

    }

    /**
     * method show()
     * Shows the page
     */
    public function show()
    {
        if (!$this->loaded AND (!isset($_GET['method']) OR !(in_array($_GET['method'],  $this->showMethods))) )
        {
            if (func_num_args() > 0)
            {
                $this->onReload( func_get_arg(0) );
            }
            else
            {
                $this->onReload();
            }
        }
        parent::show();
    }

}

