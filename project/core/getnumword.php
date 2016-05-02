<?php
//echo
 $_SESSION['nwords']  = array(  "", "One", "Two", "Three", "Four", "Five", "Six", 
	      	  "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
	      	  "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
	     	  "Nineteen", "Twenty", 30 => "Thirty", 40 => "Forty",
                     50 => "Fifty", 60 => "Sixty", 70 => "Seventy", 80 => "Eighty",
                     90 => "Ninety" );

$m=0;
 $_SESSION['count_m'] =0;

 
function number_to_words ($x)
{
  
	  
     if(!is_numeric($x))
     {
         $w = '#';
     }else if(fmod($x, 1) != 0)
     {
         $w = '#';
     }else{
         if($x < 0)
         {
             $w = 'minus ';
             $x = -$x;
         }else{
             $w = '';
         }
         if($x < 21)
         {
             $w .= $_SESSION['nwords'][$x];
         }else if($x < 100)
         {
             $w .= $_SESSION['nwords'][10 * floor($x/10)];
             $r = fmod($x, 10);
             if($r > 0)
             {
                 $w .= ' '. $_SESSION['nwords'][$r];
             }
         } else if($x < 1000)
         {
		
             	$w .= $_SESSION['nwords'][floor($x/100)] .' Hundred';
             $r = fmod($x, 100);
             if($r > 0)
             {
                 $w .= ' '. number_to_words($r);
             }
         } else if($x < 100000)
         {
         	$w .= number_to_words(floor($x/1000)) .' Thousand';
             $r = fmod($x, 1000);
             if($r > 0)
             {
                 $w .= ' ';
                 if($r < 100)
                 {
                     $w .= ' ';
                 }
                 $w .= number_to_words($r);
             }
         } 
		  else if($x < 10000000)
         {
         	$w .= number_to_words(floor($x/100000)) .' Lakh';
             $r = fmod($x, 100000);
             if($r > 0)
             {
                 $w .= ' ';
                 if($r < 100)
                 {
                     $w .= ' ';
                 }
                 $w .= number_to_words($r);
             }
         }
		 else //if($x < 1000000000)
         {
         	$w .= number_to_words(floor($x/10000000)) .' Crore';
             $r = fmod($x, 10000000);
             if($r > 0)
             {
                 $w .= ' ';
                 if($r < 100)
                 {
                     $w .= ' ';
                 }
                 $w .= number_to_words($r);
             }
         } /* else {
             $w .= number_to_words(floor($x/1000000000)) .' Billian';
             $r = fmod($x, 1000000000);
             if($r > 0)
             {
                 $w .= ' ';
                 if($r < 100)
                 {
                     $word .= ' ';
                 }
                 $w .= number_to_words($r);
             }
         } */
     }
     return $w;
}
 
function getNumber($input_value)
{
 $g_space='';
$nums='';
$digits='';

	//$input_value='22332.89';
	$value=explode('.',$input_value);
 
	 $tens_arr=array(20,30,40,50,60,70,80,90);
	if(!empty($value[0]))
	{
		$nums=str_ireplace("  "," ",number_to_words(trim($value[0])));
		$last_two_nums=substr($value[0],-2);
		$nums_arr=explode(" ",$nums);
		$num="";
		$counter=0;
		if(($last_two_nums<=20 & $last_two_nums!=0  && $input_value>100) or in_array($last_two_nums,$tens_arr))
		{
				for($i=0;$i<count($nums_arr)-1;$i++)
				{
				$num.=$nums_arr[$i]." ";$counter++;
				}
			
			$num.=" and ";
			$num.=$nums_arr[$counter]." ";
		}
		else if($last_two_nums>20 & $last_two_nums!=0 && $input_value>100)
		{
			for($i=0;$i<count($nums_arr)-2;$i++)
				{
				$num.=$nums_arr[$i]." ";$counter++;
				}
			
			$num.=" and ";
			$num.=$nums_arr[$counter]." ";
			$num.=$nums_arr[$counter+1]." ";
		}
		else
		{
		$num=$nums;
		}
	}
		
	if(!empty($value[1]) && ($value[1]>0))
	{
 
	$digits=' and '.number_to_words(intval(trim($value[1]))) .' Paisa';
	}
	$num=str_ireplace("  "," ",$num);
	return $num.$digits." Only ";;
}	
     

function picture($input_num,$format)
{
 



$_SESSION['count_m']=0;
 $num='';
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
 
function roundOff($value,$type)
{
 
	switch($type)
	{
		
	case 'Nearest Paise':
		return round($value,2); 
	break;
	
	case 'Nearest Rupee':
		return round($value); 
	break;
	
	case 'Nearest Lower Rupee':
		return floor($value); 
	break;
	
	case 'Nearest Higher Rupee':
		return ceil($value); 
	break;
	
	case 'Nearest 10 Rupee':
		return round($value,-1);  
	break;
	
	case 'Nearest 100 Rupee':
	return round($value,-2); 
	break;
	
	default :
	return $value; 
	break;

	}
	
} 
?>