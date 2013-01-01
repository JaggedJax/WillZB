<?php
class helperFunctions{
	
	function __construct(){
		
	}
	
	/**
	* Print out a stack trace from entry point to wherever this function was called.
	* @param boolean $show_args Show arguments passed to functions? Default False.
	* @param boolean $for_web Format text for web? Default True.
	* @param boolean $return Return result instead of printing it? Default False.
	*/
   public static function stack_trace($show_args=false, $for_web=true, $return=false){
	   if ($for_web){
		   $before = '<b>';
		   $after = '</b>';
		   $tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
		   $newline = '<br>';
	   }
	   else{
		   $before = '<';
		   $after = '>';
		   $tab = "\t";
		   $newline = "\n";
	   }
	   $output = '';
	   $ignore_functions = array('include','include_once','require','require_once');
	   $backtrace = debug_backtrace();
	   $length = count($backtrace);

	   for ($i=0; $i<$length; $i++){
		   $function = $line = '';
		   $skip_args = false;
		   $caller = @$backtrace[$i+1]['function'];
		   // Display caller function (if not a require or include)
		   if(isset($caller) && !in_array($caller, $ignore_functions)){
			   $function = ' in function '.$before.$caller.$after;
		   }
		   else{
			   $skip_args = true;
		   }
		   $line = $before.@$backtrace[$i]['file'].$after.$function .' on line: '.$before.@$backtrace[$i]['line'].$after.$newline;
		   if ($i < $length-1){
			   if ($show_args && $backtrace[($i+1)]['args'] && !$skip_args){
				   $params = ($for_web) ? htmlentities(print_r($backtrace[($i+1)]['args'], true))
						   : print_r($backtrace[($i+1)]['args'], true);
				   $line .= $tab.'Called with params: '.preg_replace('/(\n)/',$newline.$tab,trim($params)).$newline.$tab.'By:'.$newline;
				   unset($params);
			   }
			   else{
				   $line .= $tab.'Called By:'.$newline;
			   }
		   }
		   if ($return){
			   $output .= $line;
		   }
		   else{
			   echo $line;
		   }
	   }
	   if ($return){
		   return $output;
	   }
   }
}
?>
