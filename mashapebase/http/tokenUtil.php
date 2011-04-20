<?php

/*
 * Mashape PHP Client library.
 *
 * Copyright (C) 2011 Mashape, Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *
 * The author of this software is Mashape, Inc.
 * For any question or feedback please contact us at: support@mashape.com
 *
 */

require_once(dirname(__FILE__) . "/httpClient.php");
require_once(dirname(__FILE__) . "/../exceptions/mashapeClientException.php");

define("TOKEN_URL", "https://api.mashape.com/requestToken");

class TokenUtil {

	public static function requestToken($devKey) {
		$parameters = array("devkey"=>$devKey);
		
		$response = HttpClient::doPost(TOKEN_URL, $parameters);
		
		$jsonResponse = json_decode($response);
		if (empty($jsonResponse->errors)) {
			$token = $jsonResponse->token;
			return $token;
		} else {
			throw new MashapeClientException($jsonResponse->errors[0]->message, $jsonResponse->errors[0]->code);
		}
	}

}

?>
