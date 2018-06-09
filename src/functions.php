<?php
include_once __DIR__ . '/configs.php';
include_once ROOT_PATH . '/controller/PermissoesUsuarioController.php';

function possuiPermissao($id_pessoa, $id_permissao) {

    $permissoesController = new PermissoesUsuarioController();
    $permissoes = $permissoesController->getByPessoa($id_pessoa);

    $result = false;
    foreach ($permissoes as $permissao) {
        if($permissao->getId() == $id_permissao) $result = true;
    }

    return $result;
}

function get_somente_numeros_string(string $string){
    return preg_replace('/[^0-9]/', '', $string);
}

function get_string_datetime_atual(){
    return date('Y-m-d H:i:s');
}

function data_php_to_data_br(string $data_php){

    $data_br = DateTime::createFromFormat('Y-m-d', $data_php);
    if($data_br){

        return $data_br->format('d/m/Y');

    }

    $data_br = $data_br = DateTime::createFromFormat('Y-m-d H:i', $data_php);
    if($data_br){

        return $data_br->format('d/m/Y H:i');

    }

    $data_br = $data_br = DateTime::createFromFormat('Y-m-d H:i:s', $data_php);
    if($data_br){

        return $data_br->format('d/m/Y H:i:s');

    }

    return null;

}
function data_br_to_data_php(string $data_br){

    $data_php = DateTime::createFromFormat('d/m/Y', $data_br);
    if($data_php){

        return $data_php->format('Y-m-d');

    }

    $data_php = DateTime::createFromFormat('d/m/Y H:i', $data_br);
    if($data_php){

        return $data_php->format('Y-m-d H:i');

    }

    $data_php = DateTime::createFromFormat('d/m/Y H:i:s', $data_br);
    if($data_php){

        return $data_php->format('Y-m-d H:i:s');

    }

    return null;

}

function envia_email($email_destino, $assunto, $mensagem_html, $anexos = array()){

    include_once PATH_AUTOLOAD_COMPOSER;

    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->isSMTP();

    $mail->SMTPOptions = array (
        'ssl' => array (
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $mail->SMTPAuth = true;

    $mail->Priority = 1;

    $mail->CharSet = 'utf-8';

    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPSecure = 'tls';
    $mail->Port = '587';
    $mail->Username = 'smtp.supermercadoonline@gmail.com';
    $mail->Password = 'v&9Ri@rl8R3s';
    $mail->setFrom('smtp.supermercadoonline@gmail.com', 'Supermercado Online');

    $mail->isHTML(true);
    $mail->Subject = $assunto;
    $mail->Body = $mensagem_html;

    if(!empty($anexos))
        foreach($anexos as $anexo)
            $mail->addAttachment($anexo['path'], $anexo['name']);


    $mail->addAddress($email_destino);

    if($mail->send()){

        return true;

    }

    return false;

}
