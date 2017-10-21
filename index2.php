<?php


ini_set('display_errors', 'On');
error_reporting(E_ALL);


$obj = new main();

    class main  {

    public function __construct()
    {
        
        $pageRequest = 'homepage';
        
       
        if(isset($_REQUEST['page'])) {
            
            //load the type of page the request wants into page request
            $pageRequest = $_REQUEST['page'];
        }
        
        //instantiate the class that is being requested
         $page = new $pageRequest;


        if($_SERVER['REQUEST_METHOD'] == 'GET') 

        {
            $page->get();
        } 

        else {
            $page->post();
        }

    }

}

abstract class page {
    
    protected $html;

    public  function __construct()
    {
        //echo "In Abstract constructor!";
        $this->html.= '<html>';
        $this->html.= '<link rel="stylesheet" href="styles.css">';
        $this->html.= '<body>';


    }
    public function __destruct()
    {
        $this->html.= '</body></html>';
        
    }

    public function get()
    {
        
    }

    public function post() {
       
      
    }

  }



class homepage extends page
{
 
    public function get()
    {   
      
       
    
        $form = '<form  method="post" enctype="multipart/form-data">';
        $form.='<input type="file" name="fileToUpload" id="fileToUpload">';
        $form.='<input type="submit" value="Upload file" name="submit">';
        $form.='</form>';
        $this->html.='<h1>Upload Form</h1>';
        $this->html.=$form;
        print_r($this->html);
        

    }  

    public function post()

    {


        $target_dir ="./Uploads/";
        $target_file =$target_dir .basename($_FILES["fileToUpload"]["name"]);
        $scvtype = pathinfo($target_file,PATHINFO_EXTENSION);
        $fileName=pathinfo($target_file,PATHINFO_BASENAME);
        
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);                
           
        header('Location: index2.php?page=htmlTable&filename='.$fileName);

     }
}


class htmlTable extends page {


  public function get(){

        $tmpName = " ";

        $tmpName= $_REQUEST['filename'];

        //$fname= $_FILES["fileToUpload"]['name'];
        $ext = explode('.', $tmpName);

        $x=strtolower(end($ext));
         if($x=="csv")
         {                    
         
         //echo "------> ".$tmpName;
         echo "<html><body><table border='2'>\n\n";
                  if(($handle = fopen("Uploads/".$tmpName, "a+")) !== FALSE) 
                  {
             //echo "READ SUCCESSFUL";
             $data = fgetcsv($handle,1000000,',',' ');
             //print_r($data);
                        while(($data = fgetcsv($handle)) !== FALSE) 
                        {
                     echo "<tr>";
                     foreach ($data as $cell) 
                         {
                     echo "<td>" . htmlspecialchars($cell) . "</td>";
             }
                 echo "</tr>\n";
             }
             fclose($handle);
             echo "\n</table></body></html>";
               
                  }
            }

    }


  }

?>

