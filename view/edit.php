<?php
	$allMetaUser = array_map( function( $a ){ return $a[0]; }, get_user_meta($current_user->ID) );
	$affiliate = array_merge($allMetaUser, get_object_vars($current_user));
	// $affiliate = array_merge($affiliate, get_object_vars($affiliate['data']));
	// echo "<pre>";
	// print_r($affiliate);
	require_once('alerts.php');

?>
<div class="col2-set" id="customer_details">

	<div class="col-1">

		<div class="woocommerce-billing-fields">

			<form action="<?php echo site_url('wp-content/plugins/affiliate-program/cad.php') ?>" method="post">

				<h3>Personal Information</h3>
				<p class="form-row form-row-first validate-required" id="billing_first_name_field">
					<label for="billing_first_name" class="">First Name <abbr class="required" title="obrigatório">*</abbr></label>
					<input type="text" class="input-text " name="first_name" id="first_name" placeholder="" value="<?php echo $affiliate['first_name'];?>">
				</p>

				<p class="form-row form-row-last validate-required" id="billing_last_name_field">
					<label for="billing_last_name" class="">Last Name <abbr class="required" title="obrigatório">*</abbr></label>
					<input type="text" class="input-text " name="last_name" id="last_name" placeholder="" value="<?php echo $affiliate['last_name'];?>">
				</p><div class="clear"></div>

				<p class="form-row form-row-wide address-field validate-required" id="billing_email_field">
					<label for="billing_email" class="">E-mail <abbr class="required" title="obrigatório">*</abbr></label>
					<input type="text" class="input-text " name="user_email" id="user_email" placeholder="" value="<?php echo $affiliate['email'];?>">
				</p>

				<p class="form-row form-row-wide validate-required validate-email" id="billing_email_field">
					<label for="billing_email" class="">User Name <abbr class="required" title="obrigatório">*</abbr></label>
					<input type="text" class="input-text " name="user_login" id="user_login" placeholder="" value="<?php echo $affiliate['nickname'];?>">
				</p>

				<p class="form-row form-row-first validate-required validate-email" id="billing_email_field">
					<label for="billing_email" class="">Password <abbr class="required" title="obrigatório">*</abbr></label>
					<input type="password" class="input-text " name="user_pass" id="user_pass" placeholder="" value="">
				</p>

				<p class="form-row form-row-last validate-required validate-email" id="billing_email_field">
					<label for="billing_email" class="">Verify Password <abbr class="required" title="obrigatório">*</abbr></label>
					<input type="password" class="input-text " name="pass2" id="pass2" placeholder="" value="">
				</p>
				<div class="clear"></div>
				<h3>Contact Information</h3>

				<p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field">
					<label for="billing_address_1" class="">Address <abbr class="required" title="obrigatório">*</abbr></label>
					<input type="text" class="input-text " name="meta[billing_address_1]" id="billing_address_1" placeholder="" value="<?php echo $affiliate['billing_address_1'];?>">
				</p>

				<p class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated" id="billing_country_field">
					<label for="billing_country" class="">
						Country <abbr class="required" title="obrigatório">*</abbr>
					</label>
					<select name="meta[shipping_country]" id="meta[shipping_country]" class="form-control country_to_state country_select">
						<option value="">Select Country</option> 
						<?php
							$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
 							foreach ($countries as $value) {
 								$selected = '';
 								if ($value == $affiliate['shipping_country']) {
 									$selected = 'selected';
 								}
 						?>
 								<option value="<?php echo $value;?>" <?php echo $selected;?>><?php echo $value;?></option> 
 						<?
 							}
						?>						
					</select>
				</p>

				<p class="form-row form-row-wide address-field validate-required" id="billing_city_field" data-o_class="form-row form-row-wide address-field validate-required">
					<label for="billing_city" class="">City <abbr class="required" title="obrigatório">*</abbr></label>
					<input type="text" class="input-text " name="meta[billing_city]" id="meta[billing_city]" placeholder="Cidade" value="<?php echo $affiliate['billing_city'];?>">
				</p>

				<p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field">
					<label for="billing_address_1" class="">Zip Code <abbr class="required" title="obrigatório">*</abbr></label>
					<input type="text" class="input-text " name="meta[billing_postcode]" id="meta[billing_postcode]" placeholder="" value="<?php echo $affiliate['billing_postcode'];?>">
				</p>

				<div class="clear"></div>
				<h3>Website Information</h3>
				<p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field">
					<label for="billing_address_1" class="">Website Name </label>
					<input type="text" class="input-text " name="meta[site]" id="site" placeholder="" value="<?php echo $affiliate['site'];?>">
				</p>

				<p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field">
					<label for="billing_address_1" class="">Website URL </label>
					<input type="text" class="input-text " name="user_url" id="user_url" placeholder="" value="<?php echo $affiliate['data']->user_url;?>">
				</p>

				<p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field">
					<label for="billing_address_1" class="">Payment Method </label>
					<select name="meta[payment_method]" id="payment_method" class="form-control country_to_state country_select">
						<option value="">Select</option>
						<?php
							$payment = array('Paypal', 'Bank Transfer');
							foreach ($payment as $value) {
								$selected = '';
								if ($value == $affiliate['payment_method']) {
									$selected = 'selected';
								}
								echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
							}
						?>					
					</select>
				</p>

				<p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field">
					<label for="billing_address_1" class="">PayPal Username (E-mail) <abbr class="required" title="obrigatório">*</abbr></label>
					<input type="text" class="input-text " name="meta[paypal_username]" id="paypal_username" placeholder="" value="<?php echo $affiliate['paypal_username'];?>">
				</p>

				<div class="clear"></div>
				<p>
					
					<input type="hidden" name="ID" id="ID" value="<?php echo $affiliate['ID'];?>"/>					
					<input type="hidden" name="role" id="role" value="affiliate"/>
					<input type="submit" class="button alt" id="place_order" value="Sign Up" data-value="Sign Up">
				</p>
			</form>

		</div>
	</div>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<? bloginfo('url');?>/wp-content/plugins/affiliate-program/css/bootstrap.min.css">
	<style type="text/css">
		#comments,
		#respond {
			display: none;
		}

		/* Side notes for calling out things
		-------------------------------------------------- */

		/* Base styles (regardless of theme) */
		.bs-callout {
			margin: 20px 0;
			padding: 15px 30px 15px 15px;
			border-left: 5px solid #eee;
		}
		.bs-callout h4 {
			margin-top: 0;
		}
		.bs-callout p:last-child {
			margin-bottom: 0;
		}
		.bs-callout code,
		.bs-callout .highlight {
			background-color: #fff;
		}

		/* Themes for different contexts */
		.bs-callout-danger {
			background-color: #fcf2f2;
			border-color: #dFb5b4;
		}
		.bs-callout-warning {
			background-color: #fefbed;
			border-color: #f1e7bc;
		}
		.bs-callout-info {
			background-color: #f0f7fd;
			border-color: #d0e3f0;
		}
	</style>
