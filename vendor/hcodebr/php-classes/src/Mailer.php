<?php

namespace Hcode;

use Rain\Tpl;

class Mailer
{

	const USERNAME = 'wilton@mav.com.br';
	const PASSWORD = "123.qwe";
	const NAME_FROM = "W.A.P_STORE";

	private $mail;

	public function __construct($toAddress, $toName, $subject, $tlpName, $data = array())
	{

		$config = array(
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/email/",
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"         => false
	    );

		Tpl::configure( $config );

		$tpl = new Tpl;

		foreach ($data as $key => $value) {
			$tpl->assign($key,$value);
		}

		$html = $tpl->draw($tlpName, true);

		$this->mail = new \PHPMailer();
	 

		$this->mail->IsSMTP();
		$this->mail->SMTPDebug = 0;
		//Set the hostname of the mail server
		$this->mail->Host = 'mail.mav.com.br';

		$this->mail->SMTPAuth = true;
		//$this->mail->SMTPSecure = false;

		$this->mail->SMTPOptions = array(
		    'ssl' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    )
		);

		$this->mail->Port = 587;
		$this->mail->Username = Mailer::USERNAME; 
		$this->mail->Password = Mailer::PASSWORD; 
		 

		$this->mail->setFrom(Mailer::USERNAME,Mailer::NAME_FROM); 
		//$this->mail->Sender = "wilton@mav.com.br"; 
		//$this->mail->FromName = "WILTON ABREU";
		 
		//Define os destinatário(s)     
		$this->mail->AddAddress($toAddress,$toName);
		 

		$this->mail->IsHTML(true); 
		$this->mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional) 

		$this->mail->Subject  = $subject; 

		$this->mail->msgHTML($html);
		

		$this->mail->addAttachment('images/phpmailer_mini.png');


		 
		// Exibe uma mensagem de resultado
		

		
  }

  public function send()
  {
  	return $this->mail->send();

  }
}

?>