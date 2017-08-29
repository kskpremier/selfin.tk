<?php

use yii\db\Migration;

class m170818_151902_coutries_document_type_etc extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{document_type}}','code',$this->string(10));
        $this->addColumn('{{country}}','code',$this->string(10));

        
             $this->insert('{{document_type}}', ["code"=>"027", "name"=> "Osobna iskaznica (strana)"]);
             $this->insert('{{document_type}}', ["code"=>"032", "name"=> "032", "name"=> "Vozačka dozvola (strana)"]);
             $this->insert('{{document_type}}', ["code"=>"002", "name"=> "Osobna putovnica (strana)"]);
             $this->insert('{{document_type}}', ["code"=>"051", "name"=> "Osobna iskaznica (domaća)"]);
             $this->insert('{{document_type}}', ["code"=>"999", "name"=> "Zdrastvena iskaznica"]);
             $this->insert('{{document_type}}', ["code"=>"037", "name"=> "Službena putovnica (domaća)"]);
             $this->insert('{{document_type}}', ["code"=>"033", "name"=> "Dječja putovnica (domaća))"]);
             $this->insert('{{document_type}}', ["code"=>"103", "name"=> "Vozačka dozvola (domaća)"]);
             $this->insert('{{document_type}}', ["code"=>"004", "name"=> "Zajednička putovnica (strana)"]);
             $this->insert('{{document_type}}', ["code"=>"003", "name"=> "Obiteljska putovnica (strana)"]);
             $this->insert('{{document_type}}', ["code"=>"005", "name"=> "Dječja putovnica (strana)"]);
             $this->insert('{{document_type}}', ["code"=>"006", "name"=> "Diplomatska putovnica (strana)"]);
             $this->insert('{{document_type}}', ["code"=>"007", "name"=> "Službena putovnica (strana)"]);
             $this->insert('{{document_type}}', ["code"=>"008", "name"=> "Pomorska knjižica (strana)"]);
             $this->insert('{{document_type}}', ["code"=>"009", "name"=> "Brodarska knjižica (strana)"]);
             $this->insert('{{document_type}}', ["code"=>"011", "name"=> "Putni list za strance - izdan od RH"]);
             $this->insert('{{document_type}}', ["code"=>"012", "name"=> "Putna isprava za izbjeglice"]);
             $this->insert('{{document_type}}', ["code"=>"013", "name"=> "Putna isprava za osobe bez državljanstva"]);
             $this->insert('{{document_type}}', ["code"=>"022", "name"=> "Potvrda o oduzimanju ili zadržavanju putne isprave"]);
             $this->insert('{{document_type}}', ["code"=>"023", "name"=> "Potvrda o prijavi gubitka ili nestanka putne isprave"]);
             $this->insert('{{document_type}}', ["code"=>"024", "name"=> "Osobna iskaznica za stranca - izdana od RH"]);
             $this->insert('{{document_type}}', ["code"=>"025", "name"=> "Posebna osobna iskaznica - diplomatska konzularna službena"]);
             $this->insert('{{document_type}}', ["code"=>"026", "name"=> "Isprave izdane na temelju međ. ugovora"]);
             $this->insert('{{document_type}}', ["code"=>"029", "name"=> "Pogranična propusnica (strana)"]);
             $this->insert('{{document_type}}', ["code"=>"030", "name"=> "Izbjeglički karton izdan od RH"]);
             $this->insert('{{document_type}}', ["code"=>"034", "name"=> "Putni list za strance (strani)"]);

        
           $this->insert('{{country}}', [ "code"=>"afg", "name"=>"Afghanistan"]);
           $this->insert('{{country}}', [ "code"=>"alb", "name"=>"Albania"]);
           $this->insert('{{country}}', [ "code"=>"dza", "name"=>"Algeria"]);
           $this->insert('{{country}}', [ "code"=>"asm", "name"=>"American Samoa"]);
           $this->insert('{{country}}', [ "code"=>"and", "name"=>"Andorra"]);
           $this->insert('{{country}}', [ "code"=>"ago", "name"=>"Angola"]);
           $this->insert('{{country}}', [ "code"=>"aia", "name"=>"Anguilla"]);
           $this->insert('{{country}}', [ "code"=>"arg", "name"=>"Argentina"]);
           $this->insert('{{country}}', [ "code"=>"arm", "name"=>"Armenia"]);
           $this->insert('{{country}}', [ "code"=>"abw", "name"=>"Aruba"]);
           $this->insert('{{country}}', [ "code"=>"aus", "name"=>"Australia"]);
           $this->insert('{{country}}', [ "code"=>"aut", "name"=>"Austria"]);
           $this->insert('{{country}}', [ "code"=>"aze", "name"=>"Azerbaijan"]);
           $this->insert('{{country}}', [ "code"=>"bhs", "name"=>"Bahamas"]);
           $this->insert('{{country}}', [ "code"=>"bhr", "name"=>"Bahrain"]);
           $this->insert('{{country}}', [ "code"=>"bgd", "name"=>"Bangladesh"]);
           $this->insert('{{country}}', [ "code"=>"brb", "name"=>"Barbados"]);
           $this->insert('{{country}}', [ "code"=>"blr", "name"=>"Belarus"]);
           $this->insert('{{country}}', [ "code"=>"bel", "name"=>"Belgium"]);
           $this->insert('{{country}}', [ "code"=>"blz", "name"=>"Belize"]);
           $this->insert('{{country}}', [ "code"=>"ben", "name"=>"Benin"]);
           $this->insert('{{country}}', [ "code"=>"bmu", "name"=>"Bermuda"]);
           $this->insert('{{country}}', [ "code"=>"btn", "name"=>"Bhutan"]);
           $this->insert('{{country}}', [ "code"=>"bol", "name"=>"Bolivia"]);
           $this->insert('{{country}}', [ "code"=>"bih", "name"=>"Bosnia and Herzegovina"]);
           $this->insert('{{country}}', [ "code"=>"bwa", "name"=>"Botswana"]);
           $this->insert('{{country}}', [ "code"=>"bvt", "name"=>"Bouvet Island"]);
           $this->insert('{{country}}', [ "code"=>"bra", "name"=>"Brazil"]);
           $this->insert('{{country}}', [ "code"=>"iot", "name"=>"British Indian Ocean Territory"]);
           $this->insert('{{country}}', [ "code"=>"brn", "name"=>"Brunei"]);
           $this->insert('{{country}}', [ "code"=>"bgr", "name"=>"Bulgaria"]);
           $this->insert('{{country}}', [ "code"=>"bfa", "name"=>"Burkina Faso"]);
           $this->insert('{{country}}', [ "code"=>"bdi", "name"=>"Burundi"]);
           $this->insert('{{country}}', [ "code"=>"khm", "name"=>"Cambodia"]);
           $this->insert('{{country}}', [ "code"=>"cmr", "name"=>"Cameroon"]);
           $this->insert('{{country}}', [ "code"=>"can", "name"=>"Canada"]);
           $this->insert('{{country}}', [ "code"=>"cpv", "name"=>"Cape Verde"]);
           $this->insert('{{country}}', [ "code"=>"cym", "name"=>"Cayman Islands"]);
           $this->insert('{{country}}', [ "code"=>"civ", "name"=>"CÃ´te dÂ’Ivoire"]);
           $this->insert('{{country}}', [ "code"=>"caf", "name"=>"Central African Republic"]);
           $this->insert('{{country}}', [ "code"=>"tcd", "name"=>"Chad"]);
           $this->insert('{{country}}', [ "code"=>"chl", "name"=>"Chile"]);
           $this->insert('{{country}}', [ "code"=>"chn", "name"=>"China"]);
           $this->insert('{{country}}', [ "code"=>"cxr", "name"=>"Christmas Island"]);
           $this->insert('{{country}}', [ "code"=>"cck", "name"=>"Cocos (Keeling) Islands"]);
           $this->insert('{{country}}', [ "code"=>"col", "name"=>"Colombia"]);
           $this->insert('{{country}}', [ "code"=>"com", "name"=>"Comoros"]);
           $this->insert('{{country}}', [ "code"=>"cog", "name"=>"Congo"]);
           $this->insert('{{country}}', [ "code"=>"cod", "name"=>"Congo, The Democratic Republic of the"]);
           $this->insert('{{country}}', [ "code"=>"cok", "name"=>"Cook Islands"]);
           $this->insert('{{country}}', [ "code"=>"cri", "name"=>"Costa Rica"]);
           $this->insert('{{country}}', [ "code"=>"hrv", "name"=>"Croatia"]);
           $this->insert('{{country}}', [ "code"=>"cub", "name"=>"Cuba"]);
           $this->insert('{{country}}', [ "code"=>"cyp", "name"=>"Cyprus"]);
           $this->insert('{{country}}', [ "code"=>"cze", "name"=>"Czech Republic"]);
           $this->insert('{{country}}', [ "code"=>"dnk", "name"=>"Denmark"]);
           $this->insert('{{country}}', [ "code"=>"dji", "name"=>"Djibouti"]);
           $this->insert('{{country}}', [ "code"=>"dma", "name"=>"Dominica"]);
           $this->insert('{{country}}', [ "code"=>"dom", "name"=>"Dominican Republic"]);
           $this->insert('{{country}}', [ "code"=>"ecu", "name"=>"Ecuador"]);
           $this->insert('{{country}}', [ "code"=>"egy", "name"=>"Egypt"]);
           $this->insert('{{country}}', [ "code"=>"slv", "name"=>"El Salvador"]);
           $this->insert('{{country}}', [ "code"=>"gnq", "name"=>"Equatorial Guinea"]);
           $this->insert('{{country}}', [ "code"=>"eri", "name"=>"Eritrea"]);
           $this->insert('{{country}}', [ "code"=>"est", "name"=>"Estonia"]);
           $this->insert('{{country}}', [ "code"=>"eth", "name"=>"Ethiopia"]);
           $this->insert('{{country}}', [ "code"=>"flk", "name"=>"Falkland Islands"]);
           $this->insert('{{country}}', [ "code"=>"fro", "name"=>"Faroe Islands"]);
           $this->insert('{{country}}', [ "code"=>"fji", "name"=>"Fiji Islands"]);
           $this->insert('{{country}}', [ "code"=>"fin", "name"=>"Finland"]);
           $this->insert('{{country}}', [ "code"=>"fra", "name"=>"France"]);
           $this->insert('{{country}}', [ "code"=>"guf", "name"=>"French Guiana"]);
           $this->insert('{{country}}', [ "code"=>"pyf", "name"=>"French Polynesia"]);
           $this->insert('{{country}}', [ "code"=>"atf", "name"=>"French Southern territories"]);
           $this->insert('{{country}}', [ "code"=>"gab", "name"=>"Gabon"]);
           $this->insert('{{country}}', [ "code"=>"gmb", "name"=>"Gambia"]);
           $this->insert('{{country}}', [ "code"=>"geo", "name"=>"Georgia"]);
           $this->insert('{{country}}', [ "code"=>"deu", "name"=>"Germany"]);
           $this->insert('{{country}}', [ "code"=>"gha", "name"=>"Ghana"]);
           $this->insert('{{country}}', [ "code"=>"gib", "name"=>"Gibraltar"]);
           $this->insert('{{country}}', [ "code"=>"grc", "name"=>"Greece"]);
           $this->insert('{{country}}', [ "code"=>"grl", "name"=>"Greenland"]);
           $this->insert('{{country}}', [ "code"=>"grd", "name"=>"Grenada"]);
           $this->insert('{{country}}', [ "code"=>"glp", "name"=>"Guadeloupe"]);
           $this->insert('{{country}}', [ "code"=>"gum", "name"=>"Guam"]);
           $this->insert('{{country}}', [ "code"=>"gtm", "name"=>"Guatemala"]);
           $this->insert('{{country}}', [ "code"=>"gin", "name"=>"Guinea"]);
           $this->insert('{{country}}', [ "code"=>"gnb", "name"=>"Guinea-Bissau"]);
           $this->insert('{{country}}', [ "code"=>"guy", "name"=>"Guyana"]);
           $this->insert('{{country}}', [ "code"=>"hti", "name"=>"Haiti"]);
           $this->insert('{{country}}', [ "code"=>"hmd", "name"=>"Heard Island and McDonald Islands"]);
           $this->insert('{{country}}', [ "code"=>"vat", "name"=>"Holy See (Vatican City State)"]);
           $this->insert('{{country}}', [ "code"=>"hnd", "name"=>"Honduras"]);
           $this->insert('{{country}}', [ "code"=>"hkg", "name"=>"Hong Kong"]);
           $this->insert('{{country}}', [ "code"=>"hun", "name"=>"Hungary"]);
           $this->insert('{{country}}', [ "code"=>"isl", "name"=>"Iceland"]);
           $this->insert('{{country}}', [ "code"=>"ind", "name"=>"India"]);
           $this->insert('{{country}}', [ "code"=>"idn", "name"=>"Indonesia"]);
           $this->insert('{{country}}', [ "code"=>"irn", "name"=>"Iran"]);
           $this->insert('{{country}}', [ "code"=>"irq", "name"=>"Iraq"]);
           $this->insert('{{country}}', [ "code"=>"irl", "name"=>"Ireland"]);
           $this->insert('{{country}}', [ "code"=>"isr", "name"=>"Israel"]);
           $this->insert('{{country}}', [ "code"=>"ita", "name"=>"Italy"]);
           $this->insert('{{country}}', [ "code"=>"jam", "name"=>"Jamaica"]);
           $this->insert('{{country}}', [ "code"=>"jpn", "name"=>"Japan"]);
           $this->insert('{{country}}', [ "code"=>"jor", "name"=>"Jordan"]);
           $this->insert('{{country}}', [ "code"=>"kaz", "name"=>"Kazakstan"]);
           $this->insert('{{country}}', [ "code"=>"ken", "name"=>"Kenya"]);
           $this->insert('{{country}}', [ "code"=>"kir", "name"=>"Kiribati"]);
           $this->insert('{{country}}', [ "code"=>"kwt", "name"=>"Kuwait"]);
           $this->insert('{{country}}', [ "code"=>"kgz", "name"=>"Kyrgyzstan"]);
           $this->insert('{{country}}', [ "code"=>"lao", "name"=>"Laos"]);
           $this->insert('{{country}}', [ "code"=>"lva", "name"=>"Latvia"]);
           $this->insert('{{country}}', [ "code"=>"lbn", "name"=>"Lebanon"]);
           $this->insert('{{country}}', [ "code"=>"lso", "name"=>"Lesotho"]);
           $this->insert('{{country}}', [ "code"=>"lbr", "name"=>"Liberia"]);
           $this->insert('{{country}}', [ "code"=>"lby", "name"=>"Libyan Arab Jamahiriya"]);
           $this->insert('{{country}}', [ "code"=>"lie", "name"=>"Liechtenstein"]);
           $this->insert('{{country}}', [ "code"=>"ltu", "name"=>"Lithuania"]);
           $this->insert('{{country}}', [ "code"=>"lux", "name"=>"Luxembourg"]);
           $this->insert('{{country}}', [ "code"=>"mac", "name"=>"Macao"]);
           $this->insert('{{country}}', [ "code"=>"mkd", "name"=>"Macedonia"]);
           $this->insert('{{country}}', [ "code"=>"mdg", "name"=>"Madagascar"]);
           $this->insert('{{country}}', [ "code"=>"mwi", "name"=>"Malawi"]);
           $this->insert('{{country}}', [ "code"=>"mys", "name"=>"Malaysia"]);
           $this->insert('{{country}}', [ "code"=>"mdv", "name"=>"Maldives"]);
           $this->insert('{{country}}', [ "code"=>"mli", "name"=>"Mali"]);
           $this->insert('{{country}}', [ "code"=>"mlt", "name"=>"Malta"]);
           $this->insert('{{country}}', [ "code"=>"mhl", "name"=>"Marshall Islands"]);
           $this->insert('{{country}}', [ "code"=>"mtq", "name"=>"Martinique"]);
           $this->insert('{{country}}', [ "code"=>"mrt", "name"=>"Mauritania"]);
           $this->insert('{{country}}', [ "code"=>"mus", "name"=>"Mauritius"]);
           $this->insert('{{country}}', [ "code"=>"myt", "name"=>"Mayotte"]);
           $this->insert('{{country}}', [ "code"=>"mex", "name"=>"Mexico"]);
           $this->insert('{{country}}', [ "code"=>"fsm", "name"=>"Micronesia, Federated States of"]);
           $this->insert('{{country}}', [ "code"=>"mda", "name"=>"Moldova"]);
           $this->insert('{{country}}', [ "code"=>"mco", "name"=>"Monaco"]);
           $this->insert('{{country}}', [ "code"=>"mng", "name"=>"Mongolia"]);
           $this->insert('{{country}}', [ "code"=>"mne", "name"=>"Montenegro"]);
           $this->insert('{{country}}', [ "code"=>"msr", "name"=>"Montserrat"]);
           $this->insert('{{country}}', [ "code"=>"mar", "name"=>"Morocco"]);
           $this->insert('{{country}}', [ "code"=>"moz", "name"=>"Mozambique"]);
           $this->insert('{{country}}', [ "code"=>"mmr", "name"=>"Myanmar"]);
           $this->insert('{{country}}', [ "code"=>"nam", "name"=>"Namibia"]);
           $this->insert('{{country}}', [ "code"=>"nru", "name"=>"Nauru"]);
           $this->insert('{{country}}', [ "code"=>"npl", "name"=>"Nepal"]);
           $this->insert('{{country}}', [ "code"=>"nld", "name"=>"Netherlands"]);
           $this->insert('{{country}}', [ "code"=>"ant", "name"=>"Netherlands Antilles"]);
           $this->insert('{{country}}', [ "code"=>"ncl", "name"=>"New Caledonia"]);
           $this->insert('{{country}}', [ "code"=>"nzl", "name"=>"New Zealand"]);
           $this->insert('{{country}}', [ "code"=>"nic", "name"=>"Nicaragua"]);
           $this->insert('{{country}}', [ "code"=>"ner", "name"=>"Niger"]);
           $this->insert('{{country}}', [ "code"=>"nga", "name"=>"Nigeria"]);
           $this->insert('{{country}}', [ "code"=>"niu", "name"=>"Niue"]);
           $this->insert('{{country}}', [ "code"=>"nfk", "name"=>"Norfolk Island"]);
           $this->insert('{{country}}', [ "code"=>"prk", "name"=>"North Korea"]);
           $this->insert('{{country}}', [ "code"=>"mnp", "name"=>"Northern Mariana Islands"]);
           $this->insert('{{country}}', [ "code"=>"nor", "name"=>"Norway"]);
           $this->insert('{{country}}', [ "code"=>"omn", "name"=>"Oman"]);
           $this->insert('{{country}}', [ "code"=>"pak", "name"=>"Pakistan"]);
           $this->insert('{{country}}', [ "code"=>"plw", "name"=>"Palau"]);
           $this->insert('{{country}}', [ "code"=>"pse", "name"=>"Palestine"]);
           $this->insert('{{country}}', [ "code"=>"pan", "name"=>"Panama"]);
           $this->insert('{{country}}', [ "code"=>"png", "name"=>"Papua New Guinea"]);
           $this->insert('{{country}}', [ "code"=>"pry", "name"=>"Paraguay"]);
           $this->insert('{{country}}', [ "code"=>"per", "name"=>"Peru"]);
           $this->insert('{{country}}', [ "code"=>"phl", "name"=>"Philippines"]);
           $this->insert('{{country}}', [ "code"=>"pcn", "name"=>"Pitcairn"]);
           $this->insert('{{country}}', [ "code"=>"pol", "name"=>"Poland"]);
           $this->insert('{{country}}', [ "code"=>"prt", "name"=>"Portugal"]);
           $this->insert('{{country}}', [ "code"=>"pri", "name"=>"Puerto Rico"]);
           $this->insert('{{country}}', [ "code"=>"qat", "name"=>"Qatar"]);
           $this->insert('{{country}}', [ "code"=>"reu", "name"=>"RÃ©union"]);
           $this->insert('{{country}}', [ "code"=>"rou", "name"=>"Romania"]);
           $this->insert('{{country}}', [ "code"=>"rus", "name"=>"Russian Federation"]);
           $this->insert('{{country}}', [ "code"=>"rwa", "name"=>"Rwanda"]);
           $this->insert('{{country}}', [ "code"=>"shn", "name"=>"Saint Helena"]);
           $this->insert('{{country}}', [ "code"=>"kna", "name"=>"Saint Kitts and Nevis"]);
           $this->insert('{{country}}', [ "code"=>"lca", "name"=>"Saint Lucia"]);
           $this->insert('{{country}}', [ "code"=>"spm", "name"=>"Saint Pierre and Miquelon"]);
           $this->insert('{{country}}', [ "code"=>"vct", "name"=>"Saint Vincent and the Grenadines"]);
           $this->insert('{{country}}', [ "code"=>"wsm", "name"=>"Samoa"]);
           $this->insert('{{country}}', [ "code"=>"smr", "name"=>"San Marino"]);
           $this->insert('{{country}}', [ "code"=>"stp", "name"=>"Sao Tome and Principe"]);
           $this->insert('{{country}}', [ "code"=>"sau", "name"=>"Saudi Arabia"]);
           $this->insert('{{country}}', [ "code"=>"sen", "name"=>"Senegal"]);
           $this->insert('{{country}}', [ "code"=>"srb", "name"=>"Serbia"]);
           $this->insert('{{country}}', [ "code"=>"syc", "name"=>"Seychelles"]);
           $this->insert('{{country}}', [ "code"=>"sle", "name"=>"Sierra Leone"]);
           $this->insert('{{country}}', [ "code"=>"sgp", "name"=>"Singapore"]);
           $this->insert('{{country}}', [ "code"=>"svk", "name"=>"Slovakia"]);
           $this->insert('{{country}}', [ "code"=>"svn", "name"=>"Slovenia"]);
           $this->insert('{{country}}', [ "code"=>"slb", "name"=>"Solomon Islands"]);
           $this->insert('{{country}}', [ "code"=>"som", "name"=>"Somalia"]);
           $this->insert('{{country}}', [ "code"=>"zaf", "name"=>"South Africa"]);
           $this->insert('{{country}}', [ "code"=>"sgs", "name"=>"South Georgia and the South Sandwich Islands"]);
           $this->insert('{{country}}', [ "code"=>"kor", "name"=>"South Korea"]);
           $this->insert('{{country}}', [ "code"=>"esp", "name"=>"Spain"]);
           $this->insert('{{country}}', [ "code"=>"lka", "name"=>"Sri Lanka"]);
           $this->insert('{{country}}', [ "code"=>"sdn", "name"=>"Sudan"]);
           $this->insert('{{country}}', [ "code"=>"sur", "name"=>"Suriname"]);
           $this->insert('{{country}}', [ "code"=>"sjm", "name"=>"Svalbard and Jan Mayen"]);
           $this->insert('{{country}}', [ "code"=>"swz", "name"=>"Swaziland"]);
           $this->insert('{{country}}', [ "code"=>"swe", "name"=>"Sweden"]);
           $this->insert('{{country}}', [ "code"=>"che", "name"=>"Switzerland"]);
           $this->insert('{{country}}', [ "code"=>"syr", "name"=>"Syria"]);
           $this->insert('{{country}}', [ "code"=>"twn", "name"=>"Taiwan"]);
           $this->insert('{{country}}', [ "code"=>"tjk", "name"=>"Tajikistan"]);
           $this->insert('{{country}}', [ "code"=>"tza", "name"=>"Tanzania"]);
           $this->insert('{{country}}', [ "code"=>"tha", "name"=>"Thailand"]);
           $this->insert('{{country}}', [ "code"=>"tgo", "name"=>"Togo"]);
           $this->insert('{{country}}', [ "code"=>"tkl", "name"=>"Tokelau"]);
           $this->insert('{{country}}', [ "code"=>"ton", "name"=>"Tonga"]);
           $this->insert('{{country}}', [ "code"=>"tto", "name"=>"Trinidad and Tobago"]);
           $this->insert('{{country}}', [ "code"=>"tun", "name"=>"Tunisia"]);
           $this->insert('{{country}}', [ "code"=>"tur", "name"=>"Turkey"]);
           $this->insert('{{country}}', [ "code"=>"tkm", "name"=>"Turkmenistan"]);
           $this->insert('{{country}}', [ "code"=>"tca", "name"=>"Turks and Caicos Islands"]);
           $this->insert('{{country}}', [ "code"=>"tuv", "name"=>"Tuvalu"]);
           $this->insert('{{country}}', [ "code"=>"uga", "name"=>"Uganda"]);
           $this->insert('{{country}}', [ "code"=>"ukr", "name"=>"Ukraine"]);
           $this->insert('{{country}}', [ "code"=>"are", "name"=>"United Arab Emirates"]);
           $this->insert('{{country}}', [ "code"=>"gbr", "name"=>"United Kingdom"]);
           $this->insert('{{country}}', [ "code"=>"usa", "name"=>"United States"]);
           $this->insert('{{country}}', [ "code"=>"umi", "name"=>"United States Minor Outlying Islands"]);
           $this->insert('{{country}}', [ "code"=>"ury", "name"=>"Uruguay"]);
           $this->insert('{{country}}', [ "code"=>"uzb", "name"=>"Uzbekistan"]);
           $this->insert('{{country}}', [ "code"=>"vut", "name"=>"Vanuatu"]);
           $this->insert('{{country}}', [ "code"=>"ven", "name"=>"Venezuela"]);
           $this->insert('{{country}}', [ "code"=>"vnm", "name"=>"Vietnam"]);
           $this->insert('{{country}}', [ "code"=>"vgb", "name"=>"Virgin Islands, British"]);
           $this->insert('{{country}}', [ "code"=>"vir", "name"=>"Virgin Islands, U.S."]);
           $this->insert('{{country}}', [ "code"=>"wlf", "name"=>"Wallis and Futuna"]);
           $this->insert('{{country}}', [ "code"=>"esh", "name"=>"Western Sahara"]);
           $this->insert('{{country}}', [ "code"=>"yem", "name"=>"Yemen"]);
           $this->insert('{{country}}', [ "code"=>"zmb", "name"=>"Zambia"]);
           $this->insert('{{country}}', [ "code"=>"zwe", "name"=>"Zimbabwe"]);

    }

    public function safeDown()
    {
        echo "m170818_151902_coutries_document_type_etc cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170818_151902_coutries_document_type_etc cannot be reverted.\n";

        return false;
    }
    */
}
