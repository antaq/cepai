<?php

class TbOcorrenciaFormView extends TPage
{
    protected $form; // form
    private static $database = 'cepai';
    private static $activeRecord = 'TbOcorrencia';
    private static $primaryKey = 'id_ocorrencia';
    private static $formName = 'formView_TbOcorrencia';

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

        $tb_ocorrencia = new TbOcorrencia($param['key']);
        // define the form title
        $this->form->setFormTitle("Mídias da Ocorrência");

        $action1 = new TActionLink("Voltar", new TAction(['DetalhesFormView', 'onShow'], ['key'=> $tb_ocorrencia->id_ocorrencia]), '#F7FAFD', '12px', '', 'fas:arrow-circle-left #F7FAFD');
        $image4 = new TImage($tb_ocorrencia->im_midia1);

        $image4->width = '100%';
        $image4->height = '500px';
        $action1->class = 'btn btn-default';
        $image4->class = !empty($image4->class) ? $image4->class.' imgocorrencia ' : ' imgocorrencia ';

        $row1 = $this->form->addFields([],[$action1]);
        $row1->layout = [' col-sm-10',' col-sm-2'];

        $row2 = $this->form->addFields([$image4]);
        $row2->layout = [' col-sm-12'];

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["CEPAI","TbOcorrenciaFormView"]));
        }
        $container->add($this->form);

        TTransaction::close();
        parent::add($container);

    }

    public function onShow($param = null)
    {     

    }

}

