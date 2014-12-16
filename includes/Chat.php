<?php

class Chat{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct()
	{

	}

	public function getHTML()
	{
		ob_start();
		?>
		<div id="chat" style="display: none;">
			<div class="messages">
				<div class="msg">
					<div class="avatar">
						<img src="<?php echo TDU; ?>/images/avatar2.png" alt="avatar">
					</div>
					<div class="text">
						Con ero optaquiatur, conseru mendanto et quid et aut ut 
						experiberspe nos digniet voluptur sequam quamus ut que 
						pre cuptas quae eossequia ius. Bitibusant.
					</div>
				</div>
				<div class="msg white">
					<div class="avatar">
						<img src="<?php echo TDU; ?>/images/avatar1.png" alt="avatar">
					</div>
					<div class="text">
						Con ero optaquiatur, conseru mendanto et quid et aut ut 
						experiberspe nos digniet voluptur sequam quamus ut que 
						pre cuptas quae eossequia ius. Bitibusant.
					</div>
				</div>
				<div class="msg">
					<div class="avatar">
						<img src="<?php echo TDU; ?>/images/avatar2.png" alt="avatar">
					</div>
					<div class="text">
						Con ero optaquiatur, conseru mendanto et quid et aut ut 
						experiberspe nos digniet voluptur sequam quamus ut que 
						pre cuptas quae eossequia ius. Bitibusant.
					</div>
				</div>
				<div class="msg white">
					<div class="avatar">
						<img src="<?php echo TDU; ?>/images/avatar1.png" alt="avatar">
					</div>
					<div class="text">
						Con ero optaquiatur, conseru mendanto et quid et aut ut 
						experiberspe nos digniet voluptur sequam quamus ut que 
						pre cuptas quae eossequia ius. Bitibusant.
					</div>
				</div>
				<div class="msg">
					<div class="avatar">
						<img src="<?php echo TDU; ?>/images/avatar2.png" alt="avatar">
					</div>
					<div class="text">
						Con ero optaquiatur, conseru mendanto et quid et aut ut 
						experiberspe nos digniet voluptur sequam quamus ut que 
						pre cuptas quae eossequia ius. Bitibusant.
					</div>
				</div>
				<div class="msg white">
					<div class="avatar">
						<img src="<?php echo TDU; ?>/images/avatar1.png" alt="avatar">
					</div>
					<div class="text">
						Con ero optaquiatur, conseru mendanto et quid et aut ut 
						experiberspe nos digniet voluptur sequam quamus ut que 
						pre cuptas quae eossequia ius. Bitibusant.
					</div>
				</div>
				<div class="msg">
					<div class="avatar">
						<img src="<?php echo TDU; ?>/images/avatar2.png" alt="avatar">
					</div>
					<div class="text">
						Con ero optaquiatur, conseru mendanto et quid et aut ut 
						experiberspe nos digniet voluptur sequam quamus ut que 
						pre cuptas quae eossequia ius. Bitibusant.
					</div>
				</div>
			</div>
			<div class="controls">
				<form action="" method="POST">
					<input type="text" name="msg" class="msg">
					<button type="submit">Přidat</button>
				</form>
			</div>
		</div>
		<?php
		$var = ob_get_contents();
		ob_end_clean();
		return $var;
	}
}