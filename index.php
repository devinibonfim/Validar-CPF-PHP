<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gerador de CPF</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="list">
            <form action="" method="post">
                CPF: <input name="CPF" type="text">
            </form>
        </div>
        <?php
            $cpf = $_POST['CPF'];

            function validaCPF($cpf) {
                // Extrai somente os números
                $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

                // Verifica se todos os digitos foram informados
                if (strlen($cpf) != 11) {
                    return false;
                }

                // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
                if (preg_match('/(\d)\1{10}/', $cpf)) {
                    return false;
                }

                // Faz o calculo para validar o CPF
                for ($t = 9; $t < 11; $t++) {
                    for ($d = 0, $c = 0; $c < $t; $c++) {
                        $d += $cpf[$c] * (($t + 1) - $c);
                    }
                    $d = ((10 * $d) % 11) % 10;
                    if ($cpf[$c] != $d) {
                        return false;
                    }
                }
                return true;
            }
            if(validaCPF($cpf) == true){
                echo "CPF valido.";
            }else{
                echo "CPF invalido.";
            }
        ?>
    </body>
</html>