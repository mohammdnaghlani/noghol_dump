<?php
// output function
function myDump($values = null)
{

     $address =  debug_backtrace() ;

     $file = $address[0]['file'] ;

     $line = $address[0]['line'] ;

     $address_output = '<code style="font_size = 10px">' .PHP_EOL ;

     $address_output .= $file . ' : ' . $line . PHP_EOL ;

     $address_output .= '</code><br>' . PHP_EOL ;

     $debug = noghol_debug($values);

     echo  $address_output  . $debug;

}
// checker All function
function noghol_debug($values = null)
{

    $get_info =null ;
   
    $temp = null;

    $empty_alert = '<code style="padding-left:10px;font-size:11px;color:rgba(150,150,150,.8)">empty</code>' ; 
    
    $temp .= get_bool_or_null($values) ;

    if(is_array($values)){

        $get_info .= get_information($values) ;

        if(!empty($values)){

            $temp .= checkArray($values);

        }else{

            $temp .= $empty_alert  ;

        }

    }else if(is_object($values)){

        $get_info .= get_information($values) ;

        if(!empty($values)){

            $temp .= checkObject($values);

        }else{

            $temp .= $empty_alert  ;

        }

    }else if (gettype($values) == 'string') {

        $temp .= chekString($values) ;

    } else if (gettype($values) == 'integer') {

        $temp .= checkInteger($values) ;

    }else if(gettype($values) == 'double' || gettype($values) == 'float'){
        echo checkFloat($values) ;
    }

    return   $get_info . '<br>'. $temp ;

}

