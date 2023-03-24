<?php
function select_country($country = '') {
$countries = 'Albania,Algeria,American Samoa,Andorra,Angola,Anguilla,Antigua and Barbuda,Argentina,Armenia,Aruba,Australia,Austria,Azerbajan,Azores (Portugal),Bahamas,Bahrain,Bangladesh,Barbados,Belarus,Belgium,Belize,Benin,Bermuda,Bolivia,Bonaire (Netherlands Antillies),Bosnia,Botswana,Brazil,British Virgin Islands,Brunei,Bulgaria,Burkina Faso,Burundi,Cambodia,Cameroon,Canada,Canary Islands,Cape Verde,Cayman Islands,Central African Republic,Chad,Channel Islands,Chile,China,Colombia,Congo - Democratic Republic of(Zaire),Congo - Republic of,Cook Islands,Costa Rica,Ivory Coast,Croatia,Curacao (Netherlands Antillies),Cyprus,Czech Republic,Denmark,Djibouti,Dominica,Dominican Republic,Ecuador,Egypt,El Salvador,England,Equatorial Guniea,Eritrea,Estonia,Ethiopia,Faroe Islands (Denmark),Fiji,Finland,France,French Guiana,French Polynesia,Gabon,Gambia,Georgia,Germany,Ghana,Gibraltar,Greece,Greenland (Denmark),Grenada,Guadeloupe,Guam,Guatemala,Guinea,Guinea-Bissau,Guyana,Haiti,Holland (Netherlands),Honduras,Hong Kong,Hungary,Iceland,India,Indonesia,Ireland - Republic Of,Israel,Italy,Jamaica,Japan,Jordan,Kazakhstan,Kenya,Kiribati,Korea (South Korea),Kosrae (Federated States of Micronesia),Kuwait,Kyrgyzstan,Laos,Latvia,Lebanon,Lesotho,Liberia,Liechtenstein,Lithuania,Luxembourg,Macau,Macedonia,Madagascar,Maderia (Portugal),Malawi,Malaysia,Maldives,Mali,Malta,Marshall Islands,Martinique,Mauritania,Mauritius,Mexico,Micronesia - Federated States of,Moldova,Monaco,Mongolia,Montserrat,Morocco,Mozambique,Namibia,Nepal,Netherlands (Holland),Netherlands Antilles,New Caledonia,New Zealand,Nicaragua,Niger,Nigeria,Norfolk Island,Northern Ireland (UK),Northern Mariana Islands,Norway,Oman,Pakistan,Palau,Panama,Papua New Guinea,Paraguay,Peru,Philippines,Poland,Ponape (Federated States of Micronesia+A193),Portugal,Puerto Rico,Qatar,Reunion,Romania,Rota (Northern Mariana Islands),Russia,Rwanda,Saba (Netherlands Antilles),Saipan (Northern Mariana Islands),San Marino,Saudi Arabia,Scotland (United Kingdom),Senegal,Seychelles,Sierra Leone,Singapore,Slovakia,Slovenia,Solomon Islands,South Africa,Spain,Sri Lanka,St. Barthelemy (Guadeloupe),St. Christopher (St. Kitts and Nevis),St. Croix (U.S. Virgin Islands),St. Eustatius (Netherlands Antilles),St. John (U.S. Virgin Islands),St. Kitts and Nevis,St. Lucia,St. Maarten (Netherlands Antilles),St. Martin (Guadeloupe),St. Thomas (U.S. Virgin Islands),St. Vincent and the Grenadines,Suriname,Swaziland,Sweden,Switzerland,Syria,Tahiti (French Polynesia),Taiwan,Tajikistan,Tanzania,Thailand,Tinian (Northern Mariana Islands),Togo,Tonga,Tortola (British Virgin Islands),Trinidad and Tobago,Truk (Federated States of Micronesia),Tunisia,Turkey,Turkmenistan,Turks and Caicos Islands,Tuvalu,U.S. Virgin Islands,Uganda,Ukraine,Union Island (St. Vincent and the Grenadines),United Arab Emirates,United Kingdom,United States,Uruguay,Uzbekistan,Vanuatu,Venezuela,Vietnam,Virgin Gorda (British Virgin Islands),Wake Island,Wales (United Kingdom),Wallis and Futuna Islands,Western Samoa,Yap (Federated States of Micronesia),Yemen,Yugoslavia,Zambia,Zimbabwe
';
	
	$res = '<select name="country"><option value=""> -- Select country -- </option>';
	foreach(explode(',', $countries) as $key) {
		if($key == $country) { 
			$selected = 'selected';
		} else {
			$selected = '';
		}
		$res .= '<option value="'.$key.'" '.$selected.'>'.$key.'</option>';
	}
	$res .= '</select>';
	return $res;
}
?>
