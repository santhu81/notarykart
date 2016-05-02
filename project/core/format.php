<?php
function encryptData( $q ) {
    $cryptKey  = '#N@v!n#';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

function decryptData( $q ) {
    $cryptKey  = '#N@v!n#';
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}

function db_date_Format($date)
{
		$FromDate_exp=explode("-",$date);
		$date=$FromDate_exp[2]."-".$FromDate_exp[1]."-".$FromDate_exp[0];
		return $date;
}
function DBDateFormatBySlash($date)
{
		$FromDate_exp=explode("/",$date);
		$date=$FromDate_exp[2]."-".$FromDate_exp[1]."-".$FromDate_exp[0];
		return $date;
}
function getHostDomain()
{
		$main_src_obj=(explode("/",$_SERVER["REQUEST_URI"]));
		$main_src=$main_src_obj[1];
		return $main_src;
}
function GetDbDateFormatFromExcel($date_str)
{
 
	$month_arr=array('jan'=>'01','feb'=>'02','mar'=>'03','apr'=>'04',
					'may'=>'05','jun'=>'06','jul'=>'07','aug'=>'08','sep'=>'09',
					'oct'=>'10','nov'=>'11','dec'=>'12');
				 
	if(empty($date_str))
	$db_date='0000-00-00';
	$pattern = "/[\/]+/";	 
		if(preg_match($pattern,$date_str))//if they have given dd/mm/yy
		{
		$date_obj=explode("/",$date_str);
		$year=$date_obj[2];
		$month=substr("0".$date_obj[1],-2);
		$day=substr("0".$date_obj[0],-2);
		$db_date=$year.'-'.$month.'-'.$day;
		}
	else//if they have given in 01-jun-1980
	{
		$date_obj=explode("-",$date_str);
			if(count($date_obj)!=3)
				$db_date='0000-00-00';
			else
			{
				$year_id=$date_obj[2];
				$pattern = "/^[a-zA-Z]*$/";
				if(preg_match($pattern,$date_obj[0]))
				{				
				$month_name=strtolower($date_obj[0]);
				$month_id=$month_arr[$month_name];
				$day=substr("0".$date_obj[1],-2);
				}
				else
				{
				$month_name=strtolower($date_obj[1]);
				$month_id=$month_arr[$month_name];
				$day=substr("0".$date_obj[0],-2);
				}
				$db_date=$year_id.'-'.$month_id.'-'.$day;
			}	
	} 
	 
	return $db_date;
}
function ui_date_Format($date)
{

		$FromDate_exp=explode("-",$date);
		$date=$FromDate_exp[2]."/".$FromDate_exp[1]."/".$FromDate_exp[0];
		 return $date;
}  
 function get_months($Start_date,$End_date)
 {     
   $time1  = strtotime($Start_date);
   $time2  = strtotime($End_date);
   $my     = date('mY', $time2);

   $months = array(date('F', $time1));

   while($time1 < $time2) {
      $time1 = strtotime(date('Y-m-d', $time1).' +1 month');
      if(date('mY', $time1) != $my && ($time1 < $time2))
         $months[] = date('F', $time1);
   }

   $months[] = date('F', $time2);
   return $months;   
} function get_months_year($Start_date,$End_date,$month_type='full')
 {     
	if($month_type=='full')
	$month_name="F";
	else
	$month_name="M";
   $time1  = strtotime($Start_date);
   $time2  = strtotime($End_date);
   $my     = date('mY', $time2);

   $months = array(date("{$month_name}-y", $time1));

   while($time1 < $time2) {
      $time1 = strtotime(date('Y-m-d', $time1).' +1 month');
      if(date('mY', $time1) != $my && ($time1 < $time2))
         $months[] = date("{$month_name}-y", $time1);
   }

   $months[] = date("{$month_name}-y", $time2);
   return $months;   
}

function get_rand_letters($length)
{
  if($length>0) 
  { 
  $rand_id="";
   for($i=1; $i<=$length; $i++)
   {
   mt_srand((double)microtime() * 1000000);
   $num = mt_rand(1,26);
   $rand_id .= assign_rand_value($num);
   }
  }
return $rand_id;
}
function assign_rand_value($num)
{
// accepts 1 - 36
  switch($num)
  {
    case "1":
     $rand_value = "a";
    break;
    case "2":
     $rand_value = "b";
    break;
    case "3":
     $rand_value = "c";
    break;
    case "4":
     $rand_value = "d";
    break;
    case "5":
     $rand_value = "e";
    break;
    case "6":
     $rand_value = "f";
    break;
    case "7":
     $rand_value = "g";
    break;
    case "8":
     $rand_value = "h";
    break;
    case "9":
     $rand_value = "i";
    break;
    case "10":
     $rand_value = "j";
    break;
    case "11":
     $rand_value = "k";
    break;
    case "12":
     $rand_value = "l";
    break;
    case "13":
     $rand_value = "m";
    break;
    case "14":
     $rand_value = "n";
    break;
    case "15":
     $rand_value = "o";
    break;
    case "16":
     $rand_value = "p";
    break;
    case "17":
     $rand_value = "q";
    break;
    case "18":
     $rand_value = "r";
    break;
    case "19":
     $rand_value = "s";
    break;
    case "20":
     $rand_value = "t";
    break;
    case "21":
     $rand_value = "u";
    break;
    case "22":
     $rand_value = "v";
    break;
    case "23":
     $rand_value = "w";
    break;
    case "24":
     $rand_value = "x";
    break;
    case "25":
     $rand_value = "y";
    break;
    case "26":
     $rand_value = "z";
    break;
    case "27":
     $rand_value = "0";
    break;
    case "28":
     $rand_value = "1";
    break;
    case "29":
     $rand_value = "2";
    break;
    case "30":
     $rand_value = "3";
    break;
    case "31":
     $rand_value = "4";
    break;
    case "32":
     $rand_value = "5";
    break;
    case "33":
     $rand_value = "6";
    break;
    case "34":
     $rand_value = "7";
    break;
    case "35":
     $rand_value = "8";
    break;
    case "36":
     $rand_value = "9";
    break;
  }
return $rand_value;
}
function getMonthDiff($m1,$y1,$m2,$y2)
	{
		$no=0;
		$year  = $y2 - $y1; 
		if ($year == 0)
		{
			$mnth = $m2 - $m1 ; 
		}
		if( $year >= 1)
		{
			$m1 = 12 - $m1;
			$mul_months = 12 * ($year-1);
			$mnth = $m1 + $m2 + $mul_months;
		}
		$no = $mnth;
		return $no + 1;
	}
function getOnMonthBackdate($date)
{
$month_arr=explode("-",$date);
$year=$month_arr[0];
$month=$month_arr[1];
$day=$month_arr[2];
if($month=='1')
{
return ($year-1)."-12-".$day;
}
else
{
$month_id=substr("0".($month-1),-2);
return ($year)."-".($month_id)."-".$day;
}
}
 function getMonthNamesBYId($month_id)
 {
	if($month_id== '01' or $month_id== '1') return "Jan";
	if($month_id== '02' or $month_id== '2') return "Feb";
	if($month_id== '03' or $month_id== '3') return "Mar";
	if($month_id== '04' or $month_id== '4') return "Apr";
	if($month_id== '05' or $month_id== '5') return "May";
	if($month_id== '06' or $month_id== '6') return "Jun";
	if($month_id== '07' or $month_id== '7') return "Jul";
	if($month_id== '08' or $month_id== '8') return "Aug";
	if($month_id== '09' or $month_id== '9') return "Sep";
	if($month_id== '10' ) return "Oct";
	if($month_id== '11' ) return "Nov";
	if($month_id== '12' ) return "Dec";
	
 }function getMonthIdsBYName($month_name)
 {
		$month_id_arr=array(
						"january"=>"01",
						"jan"=>"01",
						"february"=>"02",
						"feb"=>"02",
						"march"=>"03",
						"mar"=>"03",
						"april"=>"04",
						"apr"=>"04",
						"may"=>"05",
						"june"=>"06",
						"jun"=>"06",
						"july"=>"07",
						"jul"=>"07",
						"august"=>"08",
						"augu"=>"08",
						"september"=>"09",
						"sep"=>"09",
						"october"=>10,
						"oct"=>10,
						"november"=>11,
						"nov"=>11,
						"december"=>12,
						"dec"=>12,
						 
					); 
		$month_name=strtolower($month_name);
		return 	$month_id_arr[$month_name];		
	
 }
 function get_time_difference( $start, $end )
{
    $uts['start']      =    strtotime( $start );
    $uts['end']        =    strtotime( $end );
    if( $uts['start']!==-1 && $uts['end']!==-1 )
    {
        if( $uts['end'] >= $uts['start'] )
        {
            $diff    =    $uts['end'] - $uts['start'];
            if( $days=intval((floor($diff/86400))) )
                $diff = $diff % 86400;
            if( $hours=intval((floor($diff/3600))) )
                $diff = $diff % 3600;
            if( $minutes=intval((floor($diff/60))) )
                $diff = $diff % 60;
            $diff    =    intval( $diff );            
            return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );
        }
        else
        {
            trigger_error( "Ending date/time is earlier than the start date/time", E_USER_WARNING );
        }
    }
    else
    {
        trigger_error( "Invalid date/time data detected", E_USER_WARNING );
    }
    return( false );
}

