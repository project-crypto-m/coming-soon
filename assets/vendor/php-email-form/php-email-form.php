<?php
class PHP_Email_Form {
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $messages = [];
    public $ajax = false;

    public function add_message($content, $label = '') {
        $this->messages[] = "$label: $content";
    }

    public function send() {
        $headers = "From: " . $this->from_name . " <" . $this->from_email . ">\r\n";
        $headers .= "Reply-To: " . $this->from_email . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        $message_body = implode("\n", $this->messages);

        if (mail($this->to, $this->subject, $message_body, $headers)) {
            return json_encode(["status" => "success", "message" => "Email sent successfully."]);
        } else {
            return json_encode(["status" => "error", "message" => "Failed to send email."]);
        }
    }
}
