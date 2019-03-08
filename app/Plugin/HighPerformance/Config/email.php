<?php
class EmailConfig
{
    public function __construct() 
    {
        $this->smtp = array(
            'host' => Configure::read('mail.smtp_host') ,
            'port' => Configure::read('mail.smtp_port') ,
            'username' => Configure::read('mail.smtp_username') ,
            'password' => Configure::read('mail.smtp_password') ,
            'transport' => 'Smtp',
        );
    }
}
?>
