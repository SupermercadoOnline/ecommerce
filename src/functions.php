<?php
include_once __DIR__ . '/configs.php';
include_once ROOT_PATH . '/controller/PermissoesUsuarioController.php';

function possui_permissao($id_pessoa, $id_permissao) {

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

function aplicar_mascara_reais($valor){
    return number_format($valor, 2, ',', '.');
}
function remover_mascara_reais($valor){
    if(filter_var($valor, FILTER_VALIDATE_FLOAT))
        return $valor;

    $valor = str_replace('.', '', $valor);
    $valor = str_replace(',', '.', $valor);

    return (float)number_format($valor, 2, '.', '');
}

function is_cpf_valido($cpf){

    $cpf = (string)$cpf;
    $cpf_length = strlen($cpf);
    if($cpf_length >= 11 && $cpf_length <= 14){

        $cpf = get_somente_numeros_string($cpf);
        if(!empty($cpf)){

            $d1 = 0;
            $d2 = 0;
            $ignore_list = array(
                '00000000000',
                '01234567890',
                '11111111111',
                '22222222222',
                '33333333333',
                '44444444444',
                '55555555555',
                '66666666666',
                '77777777777',
                '88888888888',
                '99999999999'
            );
            if(strlen($cpf) != 11 || in_array($cpf, $ignore_list)){
                return false;
            } else {
                for($i = 0; $i < 9; $i++){
                    $d1 += $cpf[$i] * (10 - $i);
                }
                $r1 = $d1 % 11;
                $d1 = ($r1 > 1) ? (11 - $r1) : 0;
                for($i = 0; $i < 9; $i++) {
                    $d2 += $cpf[$i] * (11 - $i);
                }
                $r2 = ($d2 + ($d1 * 2)) % 11;
                $d2 = ($r2 > 1) ? (11 - $r2) : 0;

                return substr($cpf, -2) == $d1 . $d2;
            }

        }

    }

    return false;

}

function is_cnpj_valido($cnpj){

    $cnpj = (string)$cnpj;
    $length_cnpj = strlen($cnpj);
    if($length_cnpj >= 14 && $length_cnpj <= 18){

        $cnpj = get_somente_numeros_string($cnpj);
        if(!empty($cnpj)){

            $ignore_list = array(
                '00000000000000',
                '01234567890123',
                '11111111111111',
                '22222222222222',
                '33333333333333',
                '44444444444444',
                '55555555555555',
                '66666666666666',
                '77777777777777',
                '88888888888888',
                '99999999999999'
            );

            if (strlen($cnpj) != 14 || in_array($cnpj, $ignore_list))
                return false;

            for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
            {
                $soma += $cnpj{$i} * $j;
                $j = ($j == 2) ? 9 : $j - 1;
            }

            $resto = $soma % 11;
            if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
                return false;

            for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++){
                $soma += $cnpj{$i} * $j;
                $j = ($j == 2) ? 9 : $j - 1;
            }

            $resto = $soma % 11;
            return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);

        }

    }

    return false;

}