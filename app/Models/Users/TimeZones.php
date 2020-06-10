<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TimeZones extends Model
{

    public function getAll(){
        return DB::table('time_zones')
            ->select('time_zones.id', 'time_zones.timezone_name', 'time_zones.timezone_utc',
                'countries.name_ru', 'countries.iso_a2')
            ->leftJoin('countries', 'time_zones.country_id', '=', 'countries.id')
            ->whereNull(['countries.deleted_at', 'time_zones.deleted_at'])
            ->get();
    }
    public function countries(){
        return $this->hasOne(Countries::class, 'id', 'country_id');
    }
    public static function getTimeZones(){

        //<table class="wikitable sortable">
        //<h2><span id="

        print "<pre>";

        $url = "https://ru.wikipedia.org/wiki/Список_часовых_поясов_по_странам";
        $ch = curl_init();

        // отправка запроса
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_URL, $url);

        $result = curl_exec($ch);

        //print $result;

//        preg_match('/(?<=\<table class=\"wikitable sortable\">)[^$]{1,65000}?(?=\<h2><span id=)/', $result, $match_table);
        preg_match_all('/(?<=<tr>)[^$]{1,65000}?(?=<\/tr>)/', $result, $match_table);

        $start = 44;
        $stop = 240;

        print "<table>";

        print "<tr>
                    <td style='width: 5%;'>№</td>
                    <td style='width: 20%;'>Страна</td>
                    <td style='width: 5%;'>Количество часовых поясов</td>
                    <td>Список часовых поясов в стране</td>
                    <td style='width: 10%;'>Примечания</td>
               </tr>";

        DB::beginTransaction();

        for($i = $start; $i <= $stop; $i++){

            if(isset($match_table[0][$i])){

//                print "<tr id='{$i}'>" . $match_table[0][$i] . "</tr>";
                print "<tr id='{$i}'>\r\n";

                preg_match_all('/(?<=<td>)[^$]{1,30000}?(?=<\/td>)/', $match_table[0][$i], $match_tds);

                if(isset($match_tds[0])){

                    // Вытаскиваем имя страны
                    preg_match('/(?<=<span class="wrap">)[^$]{1,500}?(?=<\/span>)/', $match_tds[0][0], $match_name_country);

                    if(isset($match_name_country[0])) {

                        //$new_timezone = new TimeZones();
                        $country = Countries::get([
                            ['name_ru', '=', trim(strip_tags($match_name_country[0]))]
                        ]);

                        if (isset($country[0])) {

                            print "<td>{$i}</td>\r\n";
                            print "<td>{$match_name_country[0]}</td>\r\n";
                            print "<td>{$match_tds[0][1]}</td>\r\n";

                            // Разбиваем строки по <br />
                            $strings_utc_cities = explode("<br />", $match_tds[0][2]);

                            print "<td>\r\n";

                            foreach ($strings_utc_cities as $city) {

                                // Вытаскиваем и групируем имена часовых поясов
                                preg_match('/(?<=<a)[^$]{1,1500}?(?=<\/a>)/', $city, $match_utcs);

                                if (isset($match_utcs[0])) {

                                    $utc_name = strip_tags("<a" . $match_utcs[0] . "</a>");

                                }

                                $all_strung = trim(str_replace($utc_name, "", str_replace("&#160;", "", str_replace("&#160;—", '', strip_tags($city)))));

                                if($start == 45){

                                    preg_match('/(?<=\()[^$]{1,1500}?(?=\))/', $all_strung, $match_moscow);
                                    $replace_all_string = isset($match_moscow[0]) ? $match_moscow[0] : false;

                                }else{

                                    $replace_all_string = ucfirst(
                                        str_replace('()', '',
                                            preg_replace('/(?<=\()[^$]{1,1500}?(?=\))/', '', $all_strung)
                                        )
                                    );

                                }

                                $explode_replace_all_string = explode(',', $replace_all_string);

                                if(count($explode_replace_all_string) > 0) {

                                    foreach ($explode_replace_all_string as $name_city) {

                                        $new_time_zone = new TimeZones();

                                        $new_time_zone->country_id = $country[0]->id;
                                        $new_time_zone->timezone_name = trim(ucfirst($name_city));
                                        $new_time_zone->timezone_utc = str_replace("−", "-", $utc_name);
                                        $new_time_zone->created_at = date("U");

                                        $new_time_zone->save();

                                    }

                                }else{

                                    $new_time_zone = new TimeZones();

                                    $new_time_zone->country_id = $country[0]->id;
                                    $new_time_zone->timezone_name = $replace_all_string;
                                    $new_time_zone->timezone_utc = str_replace("−", "-", $utc_name);
                                    $new_time_zone->created_at = date("U");

                                    $new_time_zone->save();

                                }

                            }

                            print "</td>\r\n";


        //                    print "<td>{$match_tds[0][0]}</td>";
        //                    print "<td>{$match_tds[0][1]}</td>";
        //                    print "<td>{$match_tds[0][2]}</td>";
        //                    print "<td>---</td>";


                            print "<td>---</td>\r\n";

                        }else{

                            print "Страна: " . trim(strip_tags($match_name_country[0])) . " - не найдена!";

                        }

                    }


                }

                print "</tr>\r\n";

            }

        }

        print "</table>";

        DB::commit();

    }

}
