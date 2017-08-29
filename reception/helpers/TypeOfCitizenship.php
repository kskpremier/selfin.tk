<?php
namespace reception\helpers;

class TypeOfCitizenship
{

    public static function getTypeOfCitizenship($type): string
    {
        switch ($type) {


            case "afg" :
                return "Afghanistan";
            case "alb" :
                return "Albania";
            case "dza" :
                return "Algeria";
            case "asm" :
                return "American Samoa";
            case "and" :
                return "Andorra";
            case "ago" :
                return "Angola";
            case "aia" :
                return "Anguilla";
            case "arg" :
                return "Argentina";
            case "arm" :
                return "Armenia";
            case "abw" :
                return "Aruba";
            case "aus" :
                return "Australia";
            case "aut" :
                return "Austria";
            case "aze" :
                return "Azerbaijan";
            case "bhs" :
                return "Bahamas";
            case "bhr" :
                return "Bahrain";
            case "bgd" :
                return "Bangladesh";
            case "brb" :
                return "Barbados";
            case "blr" :
                return "Belarus";
            case "bel" :
                return "Belgium";
            case "blz" :
                return "Belize";
            case "ben" :
                return "Benin";
            case "bmu" :
                return "Bermuda";
            case "btn" :
                return "Bhutan";
            case "bol" :
                return "Bolivia";
            case "bih" :
                return "Bosnia and Herzegovina";
            case "bwa" :
                return "Botswana";
            case "bvt" :
                return "Bouvet Island";
            case "bra" :
                return "Brazil";
            case "iot" :
                return "British Indian Ocean Territory";
            case "brn" :
                return "Brunei";
            case "bgr" :
                return "Bulgaria";
            case "bfa" :
                return "Burkina Faso";
            case "bdi" :
                return "Burundi";
            case "khm" :
                return "Cambodia";
            case "cmr" :
                return "Cameroon";
            case "can" :
                return "Canada";
            case "cpv" :
                return "Cape Verde";
            case "cym" :
                return "Cayman Islands";
            case "civ" :
                return "CÃ´te dÂ’Ivoire";
            case "caf" :
                return "Central African Republic";
            case "tcd" :
                return "Chad";
            case "chl" :
                return "Chile";
            case "chn" :
                return "China";
            case "cxr" :
                return "Christmas Island";
            case "cck" :
                return "Cocos (Keeling) Islands";
            case "col" :
                return "Colombia";
            case "com" :
                return "Comoros";
            case "cog" :
                return "Congo";
            case "cod" :
                return "Congo, The Democratic Republic of the";
            case "cok" :
                return "Cook Islands";
            case "cri" :
                return "Costa Rica";
            case "hrv" :
                return "Croatia";
            case "cub" :
                return "Cuba";
            case "cyp" :
                return "Cyprus";
            case "cze" :
                return "Czech Republic";
            case "dnk" :
                return "Denmark";
            case "dji" :
                return "Djibouti";
            case "dma" :
                return "Dominica";
            case "dom" :
                return "Dominican Republic";
            case "ecu" :
                return "Ecuador";
            case "egy" :
                return "Egypt";
            case "slv" :
                return "El Salvador";
            case "gnq" :
                return "Equatorial Guinea";
            case "eri" :
                return "Eritrea";
            case "est" :
                return "Estonia";
            case "eth" :
                return "Ethiopia";
            case "flk" :
                return "Falkland Islands";
            case "fro" :
                return "Faroe Islands";
            case "fji" :
                return "Fiji Islands";
            case "fin" :
                return "Finland";
            case "fra" :
                return "France";
            case "guf" :
                return "French Guiana";
            case "pyf" :
                return "French Polynesia";
            case "atf" :
                return "French Southern territories";
            case "gab" :
                return "Gabon";
            case "gmb" :
                return "Gambia";
            case "geo" :
                return "Georgia";
            case "deu" :
                return "Germany";
            case "gha" :
                return "Ghana";
            case "gib" :
                return "Gibraltar";
            case "grc" :
                return "Greece";
            case "grl" :
                return "Greenland";
            case "grd" :
                return "Grenada";
            case "glp" :
                return "Guadeloupe";
            case "gum" :
                return "Guam";
            case "gtm" :
                return "Guatemala";
            case "gin" :
                return "Guinea";
            case "gnb" :
                return "Guinea-Bissau";
            case "guy" :
                return "Guyana";
            case "hti" :
                return "Haiti";
            case "hmd" :
                return "Heard Island and McDonald Islands";
            case "vat" :
                return "Holy See (Vatican City State)";
            case "hnd" :
                return "Honduras";
            case "hkg" :
                return "Hong Kong";
            case "hun" :
                return "Hungary";
            case "isl" :
                return "Iceland";
            case "ind" :
                return "India";
            case "idn" :
                return "Indonesia";
            case "irn" :
                return "Iran";
            case "irq" :
                return "Iraq";
            case "irl" :
                return "Ireland";
            case "isr" :
                return "Israel";
            case "ita" :
                return "Italy";
            case "jam" :
                return "Jamaica";
            case "jpn" :
                return "Japan";
            case "jor" :
                return "Jordan";
            case "kaz" :
                return "Kazakstan";
            case "ken" :
                return "Kenya";
            case "kir" :
                return "Kiribati";
            case "kwt" :
                return "Kuwait";
            case "kgz" :
                return "Kyrgyzstan";
            case "lao" :
                return "Laos";
            case "lva" :
                return "Latvia";
            case "lbn" :
                return "Lebanon";
            case "lso" :
                return "Lesotho";
            case "lbr" :
                return "Liberia";
            case "lby" :
                return "Libyan Arab Jamahiriya";
            case "lie" :
                return "Liechtenstein";
            case "ltu" :
                return "Lithuania";
            case "lux" :
                return "Luxembourg";
            case "mac" :
                return "Macao";
            case "mkd" :
                return "Macedonia";
            case "mdg" :
                return "Madagascar";
            case "mwi" :
                return "Malawi";
            case "mys" :
                return "Malaysia";
            case "mdv" :
                return "Maldives";
            case "mli" :
                return "Mali";
            case "mlt" :
                return "Malta";
            case "mhl" :
                return "Marshall Islands";
            case "mtq" :
                return "Martinique";
            case "mrt" :
                return "Mauritania";
            case "mus" :
                return "Mauritius";
            case "myt" :
                return "Mayotte";
            case "mex" :
                return "Mexico";
            case "fsm" :
                return "Micronesia, Federated States of";
            case "mda" :
                return "Moldova";
            case "mco" :
                return "Monaco";
            case "mng" :
                return "Mongolia";
            case "mne" :
                return "Montenegro";
            case "msr" :
                return "Montserrat";
            case "mar" :
                return "Morocco";
            case "moz" :
                return "Mozambique";
            case "mmr" :
                return "Myanmar";
            case "nam" :
                return "Namibia";
            case "nru" :
                return "Nauru";
            case "npl" :
                return "Nepal";
            case "nld" :
                return "Netherlands";
            case "ant" :
                return "Netherlands Antilles";
            case "ncl" :
                return "New Caledonia";
            case "nzl" :
                return "New Zealand";
            case "nic" :
                return "Nicaragua";
            case "ner" :
                return "Niger";
            case "nga" :
                return "Nigeria";
            case "niu" :
                return "Niue";
            case "nfk" :
                return "Norfolk Island";
            case "prk" :
                return "North Korea";
            case "mnp" :
                return "Northern Mariana Islands";
            case "nor" :
                return "Norway";
            case "omn" :
                return "Oman";
            case "pak" :
                return "Pakistan";
            case "plw" :
                return "Palau";
            case "pse" :
                return "Palestine";
            case "pan" :
                return "Panama";
            case "png" :
                return "Papua New Guinea";
            case "pry" :
                return "Paraguay";
            case "per" :
                return "Peru";
            case "phl" :
                return "Philippines";
            case "pcn" :
                return "Pitcairn";
            case "pol" :
                return "Poland";
            case "prt" :
                return "Portugal";
            case "pri" :
                return "Puerto Rico";
            case "qat" :
                return "Qatar";
            case "reu" :
                return "RÃ©union";
            case "rou" :
                return "Romania";
            case "rus" :
                return "Russian Federation";
            case "rwa" :
                return "Rwanda";
            case "shn" :
                return "Saint Helena";
            case "kna" :
                return "Saint Kitts and Nevis";
            case "lca" :
                return "Saint Lucia";
            case "spm" :
                return "Saint Pierre and Miquelon";
            case "vct" :
                return "Saint Vincent and the Grenadines";
            case "wsm" :
                return "Samoa";
            case "smr" :
                return "San Marino";
            case "stp" :
                return "Sao Tome and Principe";
            case "sau" :
                return "Saudi Arabia";
            case "sen" :
                return "Senegal";
            case "srb" :
                return "Serbia";
            case "syc" :
                return "Seychelles";
            case "sle" :
                return "Sierra Leone";
            case "sgp" :
                return "Singapore";
            case "svk" :
                return "Slovakia";
            case "svn" :
                return "Slovenia";
            case "slb" :
                return "Solomon Islands";
            case "som" :
                return "Somalia";
            case "zaf" :
                return "South Africa";
            case "sgs" :
                return "South Georgia and the South Sandwich Islands";
            case "kor" :
                return "South Korea";
            case "esp" :
                return "Spain";
            case "lka" :
                return "Sri Lanka";
            case "sdn" :
                return "Sudan";
            case "sur" :
                return "Suriname";
            case "sjm" :
                return "Svalbard and Jan Mayen";
            case "swz" :
                return "Swaziland";
            case "swe" :
                return "Sweden";
            case "che" :
                return "Switzerland";
            case "syr" :
                return "Syria";
            case "twn" :
                return "Taiwan";
            case "tjk" :
                return "Tajikistan";
            case "tza" :
                return "Tanzania";
            case "tha" :
                return "Thailand";
            case "tgo" :
                return "Togo";
            case "tkl" :
                return "Tokelau";
            case "ton" :
                return "Tonga";
            case "tto" :
                return "Trinidad and Tobago";
            case "tun" :
                return "Tunisia";
            case "tur" :
                return "Turkey";
            case "tkm" :
                return "Turkmenistan";
            case "tca" :
                return "Turks and Caicos Islands";
            case "tuv" :
                return "Tuvalu";
            case "uga" :
                return "Uganda";
            case "ukr" :
                return "Ukraine";
            case "are" :
                return "United Arab Emirates";
            case "gbr" :
                return "United Kingdom";
            case "usa" :
                return "United States";
            case "umi" :
                return "United States Minor Outlying Islands";
            case "ury" :
                return "Uruguay";
            case "uzb" :
                return "Uzbekistan";
            case "vut" :
                return "Vanuatu";
            case "ven" :
                return "Venezuela";
            case "vnm" :
                return "Vietnam";
            case "vgb" :
                return "Virgin Islands, British";
            case "vir" :
                return "Virgin Islands, U.S.";
            case "wlf" :
                return "Wallis and Futuna";
            case "esh" :
                return "Western Sahara";
            case "yem" :
                return "Yemen";
            case "zmb" :
                return "Zambia";
            case "zwe" :
                return "Zimbabwe";
        }
    }
    