//checker Object value
function checkObject($value)
{
    $temp = null ;

    if(is_object($value)){

        foreach($value as $key => $val){

            if(is_object($val)){

                $temp .= "<code  style='font_size : 11px;margin-left:10px' >  '" . $key . "' =></code>" . PHP_EOL;
                
                $temp .= '<div style="margin-left:30px" >' . PHP_EOL;
               
                $temp .= noghol_debug($val) ;
               
                $temp .= '</div>' . PHP_EOL;
            
            }else if(is_array($val)){
               
                $temp .= "<code  style='font_size : 11px;margin-left:10px' >  '" . $key . "' =></code>" . PHP_EOL;
              
                $temp .= '<div style="margin-left:30px" >' . PHP_EOL;
               
                $temp .= noghol_debug($val) ;
               
                $temp .= '</div>' . PHP_EOL;
           
            }else{
               
                $temp .= "<code  style='font_size : 11px' >  '" . $key . "' =></code>" . PHP_EOL;
                
               
                if (gettype($val) == 'string') {
                   
                    $temp .= '<code style="font_size: 10px">strint </code>';
                   
                    $temp .= "<code  style='font_size: 9px ; color:red '>" . PHP_EOL;
                   
                    $temp .= "'{$val}'" . PHP_EOL;
                   
                    $temp .= "</code>";
                   
                    $temp .= '<code style="font_size: 10px">' . PHP_EOL;
                   
                    $temp .= '(length=' . strlen($val) . ')' . PHP_EOL;
                   
                    $temp .= "</code><br>" . PHP_EOL;
               
                } else if (gettype($val) == 'integer') {
                   
                    $temp .= '<code style="font_size: 10px">int </code>';
                   
                    $temp .= "<code  style='font_size: 9px ; color:green '>" . PHP_EOL;
                   
                    $temp .= "{$val}" . PHP_EOL;
                   
                    $temp .= "</code><br>";
              
                }else if(gettype($val) == 'boolean'){
                    $temp .= '<code style="font_size: 10px">boolean </code>';
                   
                    $temp .= "<code  style='font_size: 9px ; color:#75507b '>" . PHP_EOL ;
                   
                    $temp .= $val == true ? 'true' : 'false' . PHP_EOL;
                    
                    $temp .= "</code><br>"; 
                }else if(gettype($val) == 'NULL'){
                   
                    $temp .= "<code  style='font_size: 9px ; color:#3465a4 '>" . PHP_EOL ;
                   
                    $temp .=  'null' . PHP_EOL;
                    
                    $temp .= "</code><br>"; 
                } else if (gettype($val) == 'double' || gettype($val) == 'float') {
                   
                    $temp .= '<code style="font_size: 10px">float</code>';
                   
                    $temp .= "<code  style='font_size: 9px ; color:#f57900 '>" . PHP_EOL;
                   
                    $temp .= "{$val}" . PHP_EOL;
                   
                    $temp .= "</code><br>";
              
                }
           
            }
       
        }
   
    }
   
    return  $temp ;
}
// checker array value
function checkArray($values)
{
    $temp = null ;

    if(is_array($values)){
       
        foreach($values as $key => $value){           
           
            if(is_array($value)){               
             
                $temp .= "<code  style=\"font_size : 11px ;margin-left:10px\" > '" . $key . "'=> </code> " . PHP_EOL  ;
              
                $temp .= '<br>' . PHP_EOL ;
               
                $temp .= '<div style="margin-left:30px" >' . PHP_EOL;
               
                $temp .= noghol_debug($value);
               
                $temp .= '<br>' .PHP_EOL  ;
               
                $temp .= '</div>' ;
           
            }else{                
               
                $temp .= '<code  style="font_size : 11px" > ' . $key . '=> </code> ' . PHP_EOL;                
               
                if( gettype($value) == 'string'){
                   
                    $temp .= '<code style="font_size: 10px">strint </code>';
                   
                    $temp .= "<code  style='font_size: 9px ; color:red '>" . PHP_EOL ;
                  
                    $temp .= "'{$value}'" . PHP_EOL;
                   
                    $temp .= "</code>";
                   
                    $temp .= '<code style="font_size: 10px">' . PHP_EOL ;
                   
                    $temp .= '(length=' . strlen($value) .')' . PHP_EOL ;
                   
                    $temp .= "</code>" . PHP_EOL;
               
                } else if (gettype($value) == 'integer') {
                   
                    $temp .= '<code style="font_size: 10px">int </code>';
                   
                    $temp .= "<code  style='font_size: 9px ; color:green '>" . PHP_EOL ;
                   
                    $temp .= "{$value}" . PHP_EOL;
                    
                    $temp .= "</code>";
                
                }else if(gettype($value) == 'boolean'){
                    $temp .= '<code style="font_size: 10px">boolean </code>';
                   
                    $temp .= "<code  style='font_size: 9px ; color:#75507b '>" . PHP_EOL ;
                   
                    $temp .= $value == true ? 'true' : 'false' . PHP_EOL;
                    
                    $temp .= "</code>"; 
                }else if(gettype($value) == 'NULL'){
                   
                    $temp .= "<code  style='font_size: 9px ; color:#3465a4 '>" . PHP_EOL ;
                   
                    $temp .=  'null' . PHP_EOL;
                    
                    $temp .= "</code>"; 
                }else if (gettype($value) == 'double' || gettype($value) == 'float') {
                   
                    $temp .= '<code style="font_size: 10px">float</code>';
                   
                    $temp .= "<code  style='font_size: 9px ; color:#f57900 '>" . PHP_EOL;
                   
                    $temp .= "{$value}" . PHP_EOL;
                   
                    $temp .= "</code>";
              
                }
                
                
                $temp .=  '<br>' ;
           
            }

       
        }
   
    }
    
   
    return $temp ;

}
//checker string value .
function chekString($value)
{

    $temp = '<code style="font_size: 10px">strint </code>';

    $temp .= "<code  style='font_size: 9px ; color:red '>" . PHP_EOL;

    $temp .= "'{$value}'" . PHP_EOL;

    $temp .= "</code>";

    $temp .= '<code style="font_size: 10px">' . PHP_EOL;

    $temp .= '(length=' . strlen($value) . ')' . PHP_EOL;

    $temp .= "</code>" . PHP_EOL;

    return $temp ;

}
//checker integer value.
function checkInteger($value)
{
    $temp = '<code style="font_size: 10px">int </code>';

    $temp .= "<code  style='font_size: 9px ; color:green '>" . PHP_EOL;

    $temp .= "{$value}" . PHP_EOL;

    $temp .= "</code>";

    return $temp ;

}
//checker float or double value.
function checkFloat($value){
    $temp = '<code style="font_size: 10px">double</code>';

    $temp .= "<code  style='font_size: 9px ; color:#f57900 '>" . PHP_EOL;

    $temp .= "{$value}" . PHP_EOL;

    $temp .= "</code>";

    return $temp ;
}
//get type object or array keys 
function get_information($value)
{
    $get_info = null ;

    $get_size = null ;

    $get_type = '<code  style="font_size : 10px ; font-weight : bolder" > ' . gettype($value) . PHP_EOL;

    if(gettype($value) == 'array'){
       
        $get_size =  '<code style = "font-size : 11px !important;font-weight :400">(size= ' . count($value) . ')</code>';
   
    }else if (gettype($value) == 'object') {
       
        $get_size =  '<code style = "font-size : 11px !important;font-weight :800">(StdClass)</code>';
    
    }

    $get_type .=  '</code>';
    
    $get_info  = $get_type . $get_size;
    
    return $get_info ;

}
//get type true or fasle or null  
function get_bool_or_null($value)
{
    $temp = null ;

    if(is_null($value)){

        $temp .= "<code  style='font_size: 9px ; color:#3465a4 '>" . PHP_EOL ;
                   
        $temp .=  'null' . PHP_EOL;
        
        $temp .= "</code><br>"; 

    }else if(is_bool($value)){
        $temp .= '<code style="font_size: 10px">boolean </code>';
                   
        $temp .= "<code  style='font_size: 9px ; color:#75507b '>" . PHP_EOL ;
       
        $temp .= $value == true ? 'true' : 'false' . PHP_EOL;
        
        $temp .= "</code><br>";
    
    }

    return $temp ;
}

/* use */
$val =['mohammad', 'naghlani', 120 ,"test" => [] , ['a','b',[1,2,3] , 1.1] ,true ,false , null];
$val1 = (object) $val ;
$val2 = (object) $val[3][2] ;
$ob = [$val2 , 124, $val1];
$ob = (object) $ob ; 
//------------------------------------
echo 'myDump Function : <br>';
myDump($ob);
//-------------------------------------
echo 'var_dump Function : <br>';
var_dump($ob);
