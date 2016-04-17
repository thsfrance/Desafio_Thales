<?php if ( ! defined('ABSPATH')) exit; ?>
 
<?php if ( $this->login_required && ! $this->logged_in ) return; ?>
 
<nav class="menu clearfix">
	<ul>
		<li><a href="<?php echo HOME_URI;?>">Home</a></li>
		<li><a href="<?php echo HOME_URI;?>/login/">Login</a></li>
		<li><a href="<?php echo HOME_URI;?>/clientes/">Clientes</a></li>
		<li><a href="<?php echo HOME_URI;?>/servicos/">Servicos</a></li>
	</ul>
</nav>