<?php

if( !class_exists('DBSession')){
    
    class DBSession{
         
         function __construct(){
            
              if( function_exists('session_start')){
                    session_start();
              }
              
              $item = array( 'item1' => array(
                                                  'cart1' => 'Bag 1',
                                                  'cart2' => 'Bag 2', 
                                              ),
                             'item2' => array( 
                                                  'cart1' => 'Shoe 1',
                                                  'cart2' => 'Shoe 2',                   
                                              )
                            );
                            
              $item_cart = $this->session_array('item', $item);
              
              print '<pre>';

              
              $get = $this->session_get('item', $item, 'item1');
              var_dump( $get );
              
         }
         
         /**
           * Session Variable 
           * Name (string) for session name 
         **/
         
         
         public function session($name=null){
            if( !is_null($name)){
                return !empty($_SESSION[$name]) ? $_SESSION[$name] : false;
            }
         }
         
         /**
           * Session Get 
           * Name (string)
           * Array (array)
           * Item Element (Array item exists)
         **/
         
         public function session_get($name=null, $item=array(), $item_elem=null){
            if( !is_null($name)){
                $item_array = is_array( $this->session_array($name, $item) ) ? $this->session_array($name, $item) : null ;
            } 
            
            if( !empty($item_array)){
                   if( !is_null( $item_elem)){
                         $item_count = 1;
                         foreach( $item_array as $item_array_row => $item_array_var ){
                                  $item_exists = !empty( $item_array_var[$item_elem] ) ? $item_array_var[$item_elem] : null;
                                  $item_count++;
                         }
                   }
            }
            
            if( count($item_exists)>=2){
                if( !empty($item_exists)){
                       $return_array = $item_exists;
                } else {
                       $return_array = array( 'error_message' => array( 'error_handler' => array( 'error' => 'Session ' . $item_elem . ' Are not exists  (parameter 3 (elem))' ) ) );
                }
            } else {
                $return_array = array( 'error_message' => array( 'error_handler' => array( 'error' => 'Session ' . $item_elem . ' Are not exists (parameter 3 (elem))' ) ) );; 
            }
            
            return $return_array;
            
         }
         
         /**
           * Session Array 
           * Name (string)
           * Array (array)
         **/
         
         public function session_array($name=null, $array=array()){
             $session_name = $this->session($name);
             if( !is_null($session_name)){
                   if( !empty($array)){
                        $session_name[] = is_array( $array ) ? $array : false;
                   }
             }
             
             if( !empty($session_name)){
                   if( is_array($session_name)){
                       return $session_name;
                   }
             }
         }
        
    }
}

$DBSession = new DBSession( true );

?>