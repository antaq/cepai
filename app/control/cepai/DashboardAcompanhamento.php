<?php

class DashboardAcompanhamento extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = '';
    private static $activeRecord = '';
    private static $primaryKey = '';
    private static $formName = 'form_DashboardAcompanhamento';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param = null)
    {
        parent::__construct();

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Dashboard");


        $total_ocorrencias = new BBarChart('total_ocorrencias');
        $total_ocorrencia_gravidade = new BBarChart('total_ocorrencia_gravidade');
        $total_area_porto = new BBarChart('total_area_porto');

        $total_ocorrencias->setDatabase('cepai');
        $total_ocorrencias->setFieldValue("tb_ocorrencia.id_ocorrencia");
        $total_ocorrencias->setFieldGroup(["tb_tipo_ocorrencia.nm_tipo_ocorrencia"]);
        $total_ocorrencias->setModel('TbOcorrencia');
        $total_ocorrencias->setTitle("Ocorrências por Tipo");
        $total_ocorrencias->setLayout('vertical');
        $total_ocorrencias->setJoins([
             'tb_tipo_ocorrencia' => ['tb_ocorrencia.tb_tipo_ocorrencia_id', 'tb_tipo_ocorrencia.id_tipo_ocorrencia']
        ]);
        $total_ocorrencias->setTotal('count');
        $total_ocorrencias->showLegend(true);
        $total_ocorrencias->enableOrderByValue('asc');
        $total_ocorrencias->setSize('100%', 280);
        $total_ocorrencias->disableZoom();

        $total_ocorrencia_gravidade->setDatabase('cepai');
        $total_ocorrencia_gravidade->setFieldValue("tb_ocorrencia.id_ocorrencia");
        $total_ocorrencia_gravidade->setFieldGroup(["tb_gravidade.nm_gravidade"]);
        $total_ocorrencia_gravidade->setModel('TbOcorrencia');
        $total_ocorrencia_gravidade->setTitle("Ocorrência por Gravidade");
        $total_ocorrencia_gravidade->setLayout('vertical');
        $total_ocorrencia_gravidade->setJoins([
             'tb_gravidade' => ['tb_ocorrencia.tb_gravidade_id', 'tb_gravidade.id_gravidade']
        ]);
        $total_ocorrencia_gravidade->setTotal('count');
        $total_ocorrencia_gravidade->showLegend(true);
        $total_ocorrencia_gravidade->enableOrderByValue('asc');
        $total_ocorrencia_gravidade->setSize('100%', 280);
        $total_ocorrencia_gravidade->disableZoom();

        $total_area_porto->setDatabase('cepai');
        $total_area_porto->setFieldValue("tb_ocorrencia.id_ocorrencia");
        $total_area_porto->setFieldGroup(["tb_area_porto.nm_area_porto"]);
        $total_area_porto->setModel('TbOcorrencia');
        $total_area_porto->setTitle("Ocorrência por Área do Porto");
        $total_area_porto->setLayout('vertical');
        $total_area_porto->setJoins([
             'system_users' => ['tb_ocorrencia.system_users_id', 'system_users.id'],
             'tb_area_porto' => ['system_users.tb_area_porto_id', 'tb_area_porto.id_area_porto']
        ]);
        $total_area_porto->setTotal('count');
        $total_area_porto->showLegend(true);
        $total_area_porto->enableOrderByValue('asc');
        $total_area_porto->setSize('100%', 280);
        $total_area_porto->disableZoom();

        $tab_63519d5849da1 = new BootstrapFormBuilder('tab_63519d5849da1');
        $this->tab_63519d5849da1 = $tab_63519d5849da1;
        $tab_63519d5849da1->setProperty('style', 'border:none; box-shadow:none;');

        $tab_63519d5849da1->appendPage("Tipo de Ocorrência");

        $tab_63519d5849da1->addFields([new THidden('current_tab_tab_63519d5849da1')]);
        $tab_63519d5849da1->setTabFunction("$('[name=current_tab_tab_63519d5849da1]').val($(this).attr('data-current_page'));");

        $row1 = $tab_63519d5849da1->addFields([$total_ocorrencias]);
        $row1->layout = [' col-sm-12'];

        $tab_63519d5849da1->appendPage("Gravidade");
        $row2 = $tab_63519d5849da1->addFields([$total_ocorrencia_gravidade]);
        $row2->layout = [' col-sm-12'];

        $tab_63519d5849da1->appendPage("Área do Porto");
        $row3 = $tab_63519d5849da1->addFields([$total_area_porto]);
        $row3->layout = [' col-sm-12'];

        $row4 = $this->form->addFields([$tab_63519d5849da1]);
        $row4->layout = [' col-sm-12'];

        $searchData = $this->form->getData();
        $this->form->setData($searchData);

        BChart::generate($total_ocorrencias, $total_ocorrencia_gravidade, $total_area_porto);

        // create the form actions

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["CEPAI","Dashboard"]));
        }
        $container->add($this->form);

        parent::add($container);

    }

    public function onShow($param = null)
    {               

    } 

}

