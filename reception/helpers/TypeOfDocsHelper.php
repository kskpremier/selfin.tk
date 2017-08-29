<?php
/**
 * Created by PhpStorm.
 * User: onarskaya
 * Date: 02.08.17
 * Time: 15:46
 */
namespace reception\helpers;

class TypeOfDocsHelper {

    public static function getTypeOfDocs($type) : string
    {
        switch ($type) {

            case "027" :  return  "Osobna iskaznica (strana)";
            case "032" :  return  "Vozačka dozvola (strana)";
            case "002" :  return  "Osobna putovnica (strana)";
            case "051" :  return  "Osobna iskaznica (domaća)";
            case "999" :  return  "Zdrastvena iskaznica";
            case "037" :  return  "Službena putovnica (domaća)";
            case "033" :  return  "Dječja putovnica (domaća))";
            case "103" :  return  "Vozačka dozvola (domaća)";
            case "004" :  return  "Zajednička putovnica (strana)";
            case "003" :  return  "Obiteljska putovnica (strana)";
            case "005" :  return  "Dječja putovnica (strana)";
            case "006" :  return  "Diplomatska putovnica (strana)";
            case "007" :  return  "Službena putovnica (strana)";
            case "008" :  return  "Pomorska knjižica (strana)";
            case "009" :  return  "Brodarska knjižica (strana)";
            case "011" :  return  "Putni list za strance - izdan od RH";
            case "012" :  return  "Putna isprava za izbjeglice";
            case "013" :  return  "Putna isprava za osobe bez državljanstva";
            case "022" :  return  "Potvrda o oduzimanju ili zadržavanju putne isprave";
            case "023" :  return  "Potvrda o prijavi gubitka ili nestanka putne isprave";
            case "024" :  return  "Osobna iskaznica za stranca - izdana od RH";
            case "025" :  return  "Posebna osobna iskaznica - diplomatska konzularna službena";
            case "026" :  return  "Isprave izdane na temelju međ. ugovora";
            case "029" :  return  "Pogranična propusnica (strana)";
            case "030" :  return  "Izbjeglički karton izdan od RH";
            case "034" :  return  "Putni list za strance (strani)";
                
                
        }
    }
   

    public static function getTypeOfDocsNameList():array
    {
        return [
            "027"=> "Osobna iskaznica (strana)",
            "032"=> "Vozačka dozvola (strana)",
            "002"=> "Osobna putovnica (strana)",
            "051"=> "Osobna iskaznica (domaća)",
            "999"=> "Zdrastvena iskaznica",
            "037"=> "Službena putovnica (domaća)",
            "033"=> "Dječja putovnica (domaća))",
            "103"=> "Vozačka dozvola (domaća)",
            "004"=> "Zajednička putovnica (strana)",
            "003"=> "Obiteljska putovnica (strana)",
            "005"=> "Dječja putovnica (strana)",
            "006"=> "Diplomatska putovnica (strana)",
            "007"=> "Službena putovnica (strana)",
            "008"=> "Pomorska knjižica (strana)",
            "009"=> "Brodarska knjižica (strana)",
            "011"=> "Putni list za strance - izdan od RH",
            "012"=> "Putna isprava za izbjeglice",
            "013"=> "Putna isprava za osobe bez državljanstva",
            "022"=> "Potvrda o oduzimanju ili zadržavanju putne isprave",
            "023"=> "Potvrda o prijavi gubitka ili nestanka putne isprave",
            "024"=> "Osobna iskaznica za stranca - izdana od RH",
            "025"=> "Posebna osobna iskaznica - diplomatska konzularna službena",
            "026"=> "Isprave izdane na temelju međ. ugovora",
            "029"=> "Pogranična propusnica (strana)",
            "030"=> "Izbjeglički karton izdan od RH",
            "034"=> "Putni list za strance (strani)"
        ];
    }

}


        
    