    public static function getTypeofCitizenshipList(){

        return[
            "afg" =>"Afghanistan",
            "alb" =>"Albania",
            "dza" =>"Algeria",
            "asm" =>"American Samoa",
            "and" =>"Andorra",
            "ago" =>"Angola",
            "aia" =>"Anguilla",
            "arg" =>"Argentina",
            "arm" =>"Armenia",
            "abw" =>"Aruba",
            "aus" =>"Australia",
            "aut" =>"Austria",
            "aze" =>"Azerbaijan",
            "bhs" =>"Bahamas",
            "bhr" =>"Bahrain",
            "bgd" =>"Bangladesh",
            "brb" =>"Barbados",
            "blr" =>"Belarus",
            "bel" =>"Belgium",
            "blz" =>"Belize",
            "ben" =>"Benin",
            "bmu" =>"Bermuda",
            "btn" =>"Bhutan",
            "bol" =>"Bolivia",
            "bih" =>"Bosnia and Herzegovina",
            "bwa" =>"Botswana",
            "bvt" =>"Bouvet Island",
            "bra" =>"Brazil",
            "iot" =>"British Indian Ocean Territory",
            "brn" =>"Brunei",
            "bgr" =>"Bulgaria",
            "bfa" =>"Burkina Faso",
            "bdi" =>"Burundi",
            "khm" =>"Cambodia",
            "cmr" =>"Cameroon",
            "can" =>"Canada",
            "cpv" =>"Cape Verde",
            "cym" =>"Cayman Islands",
            "civ" =>"CÃ´te dÂ’Ivoire",
            "caf" =>"Central African Republic",
            "tcd" =>"Chad",
            "chl" =>"Chile",
            "chn" =>"China",
            "cxr" =>"Christmas Island",
            "cck" =>"Cocos (Keeling) Islands",
            "col" =>"Colombia",
            "com" =>"Comoros",
            "cog" =>"Congo",
            "cod" =>"Congo, The Democratic Republic of the",
            "cok" =>"Cook Islands",
            "cri" =>"Costa Rica",
            "hrv" =>"Croatia",
            "cub" =>"Cuba",
            "cyp" =>"Cyprus",
            "cze" =>"Czech Republic",
            "dnk" =>"Denmark",
            "dji" =>"Djibouti",
            "dma" =>"Dominica",
            "dom" =>"Dominican Republic",
            "ecu" =>"Ecuador",
            "egy" =>"Egypt",
            "slv" =>"El Salvador",
            "gnq" =>"Equatorial Guinea",
            "eri" =>"Eritrea",
            "est" =>"Estonia",
            "eth" =>"Ethiopia",
            "flk" =>"Falkland Islands",
            "fro" =>"Faroe Islands",
            "fji" =>"Fiji Islands",
            "fin" =>"Finland",
            "fra" =>"France",
            "guf" =>"French Guiana",
            "pyf" =>"French Polynesia",
            "atf" =>"French Southern territories",
            "gab" =>"Gabon",
            "gmb" =>"Gambia",
            "geo" =>"Georgia",
            "deu" =>"Germany",
            "gha" =>"Ghana",
            "gib" =>"Gibraltar",
            "grc" =>"Greece",
            "grl" =>"Greenland",
            "grd" =>"Grenada",
            "glp" =>"Guadeloupe",
            "gum" =>"Guam",
            "gtm" =>"Guatemala",
            "gin" =>"Guinea",
            "gnb" =>"Guinea-Bissau",
            "guy" =>"Guyana",
            "hti" =>"Haiti",
            "hmd" =>"Heard Island and McDonald Islands",
            "vat" =>"Holy See (Vatican City State)",
            "hnd" =>"Honduras",
            "hkg" =>"Hong Kong",
            "hun" =>"Hungary",
            "isl" =>"Iceland",
            "ind" =>"India",
            "idn" =>"Indonesia",
            "irn" =>"Iran",
            "irq" =>"Iraq",
            "irl" =>"Ireland",
            "isr" =>"Israel",
            "ita" =>"Italy",
            "jam" =>"Jamaica",
            "jpn" =>"Japan",
            "jor" =>"Jordan",
            "kaz" =>"Kazakstan",
            "ken" =>"Kenya",
            "kir" =>"Kiribati",
            "kwt" =>"Kuwait",
            "kgz" =>"Kyrgyzstan",
            "lao" =>"Laos",
            "lva" =>"Latvia",
            "lbn" =>"Lebanon",
            "lso" =>"Lesotho",
            "lbr" =>"Liberia",
            "lby" =>"Libyan Arab Jamahiriya",
            "lie" =>"Liechtenstein",
            "ltu" =>"Lithuania",
            "lux" =>"Luxembourg",
            "mac" =>"Macao",
            "mkd" =>"Macedonia",
            "mdg" =>"Madagascar",
            "mwi" =>"Malawi",
            "mys" =>"Malaysia",
            "mdv" =>"Maldives",
            "mli" =>"Mali",
            "mlt" =>"Malta",
            "mhl" =>"Marshall Islands",
            "mtq" =>"Martinique",
            "mrt" =>"Mauritania",
            "mus" =>"Mauritius",
            "myt" =>"Mayotte",
            "mex" =>"Mexico",
            "fsm" =>"Micronesia, Federated States of",
            "mda" =>"Moldova",
            "mco" =>"Monaco",
            "mng" =>"Mongolia",
            "mne" =>"Montenegro",
            "msr" =>"Montserrat",
            "mar" =>"Morocco",
            "moz" =>"Mozambique",
            "mmr" =>"Myanmar",
            "nam" =>"Namibia",
            "nru" =>"Nauru",
            "npl" =>"Nepal",
            "nld" =>"Netherlands",
            "ant" =>"Netherlands Antilles",
            "ncl" =>"New Caledonia",
            "nzl" =>"New Zealand",
            "nic" =>"Nicaragua",
            "ner" =>"Niger",
            "nga" =>"Nigeria",
            "niu" =>"Niue",
            "nfk" =>"Norfolk Island",
            "prk" =>"North Korea",
            "mnp" =>"Northern Mariana Islands",
            "nor" =>"Norway",
            "omn" =>"Oman",
            "pak" =>"Pakistan",
            "plw" =>"Palau",
            "pse" =>"Palestine",
            "pan" =>"Panama",
            "png" =>"Papua New Guinea",
            "pry" =>"Paraguay",
            "per" =>"Peru",
            "phl" =>"Philippines",
            "pcn" =>"Pitcairn",
            "pol" =>"Poland",
            "prt" =>"Portugal",
            "pri" =>"Puerto Rico",
            "qat" =>"Qatar",
            "reu" =>"RÃ©union",
            "rou" =>"Romania",
            "rus" =>"Russian Federation",
            "rwa" =>"Rwanda",
            "shn" =>"Saint Helena",
            "kna" =>"Saint Kitts and Nevis",
            "lca" =>"Saint Lucia",
            "spm" =>"Saint Pierre and Miquelon",
            "vct" =>"Saint Vincent and the Grenadines",
            "wsm" =>"Samoa",
            "smr" =>"San Marino",
            "stp" =>"Sao Tome and Principe",
            "sau" =>"Saudi Arabia",
            "sen" =>"Senegal",
            "srb" =>"Serbia",
            "syc" =>"Seychelles",
            "sle" =>"Sierra Leone",
            "sgp" =>"Singapore",
            "svk" =>"Slovakia",
            "svn" =>"Slovenia",
            "slb" =>"Solomon Islands",
            "som" =>"Somalia",
            "zaf" =>"South Africa",
            "sgs" =>"South Georgia and the South Sandwich Islands",
            "kor" =>"South Korea",
            "esp" =>"Spain",
            "lka" =>"Sri Lanka",
            "sdn" =>"Sudan",
            "sur" =>"Suriname",
            "sjm" =>"Svalbard and Jan Mayen",
            "swz" =>"Swaziland",
            "swe" =>"Sweden",
            "che" =>"Switzerland",
            "syr" =>"Syria",
            "twn" =>"Taiwan",
            "tjk" =>"Tajikistan",
            "tza" =>"Tanzania",
            "tha" =>"Thailand",
            "tgo" =>"Togo",
            "tkl" =>"Tokelau",
            "ton" =>"Tonga",
            "tto" =>"Trinidad and Tobago",
            "tun" =>"Tunisia",
            "tur" =>"Turkey",
            "tkm" =>"Turkmenistan",
            "tca" =>"Turks and Caicos Islands",
            "tuv" =>"Tuvalu",
            "uga" =>"Uganda",
            "ukr" =>"Ukraine",
            "are" =>"United Arab Emirates",
            "gbr" =>"United Kingdom",
            "usa" =>"United States",
            "umi" =>"United States Minor Outlying Islands",
            "ury" =>"Uruguay",
            "uzb" =>"Uzbekistan",
            "vut" =>"Vanuatu",
            "ven" =>"Venezuela",
            "vnm" =>"Vietnam",
            "vgb" =>"Virgin Islands, British",
            "vir" =>"Virgin Islands, U.S.",
            "wlf" =>"Wallis and Futuna",
            "esh" =>"Western Sahara",
            "yem" =>"Yemen",
            "zmb" =>"Zambia",
            "zwe" =>"Zimbabwe"
        ];
    }
}