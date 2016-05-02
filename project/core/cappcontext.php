<?php
  require_once("cconfig.php");
  require_once(  APP_DB_G . "/adodb.inc.php");
  require_once(  APP_DB_G . "/tohtml.inc.php");
  require_once(  APP_DB_G . "/toexport.inc.php");
  require_once(  APP_SRC_G . "/crequestbroker.php");
  // require_once(  APP_SRC_G . "/csessions.php");
  require_once(  APP_SRC_G . "/coutput.php");
  require_once(  APP_SRC_G . "/cuser.php");
  
  class CApplicationContext
  {
    public $mobj_config;  #Config Object
    public $mobj_db;      #Adodb Object
    public $mobj_orb;     #Request Broker - Singleton Class with static functions    
    public $mobj_user;    #User Object
    public $mobj_data;    #Data 
    public $mobj_output;  #Output stream
    public $main_src;   
    #public $mobj_logger; #Logger stream
        
    function __construct()
    {                                   
     }    
    function Initialize()
    {
      # all the contained object creations happen here and not in the constructor
      # this is to avoid exceptions during object creation
      
      # 06. Input - Init
      $this->mobj_data = $_REQUEST;
	  //var_dump($_REQUEST);

      # 01. Create the Config Object
      $this->mobj_config = new CConfig( isset($this->mobj_data["dbg"]) );

      # 02. Create the DB Object
      $this->mobj_db = &ADONewConnection(PDO); # by default we connect to mysql
	  
	  /* For PDO COnnection "mysql:host=localhost" or for mysql use $this->config_obj->mstr_host*/
	  
      $this->mobj_db->debug = $this->mobj_config->mbool_debug;
      $lbool_res = $this->mobj_db->Connect("mysql:host=localhost", $this->mobj_config->mstr_user, $this->mobj_config->mstr_password, $this->mobj_config->mstr_db);
     
      # 03. Create the Request Broker
      $this->mobj_orb = CRequestBroker::GetInstance();
      /* Actions to be registered in mregistry.php
       */
      
      # 04. Sessions
      // CSessions::Initialize();

      # 07. Output - Init
      $this->mobj_output = new COutput();
      $this->mobj_output->Initialize();
      
      # 05. User
      // $this->mobj_user = CSessions::GetUser();
	   // $this->mobj_user = CSessions::GetUser();
	   //$sess_obj=NEW CSessions();
	   // $this->mobj_user = $sess_obj->GetUserManual();echo
	   $https_on = isset($_SERVER["HTTPS"]);
       $path = ($https_on == "on") ? "https://" : "http://";
				$path .=$_SERVER["SERVER_NAME"]. dirname($_SERVER["PHP_SELF"]); 
		$this->main_path=$path."/";
	
		 $exp_arr=explode("//",$this->main_path);
		  $this->main_url_info="Local";
		  if(count($exp_arr)==3)
		  {
		  $this->main_path=substr($this->main_path,0,strlen($this->main_path)-1);
		  $this->main_url_info="Website";
		  }
		  
			$this->main_src=dirname(dirname(__FILE__))."\source";
           
		   $path_parts = pathinfo($_SERVER['SCRIPT_FILENAME']);
		 
		 $page_name=($path_parts['filename']); 
		 $page_file_name=($path_parts['basename']); 
		 $this->page_name=$page_name;
		 $this->page_file_name=$page_file_name;
		
    }   

    function __destruct()
    {
      # though php closes the db, it is good practice to do it ourselves explicitely once
      # $this->mobj_db->Close();
      unset($this->mobj_db);
      unset($this->mobj_config);
    } 
  }   
        
?>
