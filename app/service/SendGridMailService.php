<?php

class SendGridMailService
{
    
    public static function enviar($destinatario, $titulo, $mensagem)
    {
        $data = array();
        
        $users = explode(';',$destinatario);
        
        $tos = [];
        
        foreach($users as $dest){
            $tos[] = ['email'=>$dest];
        }
        
        $data['personalizations'][] = [
            'to' => $tos,
            'subject'=>$titulo
        ];
        $data['from'] = ['email'=>'ocorrencia@cepai-sp.com.br', 'name'=>'CEPAI SP'];
        $data['content'] = [['type'=>'text/html','value'=>$mensagem]];

        BuilderHttpClientService::post('https://api.sendgrid.com/v3/mail/send', $data, 'Bearer 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',['Content-Type: application/json']);
    }
}
