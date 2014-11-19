<?php 
require_once "library/Utility.php";
require_once "library/Server.php";

$loggedIn = false;
$username = null;

session_start();
if(isset($_SESSION["username"])) {
	$username = $_SESSION["username"];
	$loggedIn = true;
}

$servers = Server::getServerList();

$now = new DateTime();
		
		foreach($servers as $s) {
			$link = "md://" . htmlspecialchars($s->getAddress()) . ":" . htmlspecialchars($s->getPort()) . "/?";
			if($loggedIn) { $link .= "user=" . urlencode($username) . "&auth=" . urlencode(md5($s->getPrivateKey() . $username)) . "&"; }
			$link .= "serverPassword=" . $s->getPasswordProtected();
			$heartbeat = new DateTime($s->getLastHeartbeatDate());
			$dateDiff = $now->diff($heartbeat);
			$timeDiff = $now->getTimestamp() - $heartbeat->getTimestamp();
			$offline = false;
			if($timeDiff > 300) { $offline = true; }
		?>
			<div class="row">
				<hr />
				<a class="col-md-2" href="http://mdgallery.strangebutfunny.net/browse.php?serverhash=<?php echo $s->getPublicKey(); ?>">
					<img src="http://mdgallery.strangebutfunny.net/serverimage.php?server=<?php echo $s->getPublicKey(); ?>" width="160" height="120"/>
				</a>
				<div class="col-md-7">
					<h3 class="media-heading">
						<?php if(strtoupper($s->getPasswordProtected()) === "TRUE")
						{
							?><img src="img/lock.png" alt="Server requires password." title="Server requires password."/><?php
						} ?><span class="text-muted">[<?php echo htmlspecialchars($s->getGameMode()); ?>]</span> <?php
						echo "<a href=\"" . $link . "\"";
						if($offline)
						{
							echo " class=\"offline-link\"";
						}
						echo ">";
						echo htmlspecialchars($s->getName());
						echo "</a>";
						?> <small>(<?php echo htmlspecialchars($s->getUserCount() . '/' . $s->getMaxClients()); ?>)</small>
					</h3>
					<p><?php echo htmlspecialchars($s->getMotd()); ?></p>
				</div>
				<div class="well col-md-3">
					<div class="pull-right"><a <?php echo "href=\"" . $link . "\" "; if($offline) { ?>class="btn btn-danger btn-sm">Offline<?php } else { ?>class="btn btn-success btn-sm">Online!<?php } ?></a></div>
					<div>Address: <strong><?php echo htmlspecialchars($s->getAddress()); ?></strong></div>
					<div>Players: <strong><?php echo htmlspecialchars($s->getUserList()); ?></strong></div>
					<div>Version: <strong><?php echo htmlspecialchars($s->getVersion()); ?></strong></div>
					<div>Last Ping: <strong><?php echo Utility::formatDateDiff($dateDiff); ?> ago</strong></div>
				</div>
			</div><?php } ?>