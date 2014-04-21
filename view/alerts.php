<?php
		if (!empty($_SESSION['affPError'])) {
?>
		<div class="bs-callout bs-callout-danger">		    
		    <p><?php echo $_SESSION['affPError'];?></p>
		</div>
<?php
		$_SESSION['affPError'] = '';
	}
	if (!empty($_SESSION['affPInfo'])) {
?>
		<div class="bs-callout bs-callout-info">
		     <p><?php echo $_SESSION['affPError'];?></p>
		</div>

	<?php
		$_SESSION['affPInfo'] = '';
	}
	if (!empty($_SESSION['affPSuccess'])) {
?>
		<div class="alert alert-success"><?php echo $_SESSION['affPSuccess'];?></div>
<?php
		$_SESSION['affPSuccess'] = '';
	}