<?php

/*
 *  Class mime_mail
 *  Original implementation by Sascha Schumann <sascha@schumann.cx>
 *  Modified by Tobias Ratschiller <tobias@dnet.it>:
 *      - General code clean-up
 *      - separate body- and from-property
 *      - killed some mostly un-necessary stuff
 */

class mime_mail {

    var $parts;
    var $to;
    var $bcc;
    var $from;
    var $headers;
    var $subject;
    var $body;

    /*
     *     void mime_mail()
     *     class constructor
     */

    function mime_mail() {
        $this->parts = array();
        $this->to = "";
        $this->from = "";
        $this->bcc = "";
        $this->subject = "";
        $this->body = "";
        $this->headers = "";
    }

    /*
     *     void add_attachment(string message, [string name], [string ctype])
     *     Add an attachment to the mail object
     */

    function add_attachment($message, $name = "", $ctype = "application/octet-stream") {
        $this->parts[] = array(
            "ctype" => $ctype,
            "message" => $message,
            "encode" => "Content-type: text/html;charset=utf-8; Content-Transfer-Encoding: 7bit",
            "name" => $name
        );
    }

    /*
     *      void build_message(array part=
     *      Build message parts of an multipart mail
     */

    function build_message($part) {
        $message = $part["message"];
        $message = chunk_split(base64_encode($message));
        $encoding = "base64";
        return "Content-Type: " . $part["ctype"] .
                ($part["name"] ? "; name = \"" . $part["name"] . "\"" : "") .
                "\nContent-Transfer-Encoding: $encoding\n\n$message\n";
    }

    /*
     *      void build_multipart()
     *      Build a multipart mail
     */

    function build_multipart() {
        $boundary = "b" . md5(uniqid(time()));
        $multipart = "Content-Type: multipart/mixed; boundary = $boundary\n\nThis is a MIME encoded message.\n\n--$boundary";

        for ($i = sizeof($this->parts) - 1; $i >= 0; $i--) {
            $multipart .= "\n" . $this->build_message($this->parts[$i]) . "--$boundary";
        }
        return $multipart.= "--\n";
    }

    /*
     *      void send()
     *      Send the mail (last class-function to be called)
     */

///////////////////// Recover below before deployment //////////////////////////
//    function send() {
//        $mime = "";
//        if (!empty($this->from))
//            $mime .= "From: " . $this->from . "\n";
//        if (!empty($this->bcc))
//            $mime .= "Bcc: " . $this->from . "\n";
//        if (!empty($this->headers))
//            $mime .= $this->headers . "\n";
//
//        if (!empty($this->body))
//        //$this->add_attachment($this->body, "", "text/plain");   
//            $this->add_attachment($this->body, "", "text/html");
//        $mime .= "MIME-Version: 1.0\n" . $this->build_multipart();
//        mail($this->to, $this->subject, "", $mime);        
//    }
///////////////////// Recover above before deployment //////////////////////////

/////////////////// Remove below before deployment ///////////////////////////
    function send() {
        $tmp_error_reporting = error_reporting();
        error_reporting(0);
        require_once "Mail.php";
        $from = 'computer.7807108966@gmail.com';
        $to = 'computer.7807108966@gmail.com';
        $subject = $this->subject;
        $body = $this->body;
        $contantType = "text/html; charset=utf-8";
        $headers = array(
            'From' => $from,
            'To' => $to,
            'Subject' => $subject,
            'Content-type' => $contantType    
        );
        $smtp = Mail::factory('smtp', array(
                'host' => 'ssl://smtp.gmail.com',
                'port' => '465',
                'auth' => true,
                'username' => 'computer.7807108966@gmail.com',
                'password' => 'l3tmeinl3tmein'
            ));
        $mail = $smtp->send($to, $headers, $body);
        if (PEAR::isError($mail)) {
            echo('<p>' . $mail->getMessage() . '</p>');
        } else {
            echo('<p>Message successfully sent!</p>');
        }
        
        error_reporting($tmp_error_reporting);
    }
/////////////////// Remove above before deployment //////////////////////////        



}

; // end of class
?>
