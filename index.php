<?php


ini_set('display_errors', 'On');
error_reporting(E_ALL);

$obj = new main();

    class main {

    public function __construct()
    {
       $pageRequest = 'homepage';
       
       if(isset($_REQUEST['page'])) {
       
         $pageRequest = $_REQUEST['page'];
        }
        
         $page = new $pageRequest;

       
       if($_SERVER['REQUEST_METHOD'] == 'GET') {
       
            $page -> get();
        } 
        else

        {
            $page -> post();
        }
        //check if there are parameters
        
    
    }

}

abstract class page {
    
    protected $html;

    public  function __construct()
    {
        $this->html .= '<html>';
        $this->html .= '<link rel="stylesheet" href="styles.css">';
        $this->html .= '<body></body></html>';
    }
    public function __destruct()
    {
        $this->html .= '</body></html>';
        
    }

    public function get() {
        
        //print_r($_GET);
    }

    public function post() {
        print_r($_POST);
    }
}



class homepage extends page
{
 
    public function get()
    {   

        if (isset($_GET["csv"]))
        {

            $tmpName = $_GET["csv"];
        
                 echo "<html><body><table border='1'>\n\n";
                 
                  if(($handle = fopen($tmpName, "r")) !== FALSE) 
                  {
             //echo "READ SUCCESSFUL";
             $data = fgetcsv($handle,10000,',',' ');
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

    exit();

}


        $form = '<form action="index.php" method="GET" enctype="multipart/form-data">';
        $form .= 'First name:<br>';
        $form .= '<input type="text" name="firstname" value="Himanshu">';
        $form .= '<br>';
        $form .= 'Last name:<br>';
        $form .= '<input type="text" name="lastname" value="Mouse">';
        $form .= '<input type="submit" value="Submit">';
        $form .= '</form> ';
       // $this->html.='homepage';
    $this->html .='homepage';
    $this->html .= '$form';
    }

 }

?>

