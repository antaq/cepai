<?php

class ComplementosFormView extends TPage
{
    protected $form; // form
    private static $database = 'cepai';
    private static $activeRecord = 'TbComplemento';
    private static $primaryKey = 'id_complemento';
    private static $formName = 'formView_TbComplemento';

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

        TTransaction::open(self::$database);
        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        $this->form->setTagName('div');

        $tb_complemento = new TbComplemento($param['key']);
        // define the form title
        $this->form->setFormTitle("Ver Complementos");

        $label2 = new TLabel("Complemento", '', '12px', '');
        $text2 = new TTextDisplay($tb_complemento->ds_complemento, '', '12px', '');
        $label44 = new TLabel("Data de Criação", '', '12px', '');
        $text3 = new TTextDisplay(TDateTime::convertToMask($tb_complemento->dt_created_at, 'yyyy-mm-dd hh:ii', 'dd/mm/yyyy hh:ii'), '', '12px', '');
        $label4 = new TLabel("Criado por", '', '12px', '');
        $text4 = new TTextDisplay($tb_complemento->system_users->name, '', '12px', '');


        $row1 = $this->form->addFields([$label2],[$text2]);
        $row1->layout = ['col-sm-3',' col-sm-9'];

        $row2 = $this->form->addFields([$label44],[$text3]);
        $row2->layout = ['col-sm-3',' col-sm-9'];

        $row3 = $this->form->addFields([$label4],[$text4]);

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["CEPAI","Ver Complementos"]));
        }
        $container->add($this->form);

        TTransaction::close();
        parent::add($container);

    }

    public function onShow($param = null)
    {     

    }

}

