<?php

class OcorrenciaService
{
    
    public static function notificar($ocorrencia)
    {
        $tipo_ocorrencia = $ocorrencia->tb_tipo_ocorrencia_id;
        $muda_empresa = $ocorrencia->ic_mudar_empresa;
        
        if($tipo_ocorrencia == 5 && $muda_empresa == 1){
            $emailTemplate = new EmailTemplate(EmailTemplate::TEMPLATE1);
        }
        elseif($tipo_ocorrencia == 5 && $muda_empresa != 1) {
            $emailTemplate = new EmailTemplate(EmailTemplate::TEMPLATE2);
        }
        elseif($tipo_ocorrencia != 5 && $muda_empresa == 1){
            $emailTemplate = new EmailTemplate(EmailTemplate::TEMPLATE3);
        }
        else{
            $emailTemplate = new EmailTemplate(EmailTemplate::ATUALIZACAO);
        }
        
        $system_users = SystemUsers::where('login',  'is not', null)
                      ->orderBy('id')
                      ->getIndexedArray('email');
        
        $titulo = $emailTemplate->titulo;
        $mensagem = $emailTemplate->mensagem;
        
        $titulo = $ocorrencia->render($titulo);
        $mensagem = $ocorrencia->render($mensagem);
    
        //$user_id = explode(';',$ocorrencia->system_users->id);
        $user_email = implode(';',$system_users);
        
        //$user_email = $ocorrencia->system_users->login;
        $user_id = $ocorrencia->system_users->id;
        
        // $notificationParam = [
        //     'key' => $ocorrencia->id
        // ];
        // $icon = 'fas fa-file-invoice';
        
        //SystemNotification::register($user_id, $titulo, $mensagem, new TAction(['DetalhesFormView', 'onShow'], $notificationParam), 'Ver Ocorrência', $icon);
        
        SendGridMailService::enviar($user_email, $titulo, $mensagem);
    }
}
