<?php
		if (!empty($_GET['danger'])) {
?>
		<div class="bs-callout bs-callout-danger">		    
		    <p>An error has occurred. Please, try again.</p>
		</div>
<?php
	}
	if (!empty($_GET['info'])) {
?>
		<div class="bs-callout bs-callout-info">
		     <p>
		     	We've sent an email to <?php echo $_GET['email'];?>. 
				In the email you'll find a link that when clicked on will bring you
				back to the site so you can start using your account. 
			</p>
		</div>

	<?php
	}
	if (!empty($_GET['success'])) {
?>
		<div class="bs-callout bs-callout-success">
		     <p>
		     	Updated with success.
			</p>
		</div>
<?php
	}