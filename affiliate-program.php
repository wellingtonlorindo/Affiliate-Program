<?php

/**
 * Plugin Name: Affiliate Program
 * Plugin URI: http://lorindo.com
 * Description: A nice wordpress plugin for affiliate program
 * Version: 1.0
 * Author: Wellington Lorindo 
 * Author URI: http://lorindo.com
 * License: GPL2
 */

/**
 * Check if WooCommerce is active
 **/
// if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
//     die("Yout must install and active the WooCommerce");
// }

register_activation_hook(__FILE__, 'createPage');
function createPage() {
	global $current_user;

	$title = 'Affiliate Registration';
	$content = '[affiliate_registration]';
	$post = array(
		'post_author' => $current_user->ID,
		'post_content' => $content,
		'post_name' =>  "registration-affp",
		'post_status' => 'publish',
		'post_title' => $title,
		'post_type' => 'page',
		'post_parent' => 0,
		'menu_order' => 0,
		'to_ping' =>  '',
		'pinged' => '',
		);
	wp_insert_post($post);	
}

register_deactivation_hook(__FILE__, 'delPage');
function delPage() {
	$page = end(get_posts(array(
			'name'      => 'registration-affp',
			'post_type' => 'page'
			)
		)
	); 
	wp_delete_post($page->ID, true);
}

