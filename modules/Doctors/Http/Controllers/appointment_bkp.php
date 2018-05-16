<?php

public function appointment($slug){

    $data['doctor'] = Doctors::where('slug', $slug)->first();
    $data['schedule'] = Timetable::where('doctor_id',$data['doctor']->id)->select('start_date as start','end_date as end')->get()->toArray();
    $today = date('Y-m-d');
    if(count($data['schedule'])>0) {
        $unavailable = explode(' - ', $data['doctor']->unavailability_time);

        for ($i = 0; $i < count($data['schedule']); $i++) {
            $test[] = self::dateRange($data['schedule'][$i]['start'], $data['schedule'][$i]['end']);
        }

        $final_dates = array_values(array_unique(self::array_flatten($test)));

        for ($i = 0; $i < count($final_dates); $i++) {
            $date = date("Y-m-d", strtotime($final_dates[$i]));
            if($date > $today) {
                if (self::check_in_range($unavailable[0], $unavailable[1], $date)) {

                    $result[$i]['date'] = $date;
                    $result[$i]['badge'] = false;

                } else {
                    $result[$i]['date'] = $date;
                    $result[$i]['badge'] = true;
                }
            }else{
                $result[$i]['badge'] = false;
            }
        }

        $data['result'] = json_encode($result);
        dd($data['result']);

        return view('doctors::v_doctor_calender_zabuto', $data);
    }else{
        $data['alternates'] = Doctors::where('specialization_id',$data['doctor']->specialization_id)->where('id','!=',$data['doctor']->id)->get();
        $data['sp'] = Specializations::where('id',$data['doctor']->specialization_id)->select('slug','title')->first();
        Session::flash('no_schedule','Dr. '.$data['doctor']->full_name.' is not scheduled currently.');
        return view('doctors::v_doctor_alternative',$data);
    }

}