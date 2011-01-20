<?php if (isset($_SESSION['login']) && $_SESSION['login']) { ?>
	<div class="section"><p style="text-align: center">Welcome</p></div>
	<div class="prev">
		<div class="section">
			<h2>You are logged in</h2>
			<p>As &ldquo;<?=$_SESSION['name']?>&rdquo;</p>
			<p><?=print_r($_SESSION)?></p>
		</div>
	</div><div class="top">
		<div class="section">
			<h2>Log Out</h2>
			<form id="logoutform" action="#" method="post" style="display: none">
				<input type="hidden" name="action" value="logout" />
			</form><p>
				Click <a onmousedown="javascript:document.getElementById('logoutform').submit()">here</a> to Log Out.
			</p>
		</div>
	</div><div class="next">
		<div class="section">
			<h2 onmousedown="javascript:confirmdelete()">Delete</h2>
			<div class="outside"><form id="deleteform" action="#" method="post">
				<input id="deletefile" name="delete" type="text" />
				<input type="hidden" name="action" value="delete" />
				<input onclick="javascript:confirmdelete()" type="submit" value="delete" />
			</form></div>
		</div>
	</div>
<?php } else { ?>
	<div class="section">
		<p style="text-align:center">
			You found a secret!
			<a onclick="javascript:document.getElementById('secret').innerHTML=''">
				Hide
			</a>
		</p>
	</div>
	<form action="#" method="post">
		<div class="prev">
			<div class="section">
				<h2>Name</h2>
				<div class="outside">
					<input id="secretname" name="name" type="text" />
				</div>
			</div>
		</div><div class="top">
			<div class="section">
				<h2>Password</h2>
				<div class="outside">
					<input id="secretpass" name="pass" type="password">
				</div>
			</div>
		</div><div class="next">
			<div class="section">
				<h2 onclick="javascript:alert('CULO!!!');">Submit</h2>
				<div class="outside">
					<input type="hidden" name="action" value="login" />
					<input type="submit" value="Log In" />
				</div>
			</div>
		</div>
	</form>
<?php } ?>
</div>
