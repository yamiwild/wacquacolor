
<!-- BEGIN LOGIN FORM -->
	<form class="login-form" method="post">
		<h3 class="form-title">Login</h3>
		<?php if(isset($error)): ?>
		<div class="alert alert-danger">
			<button class="close" data-close="alert"></button>
			<span>
			<?php echo $error; ?>
			</span>
		</div>
		<?php endif; ?>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">E-mail</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input name="use_login" class="form-control placeholder-no-fix" type="text" autocomplete="on" placeholder="Usuário" name="username"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Senha</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input name="use_password" class="form-control placeholder-no-fix" autocomplete="on" type="password" placeholder="Senha" name="password"/>
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" name="btn_login" class="btn blue pull-right">
			Entrar <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	<!-- END LOGIN FORM -->
