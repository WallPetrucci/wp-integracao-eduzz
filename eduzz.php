<?php

	// edz_fat_cod: Código da Fatura que originou a entrega
	// edz_cnt_cod: Código do conteúdo que o cliente final comprou na Eduzz
	// edz_cli_cod: Código do Cliente que efetuou o pagamento da fatura na Eduzz
	// edz_cli_rsocial: Nome do Cliente que efetuou o pagamento da fatura na Eduzz
	// edz_cli_email: E-mail do Cliente que efetuou o pagamento da fatura na Eduzz
	// edz_cli_cel: Celular do Cliente que efetuou o pagamento da fatura na Eduzz
	// edz_fat_dtcadastro: Data de geração da fatura na Eduzz
	// edz_gtr_dist: Código do Afiliado que realizou a venda do conteúdo na Eduzz
	// edz_gtr_param1: Parâmetros opcionais enviados via GET (p1) no redirecionamento para o checkout
	// edz_gtr_param2: Parâmetros opcionais enviados via GET (p2) no redirecionamento para o checkout
	// edz_gtr_param3: Parâmetros opcionais enviados via GET (p3) no redirecionamento para o checkout
	// edz_gtr_param4: Parâmetros opcionais enviados via GET (p4) no redirecionamento para o checkout
	// edz_gtr_param5: Parâmetros opcionais enviados via GET (p5) no redirecionamento para o checkout
	// edz_valorpago: Valor pago pelo cliente


	// $codFatura = $_POST['edz_fat_cod'];
	// $codConteudo = $_POST['edz_cnt_cod'];
	// $codCliente = $_POST['edz_cli_cod'];
	// $cliNome = $_POST['edz_cli_rsocial'];
	// $cliEmail = $_POST['edz_cli_email'];
	// $cliCelular = $_POST['edz_cli_cel'];
	// $dataFatura = $_POST['edz_fat_dtcadastro'];
	// $codAfiliado = $_POST['edz_gtr_dist'];
	// // $p1 = $_POST['edz_gtr_param1'];
	// // $p2 = $_POST['edz_gtr_param2'];
	// // $p3 = $_POST['edz_gtr_param3'];
	// // $p4 = $_POST['edz_gtr_param4'];
	// // $p5 = $_POST['edz_gtr_param5'];
	// $valorPago = $_POST['edz_valorpago'];
	// $nsidPost = $_POST['nsid'];

	// edz_fat_cod: Código da Fatura que originou a entrega
	// edz_cnt_cod: Código do conteúdo que o cliente final comprou na Eduzz
	// edz_cli_cod: Código do Cliente que efetuou o pagamento da fatura na Eduzz
	// edz_cli_taxnumber: CPF/CNPJ do Cliente.
	// edz_cli_rsocial: Nome do Cliente que efetuou o pagamento da fatura na Eduzz
	// edz_cli_email: E-mail do Cliente que efetuou o pagamento da fatura na Eduzz
	// edz_fat_dtcadastro: Data de geração da Fatura na Eduzz
	// edz_cli_cel: Celular do Cliente que efetuou o pagamento da fatura na Eduzz
	// edz_gtr_dist: Código do Afiliado que realizou a venda do conteúdo na Eduzz
	// edz_fat_status: Status da Fatura
	// edz_cli_apikey: Sua API Key de Produtor. Use-a para validar se o POST recebido da Eduzz de fato. Não repasse esta informação a ninguém, senão a pessoa terá acesso completo via API a sua conta.
	// edz_valorpago: Valor pago pelo cliente
	// edz_gtr_param1: Parâmetros opcionais enviados via GET (p1) no redirecionamento para o checkout
	// edz_gtr_param2: Parâmetros opcionais enviados via GET (p2) no redirecionamento para o checkout
	// edz_gtr_param3: Parâmetros opcionais enviados via GET (p3) no redirecionamento para o checkout
	// edz_gtr_param4: Parâmetros opcionais enviados via GET (p4) no redirecionamento para o checkout

	$codFatura = $_POST['edz_fat_cod'];
	$codConteudo = $_POST['edz_cnt_cod'];
	$codCliente = $_POST['edz_cli_cod'];
	$cliCPFeCNPJ = $_POST['edz_cli_taxnumber'];
	$cliNome = $_POST['edz_cli_rsocial'];
	$cliEmail = $_POST['edz_cli_email'];
	$cliCelular = $_POST['edz_cli_cel'];
	$dataFatura = $_POST['edz_fat_dtcadastro'];
	$codAfiliado = $_POST['edz_gtr_dist'];
	$fatStatus = $_POST['edz_fat_status'];
	//$apiKey = $_POST['edz_cli_apikey'];
	$valorPago = $_POST['edz_valorpago'];
	// $p1 = $_POST['edz_gtr_param1'];
	// $p2 = $_POST['edz_gtr_param2'];
	// $p3 = $_POST['edz_gtr_param3'];
	// $p4 = $_POST['edz_gtr_param4'];
	$nsidPost = $_POST['nsid'];

	// $codFatura = '0000001';
	// $codConteudo = '0000002';
	// $codCliente = '0000003';
	// $cliCPFeCNPJ = '123.456.789-00';
	// $cliNome = 'Eduardo7';
	// $cliEmail = 'eduardo@postali.com.br';
	// $cliCelular = '(19) 9 9677-2291';
	// $dataFatura = '06/03/2018';
	// $codAfiliado = '0000004';
	// $fatStatus = 'Aprovado';
	// //$apiKey = $_POST['edz_cli_apikey'];
	// $valorPago = 'R$ 247,00';
	// // $p1 = $_POST['edz_gtr_param1'];
	// // $p2 = $_POST['edz_gtr_param2'];
	// // $p3 = $_POST['edz_gtr_param3'];
	// // $p4 = $_POST['edz_gtr_param4'];
	// //$nsidPost = $_POST['nsid'];

	require_once "wp-load.php";

	if (($codFatura != "") && ($codConteudo != "") && ($codCliente != "") && ($nsidPost != "")) {
	
		$nsidGerada = 0;
		$nsidGerada sha1($codFatura . $codConteudo . $codCliente);
		
		if ($nsidPost == $nsidGerada) {

			if ((!email_exists($cliEmail)) && (!username_exists($cliNome))) {
				$senha = geraSenha(15, true, true, true);

				$user_info = array(
					"user_login"    => $cliNome,
					"user_pass"     => $senha,
					"user_nicename" => $cliNome,
					"user_email"    => $cliEmail,
					"display_name"  => $cliNome,
					"first_name"    => $cliNome
				);
				$insert_user_result = wp_insert_user($user_info);
				var_dump($insert_user_result);
				// if ( is_wp_error($return) ) {
				//    die($insert_user_result->get_error_message());
				// } else {
				// 	echo "Successfully created user with id: {$insert_user_result}";
				// }
			}

			$msg = "<body style='background: #e4e3e3;'>
						<div style='background: #fff;margin: 0 auto;padding:0 0 20px;width: 800px;'>
	            			<div style='background: #0a549f;color: #fff;display:block;padding: 10px 0;text-align:center'>
	                    		<h1>Compra Realizada com Sucesso!</h1>
	                		</div>
	                		<div style='margin: 15px auto;width: 80%;'><span>Dados do Pedido:</span></div>
	                		<table style='border: 2px solid #ccc;margin: 0 auto;width: 80%;'>
			                <tr style='background: #f7f7f7;'>
			                    <td style='padding: 5px'><b>Código da Fatura:</b></td>
			                    <td style='padding: 5px'>" . $codFatura . "</td>
			                </tr>
			                <tr>
			                    <td style='padding: 5px'><b>Código do Conteúdo:</b></td>
			                    <td style='padding: 5px'>" . $codConteudo . "</td>
			                </tr>
			                <tr style='background: #f7f7f7;'>
			                    <td style='padding: 5px'><b>Código do Cliente:</b></td>
			                    <td style='padding: 5px'>" . $codCliente . "</td>
			                </tr>
			                <tr>
			                    <td style='padding: 5px'><b>Data de Geração da Fatura:</b></td>
			                    <td style='padding: 5px'>" . $dataFatura . "</td>
			                </tr>
			                <tr>
			                    <td style='padding: 5px'><b>Status da Fatura:</b></td>
			                    <td style='padding: 5px'>" . $fatStatus . "</td>
			                </tr>
			                <tr style='background: #f7f7f7;'>
			                    <td style='padding: 5px'><b>Código do Afiliado:</b></td>
			                    <td style='padding: 5px'>" . $codAfiliado . "</td>
			                </tr>
			                <tr>
			                    <td style='padding: 5px'><b>Valor Pago:</b></td>
			                    <td style='padding: 5px'>" . $valorPago . "</td>
			                </tr>
			                </table>
			                <div style='margin: 15px auto;width: 80%;'><span>Dados do Cliente:</span></div>
			                <table style='border: 2px solid #ccc;margin: 0 auto;width: 80%;'>
			                <tr>
			                    <td style='padding: 5px'><b>Nome:</b></td>
			                    <td style='padding: 5px'>" .  $cliNome . "</td>
			                </tr>
			                <tr style='background: #f7f7f7;'>
			                    <td style='padding: 5px'><b>E-mail:</b></td>
			                    <td style='padding: 5px'>" . $cliEmail . "</td>
			                </tr>
			                <tr>
			                    <td style='padding: 5px'><b>Celular:</b></td>
			                    <td style='padding: 5px'>" . $cliCelular . "</td>
			                </tr>
			                <tr>
			                    <td style='padding: 5px'><b>CPF/CNPJ:</b></td>
			                    <td style='padding: 5px'>" . $cliCPFeCNPJ . "</td>
			                </tr>
			                </table>
			                <div style='margin: 15px auto;width: 80%;'><span>Dados para Acesso:</span></div>
			                <table style='border: 2px solid #ccc;margin: 0 auto;width: 80%;'>
							<tr style='background: #f7f7f7;'>
			                    <td style='padding: 5px'><b>Link de Acesso ao Conteúdo:</b></td>
			                    <td style='padding: 5px'><a href='http://membros.comopassarnovestibular.com.br/wp-login.php'>Clique Aqui</a></td>
			                </tr>
							<tr>
			                    <td style='padding: 5px'><b>Usuário de Acesso:</b></td>
			                    <td style='padding: 5px'>" . $cliNome . "</td>
			                </tr>
							<tr style='background: #f7f7f7;'>
			                    <td style='padding: 5px'><b>Senha de Acesso:</b></td>
			                    <td style='padding: 5px'>" . $senha . "</td>
			                </tr>
			                </table>
			                <div style='margin: 60px auto 20px;text-align:center;width: 80%;'><span>Como Passar no Vestibular - Desenvolvido por <a title='Criação de Sites e Web Designer Rio Claro | Postali' href='http://www.postali.com.br/' target='_blank' rel='noopener'>Criação de Sites Postali</a></span></div>
		            	</div>
		        	</body>";

				require_once('phpMail/PHPMailerAutoload.php');

				$enviaFormularioParaNome = 'Como Passar no Vestibular';

				$caixaPostalServidorNome = 'mail.anunciadora.com.br';
				$caixaPostalServidorEmail = 'eduzz@anunciadora.com.br';
				$caixaPostalServidorSenha = 'eduzz@2018';

				$assunto = "Compra Realizada com Sucesso! - Como Passar no Vestibular";

				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPAuth  = true;
				$mail->Charset   = 'utf8_decode()';
				//$mail->Host  = 'smtp.'.substr(strstr($caixaPostalServidorEmail, '@'), 1);
				$mail->Host  = $caixaPostalServidorNome;
				$mail->Port  = '587';
				$mail->Username  = $caixaPostalServidorEmail;
				$mail->Password  = $caixaPostalServidorSenha;
				$mail->From  = $caixaPostalServidorEmail;
				$mail->FromName  = utf8_decode($caixaPostalServidorNome);
				$mail->IsHTML(true);
				$mail->Subject  = utf8_decode($assunto);
				$mail->Body  = utf8_decode($msg);
				$mail->AddAddress($cliEmail, $enviaFormularioParaNome);
				$mail->Send();

				header("Location: http://membros.comopassarnovestibular.com.br/");
		} else {
			echo "<script>alert('Compra inválida');</script>";
		}
	}

	function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
	{
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%*-';
		$retorno = '';
		$caracteres = '';
		$caracteres .= $lmin;
		if ($maiusculas) $caracteres .= $lmai;
		if ($numeros) $caracteres .= $num;
		if ($simbolos) $caracteres .= $simb;
		$len = strlen($caracteres);
		for ($n = 1; $n <= $tamanho; $n++) {
		$rand = mt_rand(1, $len);
		$retorno .= $caracteres[$rand-1];
		}
		return $retorno;
	}
?>