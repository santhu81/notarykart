<?php  
  require_once(APP_DB_G . "/adodb.inc.php");
  class CAcessContext
  {
   
    public $mobj_db;      #Adodb Object
    public $mobj_data;    #Data 
    public $main_src;   
    #public $mobj_logger; #Logger stream
        
       
    function __construct()
    {
      # all the contained object creations happen here and not in the constructor
      # this is to avoid exceptions during object creation
      
      # 06. Input - Init
      $this->mobj_data = $_REQUEST;
	  
      # 02. Create the DB Object
      $this->mobj_db = &ADONewConnection("access"); # by default we connect to mysql
	  $lbool_res = $this->mobj_db->PConnect('tarka','','','');//Needed to Map ODBC in Administrative Tools
      $this->mobj_db->SetFetchMode(ADODB_FETCH_ASSOC);
       
		$main_src_obj=(explode("/",$_SERVER["REQUEST_URI"]));
		$this->main_src=substr($_SERVER['SCRIPT_FILENAME'],0,strlen($_SERVER['SCRIPT_FILENAME'])-7);
    }   

    function __destruct()
    {
      unset($this->mobj_db);
      unset($this->mobj_config);
    } 
  }   
  /* 
  require_once($aobj_context->main_src."src/caccesscontext.php");
		$access_context=new CAcessContext();
		$rs2 = $access_context->mobj_db->GetAll('select * from Employees');
		echo "<pre>";
		print_r($rs2);
  */
        
?>
