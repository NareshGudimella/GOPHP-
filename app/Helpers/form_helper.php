<?php
function display_error($validation,$felid){
   if(isset($validation)){
      if($validation->hasError($felid)){
           return $validation->getError($felid);
      }
      else{
       
        return false;
      }
}
}