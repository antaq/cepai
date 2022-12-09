<?php

class DetalhesFormView extends TPage
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
        $this->form->setFormTitle("Detalhes");

        $tbutton2 = new TButton('tbutton2');
        $label15 = new TLabel("Tipo de Ocorrência", '#057AAF', '15px', '');
        $text15 = new TTextDisplay($tb_ocorrencia->tb_tipo_ocorrencia->nm_tipo_ocorrencia, '#F7FAFD', '16px', '');
        $text7 = new TTextDisplay(new TImage('fas:angle-right #F7FAFD').$tb_ocorrencia->nm_outro_motivo, '#F7FAFD', '16px', '');
        $label4 = new TLabel("Criado por", '#057AAF', '16px', '');
        $text17 = new TTextDisplay($tb_ocorrencia->system_users->name, '#F7FAFD', '16px', '');
        $label221 = new TLabel("Telefone", '', '14px', '');
        $text181 = new TTextDisplay($tb_ocorrencia->system_users->cd_telefone, '#F7FAFD', '16px', '');
        $label2 = new TLabel("Empresa", '#057AAF', '12px', '');
        $text14 = new TTextDisplay($tb_ocorrencia->tb_empresa->nm_empresa, '#F7FAFD', '16px', '');
        $text42 = new TTextDisplay($tb_ocorrencia->system_users->tb_empresa->nm_empresa, '#F7FAFD', '16px', '');
        $label41 = new TLabel("Endereço", '#057AAF', '12px', '');
        $text13 = new TTextDisplay($tb_ocorrencia->ds_endereco, '#F7FAFD', '16px', '');
        $text11 = new TTextDisplay(new TImage('fas:angle-right #057AAF').$tb_ocorrencia->system_users->tb_empresa->ds_endereco, '#F7FAFD', '14px', '');
        $text151 = new TTextDisplay($tb_ocorrencia->system_users->tb_empresa->cd_numero, '#F7FAFD', '14px', '');
        $text131 = new TTextDisplay($tb_ocorrencia->system_users->tb_empresa->nm_bairro, '#F7FAFD', '14px', '');
        $text171 = new TTextDisplay($tb_ocorrencia->system_users->tb_empresa->tb_cidade->nm_cidade, '#F7FAFD', '14px', '');
        $label6 = new TLabel("Gravidade", '#057AAF', '12px', '');
        $text16 = new TTextDisplay($tb_ocorrencia->tb_gravidade->nm_gravidade, '#F7FAFD', '16px', '');
        $label8 = new TLabel("Data da Ocorrência", '#057AAF', '12px', '');
        $datetext2 = new TTextDisplay(TDate::convertToMask($tb_ocorrencia->dt_ocorrencia, 'yyyy-mm-dd', 'dd/mm/yyyy'), '#F7FAFD', '16px', '');
        $label12 = new TLabel("Publicado em", '#057AAF', '12px', '');
        $datetext3 = new TTextDisplay(TDate::convertToMask($tb_ocorrencia->dt_created_at, 'yyyy-mm-dd', 'dd/mm/yyyy'), '#F7FAFD', '16px', '');
        $label14 = new TLabel("Resumo", '#057AAF', '12px', '');
        $text8 = new TTextDisplay($tb_ocorrencia->ds_resumo, '#F7FAFD', '16px', '');
        $label16 = new TLabel("Vítimas", '#057AAF', '12px', '');
        $text9 = new TTextDisplay($tb_ocorrencia->qt_vitimas, '#F7FAFD', '16px', '');
        $label74 = new TLabel("Imagens", '#057AAF', '16px', '');
        $image4 = new TImage($tb_ocorrencia->im_midia1);
        $action441 = new TActionLink("Abrir Imagem", new TAction(['TbOcorrenciaFormView', 'onShow'], ['key'=> $tb_ocorrencia->id_ocorrencia]), '', '12px', '', 'fas:expand #000000');
        $image2 = new TImage($tb_ocorrencia->im_midia2);
        $action442 = new TActionLink("Abrir Imagem", new TAction(['VerMidia2', 'onShow'], ['key'=> $tb_ocorrencia->id_ocorrencia]), '', '12px', '', 'fas:expand #000000');
        $image3 = new TImage($tb_ocorrencia->im_midia3);
        $action6 = new TActionLink("Abrir Imagem", new TAction(['VerMidia3', 'onShow'], ['key'=> $tb_ocorrencia->id_ocorrencia, 'id_ocorrencia'=>$tb_ocorrencia->id_ocorrencia]), '', '12px', '', 'fas:expand #000000');
        $tbutton58 = new TButton('tbutton58');
        $action1 = new TActionLink("Inserir Complemento", new TAction(['ComplementoOcorrenciaForm', 'onShow'], ['id_ocorrencia'=> $tb_ocorrencia->id_ocorrencia]), '#F7FAFD', '14px', '', 'fas:plus-circle #F7FAFD');
        $tbutton4 = new TButton('tbutton4');
        $bpagecontainer2 = new BPageContainer();

        $bpagecontainer2->setId('b63548de603184');
        $tbutton2->addStyleClass('btn-info');
        $tbutton4->addStyleClass('btn-info');
        $tbutton58->addStyleClass('btn-info');

        $tbutton2->setImage('fas:arrow-circle-left #F7FAFD');
        $tbutton4->setImage('fas:arrow-circle-left #F7FAFD');
        $tbutton58->setImage('fas:arrow-circle-left #F7FAFD');

        $tbutton2->setAction(new TAction(['OcorrenciasListCard', 'onShow']), "Voltar");
        $tbutton4->setAction(new TAction(['OcorrenciasListCard', 'onShow']), "Voltar");
        $tbutton58->setAction(new TAction(['OcorrenciasListCard', 'onShow']), "Voltar");
        $bpagecontainer2->setAction(new TAction(['TbComplementoKanbanView', 'onShow'], ['key' => $tb_ocorrencia->id_ocorrencia]));

        $text8->setSize('50%');
        $text7->setSize('50%');
        $text9->setSize('50%');
        $text15->setSize('50%');
        $text17->setSize('50%');
        $text14->setSize('50%');
        $text13->setSize('50%');
        $text16->setSize('50%');
        $bpagecontainer2->setSize('100%');

        $image4->width = '100%';
        $image2->width = '100%';
        $image3->width = '100%';
        $image4->height = '300px';
        $image3->height = '300px';
        $image2->height = '300px';
        $action6->class = 'btn btn-default';
        $action1->class = 'btn btn-default';
        $action441->class = 'btn btn-default';
        $action442->class = 'btn btn-default';
        $image2->class = !empty($image2->class) ? $image2->class.' imgocorrencia ' : ' imgocorrencia ';
        $image4->class = !empty($image4->class) ? $image4->class.' imgocorrencia ' : ' imgocorrencia ';
        $image3->class = !empty($image3->class) ? $image3->class.' imgocorrencia ' : ' imgocorrencia ';

        $loadingContainer = new TElement('div');
        $loadingContainer->style = 'text-align:center; padding:50px';

        $icon = new TElement('i');
        $icon->class = 'fas fa-spinner fa-spin fa-3x';

        $loadingContainer->add($icon);
        $loadingContainer->add('<br>Carregando');

        $bpagecontainer2->add($loadingContainer);

        $this->form->appendPage("Ocorrência");

        $this->form->addFields([new THidden('current_tab')]);
        $this->form->setTabFunction("$('[name=current_tab]').val($(this).attr('data-current_page'));");

        $row1 = $this->form->addFields([],[$tbutton2],[]);
        $row1->layout = [' col-sm-8',' col-sm-3',' col-sm-1'];

        $row2 = $this->form->addFields([$label15],[$text15,$text7]);
        $row2->layout = [' col-sm-3',' col-sm-9'];

        $row3 = $this->form->addFields([$label4],[$text17]);
        $row3->layout = [' col-sm-3',' col-sm-9'];

        $row4 = $this->form->addFields([$label221],[$text181]);
        $row4->layout = ['col-sm-3',' col-sm-9'];

        $row5 = $this->form->addFields([$label2],[$text14,$text42]);
        $row5->layout = ['col-sm-3',' col-sm-9'];

        $row6 = $this->form->addFields([$label41],[$text13,$text11,$text151,$text131,$text171]);
        $row6->layout = ['col-sm-3',' col-sm-9'];

        $row7 = $this->form->addFields([$label6],[$text16]);
        $row7->layout = ['col-sm-3',' col-sm-9'];

        $row8 = $this->form->addFields([$label8],[$datetext2]);
        $row8->layout = ['col-sm-3',' col-sm-9'];

        $row9 = $this->form->addFields([$label12],[$datetext3]);
        $row9->layout = ['col-sm-3',' col-sm-9'];

        $row10 = $this->form->addFields([$label14],[$text8]);
        $row10->layout = ['col-sm-3',' col-sm-9'];

        $row11 = $this->form->addFields([$label16],[$text9]);
        $row11->layout = ['col-sm-3',' col-sm-9'];

        $row12 = $this->form->addFields([$label74]);
        $row12->layout = ['col-sm-3'];

        $row13 = $this->form->addFields([$image4,$action441],[$image2,$action442],[$image3,$action6]);
        $row13->layout = [' col-sm-4',' col-sm-4',' col-sm-4'];

        $row14 = $this->form->addFields([],[$tbutton58]);
        $row14->layout = [' col-sm-8',' col-sm-4'];

        $this->form->appendPage("Complementos");
        $row15 = $this->form->addFields([$action1],[],[$tbutton4],[]);
        $row15->layout = [' col-sm-4',' col-sm-6',' col-sm-1',' col-sm-1'];

        $row16 = $this->form->addFields([$bpagecontainer2]);
        $row16->layout = [' col-sm-12'];

        if(!empty($param['current_tab']))
        {
            $this->form->setCurrentPage($param['current_tab']);
        }

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["CEPAI","Detalhes"]));
        }
        $container->add($this->form);

        TTransaction::close();
        parent::add($container);

    }

    public function onShow($param = null)
    {     

    }

}

