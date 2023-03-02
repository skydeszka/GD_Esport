<?php

    function RandomString($length, $prefix = '', $suffix = '', $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string{

        if(strlen($characters) < 2)
            throw new Exception("There must be more than one avaiable characters.\n$characters");

        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $prefix . $randomString . $suffix;
    }

    function SanitizeQuotes($string): string{
        $halfclean = str_replace('"', '\\"', $string);
        $clean = str_replace("'", "\\'", $halfclean);

        return $clean;
    }

    function ToString(bool $boolean, string $true = "true", string $false = "false"): bool{
        return $boolean ? $true : $false;
    }

    function GetURL(): string{
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }
        return $protocol . "://" . $_SERVER['HTTP_HOST'];
    }

    function ConvertCounty(string $county): string {
        switch($county){

            case "budapest":
                return "Budapest";
            case "bacskiskun":
                return "Bács-Kiskun";
            case "bekes":
                return "Békés";
            case "borsodabaujzemplen":
                return "Borsod-Abaúj-Zemplén";
            case "csongrad":
                return "Csongrád";
            case "fejer":
                return "Fejér";
            case "gyormosonsopron":
                return "Győr-Moson-Sopron";
            case "hajdubihar":
                return "Hajdú-Bihar";
            case "heves":
                return "Heves";
            case "jasznagykunszolnok":
                return "Jász-Nagykun-Szolnok";
            case "komaromesztergom":
                return "Komárom-Esztergom";
            case "nograd":
                return "Nógrád";
            case "pest":
                return "Pest";
            case "somogy":
                return "Somogy";
            case "szabolcsszatmarbereg":
                return "Szabolcs-Szatmár-Bereg";
            case "tolna":
                return "Tolna";
            case "vas":
                return "Vas";
            case "veszprem":
                return "Veszprém";
            case "zala":
                return "Zala";
            case "baranya":
                return "Baranya";

        }
    }

?>