<?php 
//response generation function
$response = "";

//function to generate response
function my_contact_form_generate_response($type, $message){	
	global $response;
	if($type == "success") $response = "<div class='success'>{$message}</div>";
	else $response = "<div class='error'>{$message}</div>";
}
//response messages
$not_human       = "Human verification incorrect.";
$missing_content = "Please supply all information.";
$email_invalid   = "Email Address Invalid.";
$message_unsent  = "Message was not sent. Try Again.";
$message_sent    = "Thanks! Your message has been sent.<!-- Facebook Conversion Code for Contacted --><script>(function() {var _fbq = window._fbq || (window._fbq = []);if (!_fbq.loaded) {var fbds = document.createElement('script');fbds.async = true;fbds.src = '//connect.facebook.net/en_US/fbds.js';var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(fbds, s);_fbq.loaded = true;}})();window._fbq = window._fbq || [];window._fbq.push(['track', '6018701386216', {'value':'0.01','currency':'CAD'}]);</script><noscript><img height='1' width='1' alt='' style='display:none' src='https://www.facebook.com/tr?ev=6018701386216&amp;cd[value]=0.01&amp;cd[currency]=CAD&amp;noscript=1'/></noscript>";

//user posted variables
$name = $_POST['message_name'];
$email = $_POST['message_email'];
$phone = $_POST['message_phone'];
$date = $_POST['message_date'];
$type = $_POST['session_type'];
$message = $_POST['message_text'];
$human = $_POST['message_human'];

$sendmessage .= '<p><b>'.$name.'</b><br>'.$email.'<br>'.$phone.'</p><p>Is interested in '.$type.'</p><p>'.htmlspecialchars($message).'</p>';

//php mailer variables
$to = get_option('admin_email');
$subject = "Someone sent a message from ".get_bloginfo('name');
$headers[] = 'From: '.$name.' <'.$email.'>';
$headers[] = 'Reply-To: '.$name.' <'.$email.'>';
function set_html_content_type() {
	return 'text/html';
}
if(!$human == 0){
  if($human != 2) my_contact_form_generate_response("error", $not_human); //not human!
  else {

    //validate email
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	  my_contact_form_generate_response("error", $email_invalid);
	else //email is valid
	{
	  //validate presence of name and message
		if(empty($name) || empty($message)){
		  my_contact_form_generate_response("error", $missing_content);
		}
		else //ready to go!
		{
			add_filter( 'wp_mail_content_type', 'set_html_content_type' );
		  	$sent = wp_mail($to, $subject, $sendmessage, $headers);
			remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
			if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
			else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent
		}
	}
  }
}
else if ($_POST['submitted']) my_contact_form_generate_response("error", $missing_content);
get_header(); 
while(have_posts()){
the_post();?>

<section role="row" data-valign="center" data-align="center">
	<aside role="panel">
		<div role="textbox">
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
		</div>
	</aside>
</section>
<section role="row" data-valign="center" data-align="center">
	<aside role="panel">
		<div role="textbox"> <?php echo $response; ?>
			<form action="<?php the_permalink(); ?>" method="post">
				<p>
					<label for="name">Name</label>
					<input type="text" required id="name" name="message_name" value="<?php echo esc_attr($_POST['message_name']); ?>">
				</p>
				<p>
					<label for="email">Email</label>
					<input type="email" required id="email" name="message_email" value="<?php echo esc_attr($_POST['message_email']); ?>">
				</p>
				<p>
					<label for="phone">Phone</label>
					<input type="tel" required id="phone" name="message_phone" value="<?php echo esc_attr($_POST['message_phone']); ?>">
				</p>
				<p>
					<label for="date">Session Date</label>
					<input type="date" id="date" name="message_date" value="<?php echo esc_attr($_POST['message_date']); ?>">
				</p>
				<p> Session Type<br>
					<input type="radio" id="type1" name="session_type" value="Wedding">
					<label for="type1">Wedding</label>
					<input type="radio" id="type2" name="session_type" value="Boudoir">
					<label for="type2">Boudoir</label>
					<input type="radio" id="type3" name="session_type" value="Family">
					<label for="type3">Family</label>
					<input type="radio" id="type4" name="session_type" value="Other">
					<label for="type4">Other</label>
				</p>
				<p>
					<label for="message">Message</label>
					<textarea rows="4" id="message" name="message_text"><?php echo esc_textarea($_POST['message_text']); ?></textarea>
				</p>
				<p>
					<label for="message_human">Human Verification: </label>
					<input type="text" required style="width: 60px;" name="message_human">
					+ 3 = 5</p>
				<input type="hidden" name="submitted" value="1">
				<p>
					<input type="submit" class="button" onClick="ga('send', 'event', 'contact', 'send');">
				</p>
			</form>
		</div>
	</aside>
</section>
<!-- mission Panel -->

<?php } get_footer(); ?>
