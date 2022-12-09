<?php

class TbComplementoKanbanView extends TPage
{
    private static $database = 'cepai';
    private static $activeRecord = 'TbComplemento';
    private static $primaryKey = 'id_complemento';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        try
        {
            parent::__construct();

            $kanban = new TKanban;
            $kanban->setItemDatabase(self::$database);

            $criteriaStage = new TCriteria();
            $criteriaItem = new TCriteria();

            $criteriaStage->setProperty('order', 'id_ocorrencia asc');
            $criteriaItem->setProperty('order', 'ds_complemento asc');

            TSession::setValue(__CLASS__.'load_filter_id_ocorrencia', null);

            if(!empty($param["key"] ?? ""))
            {
                TSession::setValue(__CLASS__.'load_filter_id_ocorrencia', $param["key"] ?? "");
            }
            $filterVar = TSession::getValue(__CLASS__.'load_filter_id_ocorrencia');
            if (isset($filterVar) AND ( (is_scalar($filterVar) AND $filterVar !== '') OR (is_array($filterVar) AND (!empty($filterVar)))))
            {
                $criteriaStage->add(new TFilter('id_ocorrencia', '=', $filterVar)); 
            }

            TTransaction::open(self::$database);
            $stages = TbOcorrencia::getObjects($criteriaStage);
            $items  = TbComplemento::getObjects($criteriaItem);

            if($stages)
            {
                foreach ($stages as $key => $stage)
                {

                    $kanban->addStage($stage->id_ocorrencia, "{nm_outro_motivo}", $stage);

                }    
            }

            if($items)
            {
                foreach ($items as $key => $item)
                {

                    $item->dt_created_at = call_user_func(function($value, $object, $row) 
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
                    }, $item->dt_created_at, $item, null);

                    $item->tb_ocorrencia->dt_created_at = call_user_func(function($value, $object, $row) 
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
                    }, $item->tb_ocorrencia->dt_created_at, $item, null);

                    $kanban->addItem($item->id_complemento, $item->tb_ocorrencia_id, "{dt_created_at}", "<div style=\"padding: 1rem;\">
    <p style=\"color: #F7FAFD;\">
        <span style=\"color: #F7FAFD; background-color: #057AAF55; padding: 0.3rem; border-radius: 0.8rem; font-size: 0.8rem;\">Criado por</span>
        {system_users->name}
    </p>
     <p style=\"color: #F7FAFD;\">
        <span style=\"color: #F7FAFD; background-color: #057AAF55; padding: 0.3rem; border-radius: 0.8rem; font-size: 0.8rem;\">Data de Criação</span>
        {dt_created_at}
    </p>
    <p style=\"color: #F7FAFD;\">
        <span style=\"color: #F7FAFD; background-color: #057AAF55; padding: 0.3rem; border-radius: 0.8rem; font-size: 0.8rem;\">Complemento</span> <br>
        {ds_complemento}
    </p>
</div>", '', $item);

                }    
            }

            //$kanban->setTemplatePath('app/resources/card.html');

            TTransaction::close();

            $container = new TVBox;

            $container->style = 'width: 100%';
            $container->class = 'form-container';
            if(empty($param['target_container']))
            {
                $container->add(TBreadCrumb::create(["CEPAI","TbComplementoKanbanView"]));
            }
            $container->add($kanban);

            parent::add($container);
        }
        catch(Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }

    public function onShow($param = null)
    {

    } 

}

