<?
  # Faz o include do PEAR Mail e do Mime.
  include ("Mail.php");
  include ("Mail/mime.php");
  
  $nome    = $_POST['nome'];
  $email    = $_POST['email'];
  $assunto    = $_POST['assunto'];
  $mensagem    = $_POST['mensagem'];
  
  $data        = date("d/m/y"); 
  $ip          = $_SERVER['REMOTE_ADDR'];
  $navegador   = $_SERVER['HTTP_USER_AGENT'];
  $hora        = date("H:i");
  
  $erro='erroEnvio.php';  
  $up=0;
  
  # E-mail de destino. Caso seja mais de um destino, crie um array de e-mails.
  # *OBRIGATÓRIO*
  
  $recipients = array("info@twobrasil.com", "sandro@twobrasil.com");
  # Cabeçalho do e-mail.
  $headers = 
    array (
      'From'    => 'sandro@twobrasil.com', # O 'From' é *OBRIGATÓRIO*.
      'To'      => 'sandro@twobrasil.com',
      'Subject' => 'Mensagem enviada do site TwoBrasil'
    );
  $crlf = "\r\n";
  
  # Corpo da Mensagem e texto e em HTML
  $text = "<table width=100% border=0 cellpadding=0 cellspacing=0><tr><td width=25%><span><font face=Arial size=5>Enviado pelo site</font></span></td><td width=70%><img src=http://www.twobrasil.com/images/logop.jpg alt=TwoBrasil width=108 height=25 vspace=5 align=bottom longdesc=http://www.twobrasil.com /></td></tr></table>
  <div><img src=http://www.twobrasil.com/images/linha.jpg alt=divisão width=100% height=7 vspace=0 align=top /></div><br>
  <font size=1 face=Arial color=#999999>Data de envio: </font><font size=1 face=Arial color=#999999>$data</font><br>
  <font size=1 face=Arial color=#999999>Hora do envio: </font><font face=Arial size=1 color=#999999>$hora</font><br>
  <font size=2 face=Arial color=#003300>Nome: </font><font face=Arial size=2 color=#666666>$nome</font><br>
  <font size=2 face=Arial color=#003300>E-mail: </font><font face=Arial size=2 color=#666666><a href=mailto:$email>$email</a></font><br>
  <font size=2 face=Arial color=#003300>Mensagem: </font><font face=Arial size=2 color=#666666>$mensagem</font><br><br>
  <font size=4 face=Arial color=#000000>Dados do Cliente</font><br>
  <img src=http://www.twobrasil.com/images/linha.jpg alt=divisão width=100% height=7 vspace=0  align=top><br>
  <font size=1 face=Arial color=#003300>I.P.: </font><font face=Arial size=1 color=#333333>$ip</font><br>
  <font size=1 face=Arial color=#003300>Navegador: </font><font face=Arial size=1 color=#333333>$navegador</font><br>";
  $html = "<HTML><BODY><b>$text</b></BODY></HTML>";
  # Instancia a classe Mail_mime
  $mime = new Mail_mime($crlf);
  # Coloca o HTML no email
  $mime->setHTMLBody($html);
  
  # Efetua o upload do arquivo
  if (!empty($nome)) {
		  $up=1;
	  }else{
		  echo "<script>window.location='$erro'</script>";
		  }
  # Procesa todas as informações.
  $body = $mime->get();
  $headers = $mime->headers($headers);
  # Parâmetros para o SMTP. *OBRIGATÓRIO*
  $params = 
    array (
      'auth' => true, # Define que o SMTP requer autenticação.
      'host' => 'smtp.twobrasil.com', # Servidor SMTP
      'username' => 'sandro=twobrasil.com', # Usuário do SMTP
      'password' => 'ordnas=1978' # Senha do seu MailBox.
    );
    
  # Define o método de envio
  $mail_object =& Mail::factory('smtp', $params);
  # Envia o email. Se não ocorrer erro, retorna TRUE caso contrário, retorna um
  # objeto PEAR_Error. Para ler a mensagem de erro, use o método 'getMessage()'.
  $result = $mail_object->send($recipients, $headers, $body);
  if (PEAR::IsError($result))
  {
    echo "ERRO ao tentar enviar o email. (" . $result->getMessage(). ")";
  }   
  else
  {
   $up=1;
   
   $exibir_apos_enviar='resposta.php';   
   $recipients2 = $email;
  # Cabeçalho do e-mail.
  $headers2 = 
    array (
      'From'    => 'sandro@twobrasil.com', # O 'From' é *OBRIGATÓRIO*.
      'To'      => $recipients2,
      'Subject' => 'A TwoBrasil agradece o contato.'
    );
  $crlf2 = "\r\n";
  
  # Corpo da Mensagem e texto e em HTML
  $resposta = "<center><b><font face=Tahoma size=2 color=#808080><b>$nome</b>, obrigado por preencher nosso formul&aacute;rio de contato.<br>
Em breve responderemos as suas d&uacute;vidas ou sugest&otilde;es. </font></b></center></p>
<p align=center><img src=http://www.twobrasil.com/images/logop.jpg alt=TwoBrasil width=108 height=25 longdesc=http://www.twobrasil.com>";
  $html2 = "<HTML><BODY><b>$resposta</b></BODY></HTML>";
  # Instancia a classe Mail_mime
  $mime2 = new Mail_mime($crlf2);
  # Coloca o HTML no email
  $mime2->setHTMLBody($html2);
  # Procesa todas as informações.
  $body2 = $mime2->get();
  $headers2 = $mime2->headers($headers2);
  # Parâmetros para o SMTP. *OBRIGATÓRIO*
  $params2 = 
    array (
      'auth' => true, # Define que o SMTP requer autenticação.
      'host' => 'smtp.twobrasil.com', # Servidor SMTP
      'username' => 'sandro=twobrasil.com', # Usuário do SMTP
      'password' => 'ordnas=1978' # Senha do seu MailBox.
    );
    
  # Define o método de envio
  $mail_object2 =& Mail::factory('smtp', $params2);
  # Envia o email. Se não ocorrer erro, retorna TRUE caso contrário, retorna um
  # objeto PEAR_Error. Para ler a mensagem de erro, use o método 'getMessage()'.
  $result2 = $mail_object2->send($recipients2, $headers2, $body2);
  if (PEAR::IsError($result))
  {
    echo "ERRO ao tentar enviar o email. (" . $result2->getMessage(). ")";
  }   
  else
  {
    echo "<script>window.location='$exibir_apos_enviar'</script>";
    
  }
    
  }   
?>