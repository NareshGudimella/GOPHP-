<?php
namespace App\Controllers;
use App\Models\DashboardModel;
  
class FileController extends BaseController{
    public $dmodel;
    public function __construct(){
        helper("form");
        $this ->dmodel = new DashboardModel();
       
    }
    
    public function index(){
        
        
        
       
         
        
        $file_path = WRITEPATH.$this->request->getPath();
        

        // Check if the file exists
        if (file_exists($file_path)) {
            // Set the appropriate headers for file download
            // header('Content-Description: File Transfer');
            header("Content-type: image/jpeg");
            // header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
            // header('Expires: 0');
            // header('Cache-Control: must-revalidate');
            // header('Pragma: public');
            // header('Content-Length: ' . filesize($file_path));
        
            // Read the file and output it to the browser
            // $image=imagecreatefromjpeg($file_path);
            // imagejpeg($image);
           readfile($file_path);
            exit;
            
            
        } else {
            // File not found
            echo 'File not found.'.$file_path;
        }

     
    
       
} 
    
    
}