function GetDecimalNumber($number,$decimal)
{
	$decimal_number = number_format((float)$number, $decimal, '.', '');
	return  $decimal_number;
}

function DecodeFormData($str)
{
	return base64_decode($str);
}
function RandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < $length; $i++) {
        $randstring.= $characters[rand(0, strlen($characters))];
    }
	
    return $randstring;
}

function RandomNumbers($length)
{
    $characters = '0123456789';
    $randstring = '';
    for ($i = 0; $i < $length; $i++) {
        $randstring.= $characters[rand(0, strlen($characters))];
    }
	
    return $randstring;
}

 function object_to_array($data) 
	{
	if ((! is_array($data)) and (! is_object($data))) return 'xxx'; //$data;

		$result = array();

		$data = (array) $data;
		foreach ($data as $key => $value) {
			if (is_object($value)) $value = (array)(($value));
			if (is_array($value)) 
			$result[$key] = object_to_array($value);
			else
			$result[$key] = $value;
		}return $result;
	}
	
	
function picture($input_num,$format)
{
	$_SESSION['count_m']=0;
	$num=str_replace(',','',$input_num);
	$pos=1;
	$g_space;
	$final_val='';
	$final_dot_val='';
	$point_value='';
	$dot_num_first=explode('.',$num);
	$dot_format=explode('.',$format);
	if(!empty($dot_num_first[1]) && !empty($dot_format[1]))
	{
		$len=strlen($dot_format[1]);
		$num= round($num,$len); 
	}
	
	$dot_num=explode('.',$num);
	$dot_num_space=str_replace(',','',$dot_num[0]);
	if(empty($dot_num[1]))
	{
		for($j=0;$j<strlen($dot_format[1]);$j++)
		{
		$dot_num[1].='0';
		}
	}
	else if(strlen($dot_num[1])<>strlen($dot_format[1]))
	{
		$exsting_vaue=$dot_num[1];
		$fill_zero=strlen($dot_format[1])-strlen($dot_num[1]);
		for($n=0;$n<$fill_zero;$n++)
		{
			$exsting_vaue.='0';
		}
		$dot_num[1]=$exsting_vaue;
	}
	$dot_format_space=str_replace(',','',$dot_format[0]);
	$space_length=strlen($dot_format_space)-strlen($dot_num_space);
	
	$star_length=strlen($dot_num_space)-strlen($dot_format_space);
	$comma_count=explode(',',$dot_format[0]);
		 
	if($star_length>0)
	{
		for($n=0;$n<count($comma_count);$n++)
		{
			for($star=0;$star<strlen($comma_count[$n]);$star++)
			{
			$final_val.='*';
			}
			if($n!=count($comma_count)-1)
				{
				$final_val.=',';
				}
		} 
		$final_val.='.';
		for($star_dot=0;$star_dot<strlen($dot_format[1]);$star_dot++)
		{
			$final_val.='*';
		} 
	}
	else
	{
	   if($space_length>0)
	   {
		   for($splen=0;$splen<$space_length;$splen++)
		   {
			$g_space.='s';
		   }
	   }
 
		for($i=count($comma_count)-1;$i>=0;$i--)
		{
			//global $m;
			$cnt=strlen($comma_count[$i]);
			$to_indx=$cnt;
			if(strlen($dot_num[0])<=$cnt){
				$start_pos=0;
			}
			else{
				$start_pos=(strlen($dot_num[0])-$to_indx) ;
			}
			if($start_pos<=0)
				$pos=0;
			 
			$value[$_SESSION['count_m']]=substr($dot_num[0],$start_pos,$cnt);
			 
			if($pos>=1)
			{
				$dot_num[0]=substr($dot_num[0],0,(strlen($dot_num[0])-$to_indx));
			}
			else
			{
				$dot_num[0]=substr($dot_num[0],0,0);
			}
			 
			$_SESSION['count_m']++;
		}
		if(!empty($dot_num[0]))
		$value[$_SESSION['count_m']]=$dot_num[0];
	 
	}
	for($v=count($value);$v>=0;$v--)
	{
		if($v==count($value) || $v==0)
			$final_val.=$value[$v];
		else
			$final_val.=$value[$v].',';
	}
	$final_val=str_replace(',,','',$final_val);
	if(substr($final_val, -1, 1)==',')
	{
		$final_val=substr($final_val, 0, strlen($final_val)-1);
	}
	if(substr($final_val, 0, 1)==',')
	{
		$final_val=substr($final_val, 1, strlen($final_val));
	}
	//echo $g_space.str_replace(',,','',$final_val).'.'.$dot_num[1];

	
	$value=str_replace('-,','-',$final_val).'.'.$dot_num[1];

	 //echo $value; 
	if($value=='0' || $value=='0.00')
		return '0.00';
	else 
		return $value;
}
?>