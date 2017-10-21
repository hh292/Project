<?php


ini_set('display_errors', 'On');
error_reporting(E_ALL);


$obj = new main();

    class main  {

    public function __construct()
    {
        //print_r($_REQUEST);
        //set default page request when no parameters are in URL
        $pageRequest = 'homepage';
        
        //check if there are parameters
        
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
        echo "In Abstract constructor!";
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
        echo "In abstract get";
        //print_r($_GET);
    }

    public function post() {
       
       echo "In post";

       //print_r($_POST);
    }

    public function display()
    {

        echo "In Display";
    }

   // public function get();

   // public function post() {
       // print_r($_POST);
    //}
}



class homepage extends page
{
 
    public function get()
    {   
      
       echo 'Hi';
    
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


      echo "In post fun-----";
         echo "----------";
         echo '<pre>';
         print_r($_FILES);
         echo '</pre>';

        $file_result = "" ;
            
            
                $file_result .= 
                "Upload: ".$_FILES["fileToUpload"]["name"]."<br>".
                "Type:".$_FILES["fileToUpload"]["type"]."<br>".
                "size:" .($_FILES["fileToUpload"]["size"]/1024)."<br>".
                "Temp file: ".$_FILES["fileToUpload"]["tmp_name"]."<br>";
               $x =  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "Uploads/".$_FILES["fileToUpload"]['name']);
              



           // return($x);
                

                echo '<pre>';
         print_r($_FILES);
         echo '</pre>';

         //echo "x";

         header('Location:?filename='.($_FILES["fileToUpload"]["name"]));

         exit();

}

/*public function display()
{       
   
       //header("Content-Disposition:;filename='.pdf'");
        $fname = " ";
        
        $fname= $_FILES["fileToUpload"]['name'];
        $ext = explode('.', $fname);
        $x=strtolower(end($ext));
         if($x=="csv")
         {                    
         $tmpName = $_FILES["fileToUpload"]["name"];
         //echo "------> ".$tmpName;
         echo "<html><body><table border='2'>\n\n";
                  if(($handle = fopen($tmpName, "a+")) !== FALSE) 
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
             //echo "\n</table></body></html>";
               
                  }
            }

    }


    }*/
    
    
}

?>

