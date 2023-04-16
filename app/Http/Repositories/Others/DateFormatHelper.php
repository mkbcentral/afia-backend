<?php
namespace App\Http\Repositories\Others;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class DateFormatHelper{
    //Formatter la date dd/mm/yyyy à Y-d-m
    public function formatDate($date){
        return Carbon::createFromFormat('d/m/Y',$date)->format('Y-m-d');
    }
    // Get Age of users
    public function getUserAge($date){
        $count_month=0;
        $age=date('Y') - Carbon::createFromFormat('Y-m-d', $date)->format('Y');
        if ($age==0) {
            $months=array();
            $month=Carbon::createFromFormat('Y-m-d', $date)->format('m');
            if ($month<10) {
                $month=ltrim($month, "0");
             }
            $current_month=date('m');
            if ($current_month<10) {
                $current_month=ltrim($current_month, "0");
             }
            for ($i=$month; $i <=$current_month ; $i++) {
                $months[$i]=$i;
            }
            $count_month=count($months);
            $days_numbers= cal_days_in_month(CAL_GREGORIAN, $month, date('Y'));
            if ($count_month == 1) {
                if ($days_numbers<31 OR $days_numbers<30) {
                    $day=Carbon::createFromFormat('Y-m-d', $date)->format('d');
                    $days=array();
                    if($day<9){
                        $day=ltrim($day,"0");
                    }
                    for ($i=$day; $i <= date('d'); $i++) {
                       $days[]=$i;
                    }
                    $days_count=count($days);

                    if ($days_count==7) {
                        return '1 Semaine' ;
                    } elseif($days_count==14) {
                        return '2 Semaines' ;
                    }elseif($days_count==21){
                        return '3 Semaines' ;
                    }elseif($days_count==28){
                        return '7 Semaines' ;
                    }else{
                        return $days_count==1?'1 Jour':$days_count." Jours" ;
                    }
                }

            }else{
                return $count_month.' Mois' ;
            }
        }else{
            return $age==1?$age.' An':$age.' Ans';
        }
    }
    //Get months of year
    public function getMonthsForYear():array{
        $months=[];
        foreach(range(1,12) as $month){
            $months[]=date('m',mktime(0,0,0,$month,1));
        }
        return $months;
    }
    //Get years aléatoires
    public function getYearsAleatoire():array{
        $years=[
            '2022',
            '2023',
            '2024',
            '2025',
            '2026',
            '2027',
            '2028',
            '2029',
            '2030'
        ];
        return $years;
    }
}
