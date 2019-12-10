<?php

	class Date{

		private static $mois = array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");

		public static function formate($Paramdate){

			$date = date("d m Y", strtotime($Paramdate));

			$dateExplode = explode(" ",$date);


			return $dateExplode[0] . " " . self::$mois[$dateExplode[1] - 1] . " " . $dateExplode[2];
		}
	}

?>