add_shortcode( 'affiliate_registration', 'my_show_extra_profile_fields' );
function my_show_extra_profile_fields($user) { 
?>
<div class="col2-set" id="customer_details">

		<div class="col-1">

			<div class="woocommerce-billing-fields">
				
				<form action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">
					
					<h3>Personal Information</h3>
					<p class="form-row form-row-first validate-required" id="billing_first_name_field">
						<label for="billing_first_name" class="">First Name <abbr class="required" title="obrigatório">*</abbr></label>
						<input type="text" class="input-text " name="billing_first_name" id="billing_first_name" placeholder="" value="">
					</p>

					<p class="form-row form-row-last validate-required" id="billing_last_name_field">
						<label for="billing_last_name" class="">Last Name <abbr class="required" title="obrigatório">*</abbr></label>
						<input type="text" class="input-text " name="billing_last_name" id="billing_last_name" placeholder="" value="">
					</p><div class="clear"></div>

					<p class="form-row form-row-wide address-field validate-required" id="billing_email_field">
						<label for="billing_email" class="">E-mail <abbr class="required" title="obrigatório">*</abbr></label>
						<input type="text" class="input-text " name="billing_email" id="billing_email" placeholder="" value="">
					</p>

					<p class="form-row form-row-wide validate-required validate-email" id="billing_email_field">
						<label for="billing_email" class="">User Name <abbr class="required" title="obrigatório">*</abbr></label>
						<input type="text" class="input-text " name="billing_email" id="billing_email" placeholder="" value="">
					</p>

					<p class="form-row form-row-first validate-required validate-email" id="billing_email_field">
						<label for="billing_email" class="">Password <abbr class="required" title="obrigatório">*</abbr></label>
						<input type="text" class="input-text " name="billing_email" id="billing_email" placeholder="" value="">
					</p>

					<p class="form-row form-row-last validate-required validate-email" id="billing_email_field">
						<label for="billing_email" class="">Verify Password <abbr class="required" title="obrigatório">*</abbr></label>
						<input type="text" class="input-text " name="billing_email" id="billing_email" placeholder="" value="">
					</p>
					<div class="clear"></div>
					<h3>Contact Information</h3>
					
					<p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field">
						<label for="billing_address_1" class="">Address <abbr class="required" title="obrigatório">*</abbr></label>
						<input type="text" class="input-text " name="billing_address_1" id="billing_address_1" placeholder="" value="">
					</p>

					<p class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated" id="billing_country_field">
						<label for="billing_country" class="">
							País <abbr class="required" title="obrigatório">*</abbr>
						</label>
						<select name="billing_country" id="billing_country" class="form-control country_to_state country_select">
							<option value="">Select</option>
							<option value="AF">Afeganistão</option>
							<option value="AL">Albânia</option>
							<option value="DE">Alemanha</option>
							<option value="AD">Andorra</option>
							<option value="AO">Angola</option>
							<option value="AI">Anguilla</option>
							<option value="AN">Antilhas Holandesas</option>
							<option value="AQ">Antártica</option>
							<option value="AG">Antígua e Barbuda</option>
							<option value="AR">Argentina</option>
							<option value="DZ">Argélia</option>
							<option value="AM">Armênia</option>
							<option value="AW">Aruba</option>
							<option value="SA">Arábia Saudita</option>
							<option value="AU">Austrália</option>
							<option value="AZ">Azerbaijão</option>
							<option value="BS">Bahamas</option>
							<option value="BD">Bangladesh</option>
							<option value="BB">Barbados</option>
							<option value="BH">Barém</option>
							<option value="PW">Belau</option>
							<option value="BZ">Belize</option>
							<option value="BJ">Benim</option>
							<option value="BM">Bermudas</option>
							<option value="BY">Bielorrússia</option>
							<option value="BO">Bolívia</option>
							<option value="BW">Botsuana</option>
							<option value="BR">Brasil</option>
							<option value="BN">Brunei</option>
							<option value="BG">Bulgária</option>
							<option value="BF">Burquina Fasso</option>
							<option value="BI">Burúndi</option>
							<option value="BT">Butão</option>
							<option value="BE">Bélgica</option>
							<option value="BA">Bósnia e Herzegovina</option>
							<option value="CV">Cabo Verde</option>
							<option value="CM">Camarões</option>
							<option value="KH">Camboja</option>
							<option value="CA">Canadá</option>
							<option value="QA">Catar</option>
							<option value="KZ">Cazaquistão</option>
							<option value="TD">Chade</option>
							<option value="CL">Chile</option>
							<option value="CN">China</option>
							<option value="CY">Chipre</option>
							<option value="SG">Cingapura</option>
							<option value="CO">Colômbia</option>
							<option value="KM">Comores</option>
							<option value="CG">Congo (Brazzaville)</option>
							<option value="CD">Congo (Kinshasa)</option>
							<option value="KP">Coréia do Norte</option>
							<option value="KR">Coréia do Sul</option>
							<option value="CR">Costa Rica</option>
							<option value="CI">Costa do Marfim</option>
							<option value="HR">Croácia</option>
							<option value="CU">Cuba</option>
							<option value="CW">CuraÇao</option>
							<option value="DK">Dinamarca</option>
							<option value="DJ">Djibouti</option>
							<option value="DM">Dominica</option>
							<option value="EG">Egito</option>
							<option value="SV">El Salvador</option>
							<option value="AE">Emirados Árabes Unidos</option>
							<option value="EC">Equador</option>
							<option value="ER">Eritreia</option>
							<option value="SI">Eslovenia</option>
							<option value="SK">Eslováquia</option>
							<option value="ES">Espanha</option>
							<option value="US">Estados Unidos (US)</option>
							<option value="EE">Estônia</option>
							<option value="ET">Etiópia</option>
							<option value="FJ">Fiji</option>
							<option value="PH">Filipinas</option>
							<option value="FI">Finlândia</option>
							<option value="FR">França</option>
							<option value="GA">Gabão</option>
							<option value="GH">Gana</option>
							<option value="GE">Geórgia</option>
							<option value="GI">Gibraltar</option>
							<option value="GD">Granada</option>
							<option value="GL">Groenlândia</option>
							<option value="GR">Grécia</option>
							<option value="GP">Guadalupe</option>
							<option value="GT">Guatemala</option>
							<option value="GG">Guernsey</option>
							<option value="GY">Guiana</option>
							<option value="GF">Guiana Francesa</option>
							<option value="GN">Guiné</option>
							<option value="GQ">Guiné Equatorial</option>
							<option value="GW">Guiné-Bissau</option>
							<option value="GM">Gâmbia</option>
							<option value="HT">Haiti</option>
							<option value="NL">Holanda</option>
							<option value="HN">Honduras</option>
							<option value="HK">Hong Kong</option>
							<option value="HU">Hungria</option>
							<option value="BV">Ilha Bouvet</option>
							<option value="CX">Ilha Christmas</option>
							<option value="HM">Ilha Heard e Ilhas McDonald</option>
							<option value="NF">Ilha Norfolk</option>
							<option value="IM">Ilha de Man</option>
							<option value="MF">Ilha de São Martinho (República Francesa)</option>
							<option value="AX">Ilhas Åland</option>
							<option value="KY">Ilhas Cayman</option>
							<option value="CC">Ilhas Cocos</option>
							<option value="CK">Ilhas Cook</option>
							<option value="FO">Ilhas Feroe</option>
							<option value="GS">Ilhas Geórgia do Sul e Sandwich do Sul</option>
							<option value="FK">Ilhas Malvinas</option>
							<option value="MH">Ilhas Marshall</option>
							<option value="PN">Ilhas Pitcairn</option>
							<option value="SB">Ilhas Salomão</option>
							<option value="TC">Ilhas Turcas e Caicos</option>
							<option value="VG">Ilhas Virgens Britânicas</option>
							<option value="ID">Indonésia</option>
							<option value="IQ">Iraque</option>
							<option value="IE">Irlanda</option>
							<option value="IR">Irã</option>
							<option value="IS">Islândia</option>
							<option value="IL">Israel</option>
							<option value="IT">Itália</option>
							<option value="YE">Iémen</option>
							<option value="JM">Jamaica</option>
							<option value="JP">Japão</option>
							<option value="JE">Jersey</option>
							<option value="JO">Jordânia</option>
							<option value="KW">Kuweit</option>
							<option value="LA">Laos</option>
							<option value="LS">Lesoto</option>
							<option value="LR">Libéria</option>
							<option value="LI">Liechtenstein</option>
							<option value="LT">Lituânia</option>
							<option value="LU">Luxemburgo</option>
							<option value="LV">Látvia</option>
							<option value="LB">Líbano</option>
							<option value="LY">Líbia</option>
							<option value="MO">Macau R.A.E, China</option>
							<option value="MK">Macedônia</option>
							<option value="MG">Madagascar</option>
							<option value="MW">Malawi</option>
							<option value="MV">Maldivas</option>
							<option value="ML">Mali</option>
							<option value="MT">Malta</option>
							<option value="MY">Malásia</option>
							<option value="MA">Marrocos</option>
							<option value="MQ">Martinica</option>
							<option value="MR">Mauritânia</option>
							<option value="MU">Maurício</option>
							<option value="YT">Mayotte</option>
							<option value="FM">Micronésia</option>
							<option value="MD">Moldávia</option>
							<option value="MN">Mongólia</option>
							<option value="ME">Montenegro</option>
							<option value="MS">Montserrat</option>
							<option value="MZ">Moçambique</option>
							<option value="MX">México</option>
							<option value="MC">Mônaco</option>
							<option value="NA">Namíbia</option>
							<option value="NR">Nauru</option>
							<option value="NP">Nepal</option>
							<option value="NI">Nicarágua</option>
							<option value="NG">Nigéria</option>
							<option value="NU">Niue</option>
							<option value="NO">Noruega</option>
							<option value="NC">Nova Caledónia</option>
							<option value="NZ">Nova Zelândia</option>
							<option value="NE">Níger</option>
							<option value="OM">Omã</option>
							<option value="PA">Panamá</option>
							<option value="PG">Papua-Nova Guiné</option>
							<option value="PK">Paquistão</option>
							<option value="PY">Paraguai</option>
							<option value="BQ">Países baixos Caribenhos</option>
							<option value="PE">Peru</option>
							<option value="PF">Polinésia Francesa</option>
							<option value="PL">Polônia</option>
							<option value="PT">Portugal</option>
							<option value="KG">Quirguistão</option>
							<option value="KI">Quiribáti</option>
							<option value="KE">Quênia</option>
							<option value="GB">Reino Unido (UK)</option>
							<option value="CZ">República Checa</option>
							<option value="DO">República Dominicana</option>
							<option value="MM">República da União de Myanmar</option>
							<option value="CF">República da África Central</option>
							<option value="RE">Reunião</option>
							<option value="RO">Romênia</option>
							<option value="RW">Ruanda</option>
							<option value="RU">Rússia</option>
							<option value="ST">São Tomé e Príncipe</option>
							<option value="EH">Saara Ocidental</option>
							<option value="SX">Saint Martin (parte Holandesa)</option>
							<option value="PM">Saint-Pierre e Miquelon</option>
							<option value="WS">Samoa Ocidental</option>
							<option value="SM">San Marino</option>
							<option value="SH">Santa Helena</option>
							<option value="LC">Santa Lúcia</option>
							<option value="SN">Senegal</option>
							<option value="SL">Serra Leoa</option>
							<option value="SC">Seychelles</option>
							<option value="SO">Somália</option>
							<option value="LK">Sri Lanka</option>
							<option value="SZ">Suazilândia</option>
							<option value="SD">Sudão</option>
							<option value="SS">Sudão do Sul</option>
							<option value="CH">Suiça</option>
							<option value="SR">Suriname</option>
							<option value="SE">Suécia</option>
							<option value="SJ">Svalbard e Jan Mayen</option>
							<option value="BL">São Bartolomeu</option>
							<option value="KN">São Cristóvão e Nevis</option>
							<option value="VC">São Vicente e Granadinas</option>
							<option value="RS">Sérvia</option>
							<option value="SY">Síria</option>
							<option value="TH">Tailândia</option>
							<option value="TW">Taiwan</option>
							<option value="TJ">Tajiquistão</option>
							<option value="TZ">Tanzânia</option>
							<option value="IO">Território Britânico do Oceano Índico</option>
							<option value="PS">Território Palestino</option>
							<option value="TF">Território das Terras Austrais e Antárcticas Francesas</option>
							<option value="TL">Timor-Leste</option>
							<option value="TG">Togo</option>
							<option value="TK">Tokelau</option>
							<option value="TO">Tonga</option>
							<option value="TT">Trinidad e Tobago</option>
							<option value="TN">Tunísia</option>
							<option value="TM">Turcomenistão</option>
							<option value="TR">Turquia</option>
							<option value="TV">Tuvalu</option>
							<option value="UA">Ucrânia</option>
							<option value="UG">Uganda</option>
							<option value="UY">Uruguai</option>
							<option value="UZ">Uzbequistão</option>
							<option value="VU">Vanuatu</option>
							<option value="VA">Vaticano</option>
							<option value="VE">Venezuela</option>
							<option value="VN">Vietnã</option>
							<option value="WF">Wallis e Futuna</option>
							<option value="ZW">Zimbábue</option>
							<option value="ZM">Zâmbia</option>
							<option value="ZA">África do Sul</option>
							<option value="AT">Áustria</option>
							<option value="IN">Índia</option>
						</select>
					</p>

					<p class="form-row form-row-wide address-field validate-required" id="billing_city_field" data-o_class="form-row form-row-wide address-field validate-required">
						<label for="billing_city" class="">City <abbr class="required" title="obrigatório">*</abbr></label>
						<input type="text" class="input-text " name="billing_city" id="billing_city" placeholder="Cidade" value="">
					</p>

					<p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field">
						<label for="billing_address_1" class="">Zip Code <abbr class="required" title="obrigatório">*</abbr></label>
						<input type="text" class="input-text " name="billing_address_1" id="billing_address_1" placeholder="" value="">
					</p>

					<div class="clear"></div>
					<h3>Website Information</h3>
					<p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field">
						<label for="billing_address_1" class="">Website Name <abbr class="required" title="obrigatório">*</abbr></label>
						<input type="text" class="input-text " name="billing_address_1" id="billing_address_1" placeholder="" value="">
					</p>

					<p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field">
						<label for="billing_address_1" class="">Website URL <abbr class="required" title="obrigatório">*</abbr></label>
						<input type="text" class="input-text " name="billing_address_1" id="billing_address_1" placeholder="" value="">
					</p>

					<p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field">
						<label for="billing_address_1" class="">Payment Method <abbr class="required" title="obrigatório">*</abbr></label>
						<select name="billing_country" id="billing_country" class="form-control country_to_state country_select">
							<option value="">Select</option>
							<option value="AF">PayPal</option>
							<option value="AL">Bank Transfer</option>					
						</select>
					</p>

					<p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field">
						<label for="billing_address_1" class="">PayPal Username (E-mail) <abbr class="required" title="obrigatório">*</abbr></label>
						<input type="text" class="input-text " name="billing_address_1" id="billing_address_1" placeholder="" value="">
					</p>

					<div class="clear"></div>
					<p>
						<input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Sign Up" data-value="Sign Up">
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
	</style>

<?php
}

// Update extra fields
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );
function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) ) {
		return false;		
	}
	update_usermeta( $user_id, 'twitter', $_POST['twitter'] );
}

?>

