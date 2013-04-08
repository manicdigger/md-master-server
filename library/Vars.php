<?php
class Config {
	const
	dbserver = "localhost",
	dbusername = "",
	dbpassword = "",
	dbname = "manicdigger",
	webServerHash = "", //Private key that is unique to the webserver, never share this.
	passwordRounds = 8; //Number of rounds that password is encrypted, higher numbers take longer and are more secure.
}