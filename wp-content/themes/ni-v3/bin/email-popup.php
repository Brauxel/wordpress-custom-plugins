<?php
    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$to = filter_var(trim($_POST["to-address"]), FILTER_SANITIZE_EMAIL);
		//$from = filter_var(trim($_POST["from"]), FILTER_SANITIZE_EMAIL);
		$from = strip_tags(trim($_POST["from-address"]));
		$title = strip_tags(trim($_POST["title"]));
		$url = strip_tags(trim($_POST["url"]));
		$siteTitle = strip_tags(trim($_POST["sitename"]));
        $message = trim($_POST["message"]);
		$site = 'http://'.$_SERVER['HTTP_HOST'].'/subscribe/';
		
        // Check that data was sent to the mailer.
        if ( !filter_var($to, FILTER_VALIDATE_EMAIL) OR empty($message) ) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }

        // Set the email subject.
        $subject = $title.' @Next Investors';

        // Build the email content.
        $email_content = "Hi,\n\n$from has sent you this email from $siteTitle. \n\nHere is the message: $message\n\n";
		$email_content .= "Link to the page: $url\n\nTo get new articles straight to your inbox, join our mailing list by going to $site\n\nRegards,\n\n$siteTitle team";

        // Build the email headers.
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers = "From: Next Investors <admin@nextinvestors.com>";

        // Send the email.
        if (mail($to, $subject, $email_content, $headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! Your message has been sent.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>