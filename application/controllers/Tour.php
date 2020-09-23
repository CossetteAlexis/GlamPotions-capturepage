<?php

class Tour extends CI_Controller
{
	function  __construct()
	{
		parent::__construct();
		$this->load->library('email');
		$this->users = 'testdb_users';
	}

	public function index()
	{
		$this->load->view('capture_page/capture-page');
	}

	public function join()
	{

		// Load PHPMailer library
		$this->load->library('phpmailer_lib');

		// PHPMailer object
		$mail = $this->phpmailer_lib->load();


		// SMTP configuration
		$mail->isSMTP();
		$mail->Host     = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = '';
		$mail->Password = '';
		$mail->SMTPSecure = 'ssl';
		$mail->Port     = 465;

		// Get input recipient email
		$recipient = $this->input->post('email');

		// Check if email already exist
		$this->db->where('email', $recipient);
		$this->db->where('status =', 1);
		$result = $this->db->get($this->users);

		if ($result->num_rows() > 0) { // if email exist and status is 1
			$this->session->set_flashdata('email-used', 'Email already in use. Try using other email address.');	// then email already in use
			redirect('tour');
		} else {
			// Add recipient
			$mail->addAddress($recipient);

			// Generate code
			$otp = mt_rand(
				100000,
				999999
			);

			// Save email  to database
			$data['info'] = array(
				'email' => $recipient,
				'date_created' => date("Y-m-d H:i:s")
			);
			// Get last inserted id
			$this->db->insert($this->users, $data['info']);

			$key = $this->db->insert_id();

			// Save email, otp, and key to session
			$data = array(
				'email' => $recipient,
				'otp' => $otp,
				'key' => $key
			);
			$this->session->set_userdata($data);

			$mail->setFrom('support@glampotions.com', 'Glam Potions');
			$mail->addReplyTo('support@glampotions.com', 'Glam Potions');

			$mail->Subject = 'OTP Verification';

			// Set email format to HTML
			$mail->isHTML(true);

			$mailContent = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
				</head>
				<body style="box-sizing: border-box;position: relative; -webkit-text-size-adjust: none; background-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margin: 0; padding: 0; width: 100% !important;">
				<style>
				@media  only screen and (max-width: 600px) {
				.inner-body {
				width: 100% !important;
				}

				.footer {
				width: 100% !important;
				}
				}

				@media  only screen and (max-width: 500px) {
				.button {
				width: 100% !important;
				}
				}
				</style>

				<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: 100%;">
				<tr>
				<td align="center" style="box-sizing: border-box; position: relative;">
				<table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box;  position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;">
				<tr>
				<td class="header" style="box-sizing: border-box;  position: relative; padding: 25px 0; text-align: center;">
				<a href="https://glampotions.com/tour" style="box-sizing: border-box;  position: relative; color: #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; display: inline-block;">
				Glam Potions
				</a>
				</td>
				</tr>

				<!-- Email Body -->
				<tr>
				<td class="body" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box;  position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px solid #edf2f7; margin: 0; padding: 0; width: 100%;">
				<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box;  position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;">
				<!-- Body content -->
				<tr>
				<td class="content-cell" style="box-sizing: border-box;  position: relative; max-width: 100vw; padding: 32px;">
				<h1 style="box-sizing: border-box; position: relative; color: #3d4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;">Hello!</h1>
				<p style="box-sizing: border-box; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">Welcome to Glam Potions!</p>
				<p style="box-sizing: border-box; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">Enter this code on the verification page to confirm your email address.</p>
				<p style="box-sizing: border-box; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">%otp%</p>
				<p style="box-sizing: border-box; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">Thank you for using our application!</p>
				<p style="box-sizing: border-box; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">Regards,<br>
				Glam Potions</p>



				</td>
				</tr>
				</table>
				</td>
				</tr>

				<tr>
				<td style="box-sizing: border-box;  position: relative;">
				<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box;  position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin: 0 auto; padding: 0; text-align: center; width: 570px;">
				<tr>
				<td class="content-cell" align="center" style="box-sizing: border-box;  position: relative; max-width: 100vw; padding: 32px;">
				<p style="box-sizing: border-box;  position: relative; line-height: 1.5em; margin-top: 0; color: #b0adc5; font-size: 12px; text-align: center;">© 2020 Glam Potions. All rights reserved.</p>

				</td>
				</tr>
				</table>
				</td>
				</tr>
				</table>
				</td>
				</tr>
				</table>
				</body>
				</html>';

			$mailContent = str_replace('%otp%', $otp, $mailContent);
			$mail->Body = $mailContent;

			// Send email
			if (!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				$this->load->view('capture_page/otp-verify');
			}
		}
	}

	public function verify()
	{
		if ($this->input->post('otp') == $this->session->otp) {
			// echo 'verified';
			$this->db->where('id', $this->session->key);
			$this->db->update($this->users, array('status' => 1, 'date_updated' => date("Y-m-d H:i:s")));
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('key');
			$this->session->unset_userdata('otp');
			redirect('tour');
		} else {
			$this->session->set_flashdata('invalid-otp', 'Invalid otp code');
			$this->load->view('capture_page/otp-verify');
		}
	}
}
