<?php

namespace Drupal\cloudcode_mail_formatter\Plugin\Mail;

use Drupal\Core\Mail\MailInterface;

/**
 * Defines a cloudcode mail formatter.
 *
 * @Mail(
 *   id = "cloudcode_mail_formatter",
 *   label = @Translation("Cloudcode Mail Formatter")
 * )
 */
class CloudcodeMailFormatter implements MailInterface {

  /**
   * {@inheritdoc}
   */
  public function format(array $message) {
	  
    // Output the entire message array to inspect all available data.
    //echo '<pre>';
    //echo json_encode($message, JSON_PRETTY_PRINT);
    //echo '</pre>';
    //exit; // Stop execution to inspect the full message array.
	  
	  
    // Start with an empty body.
    $body = '';

    // Clean up the existing body array content by stripping HTML tags and formatting it.
    if (!empty($message['body'])) {
      // Merge the body array into a single string.
      $raw_body = implode("\n", $message['body']);
      
      // Strip out any HTML tags or unnecessary elements.
      $clean_body = strip_tags($raw_body);

      // Replace multiple \n with a single one and trim excess whitespace.
      $clean_body = preg_replace('/\n+/', "\n", $clean_body); // Normalize newlines
      $clean_body = preg_replace('/\s+/', ' ', $clean_body);  // Remove excess spaces

      // Set the cleaned-up content as the body.
      $body .= trim($clean_body);
    } else {
      $body .= "No content available.";
    }
	  
	// Add the necessary newlines between the fields for clarity. - THIS IS CLOSELY TIED TO THE LAYOUT BUILDER CONFIG
	//IF LAYOUT CONFIG CHANGES, THEN THIS CODE BREAKS!!
    $body = str_replace('Subject:', "\n\n<strong>Subject</strong>:", $body);
    $body = str_replace('Mobile Number:', "\n<strong>Mobile Number</strong>:", $body);
    $body = str_replace('Sender:', "\n<strong>Sender</strong>:", $body);
    $body = str_replace('Message:', "\n<strong>Message:</strong>\n", $body);
	  
    //echo '<pre>';
    //echo json_encode($body, JSON_PRETTY_PRINT);
    //echo '</pre>';
    //exit; // Stop execution to inspect the full message array.
	  
    // Ensure the message body is a string and not an array.
    $message['body'] = $body;
	  
    return $message;
  }

  /**
   * {@inheritdoc}
   */
  public function mail(array $message) {
    // Use Drupal's default mail sending mechanism.
    return $message;
  }

}