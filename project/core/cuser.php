<?php
  
  require_once(  APP_SRC_G . "/cappcontext.php");
  
  class CUser
  {
    public $mobj_context = NULL;
    public $marr_data;    
    
    function __construct($aobj_context = NULL)
    {
      $this->mobj_context = $aobj_context;
    }
    
    function Clear($aint_uid = 0)
    {
      # this will get us an empty array with the table field structure
      $this->RetrieveById($aint_uid);
    }

    function Save()
    {
      #print_r($this->marr_data);
      # write whatever is there in the marr_data to db
      # insert / update based on the "name" field
      $lbool_result = $this->mobj_context->mobj_db->Replace
        (
          "sl_users",
          $this->marr_data,
          "name",
          true
        );
      $this->mobj_context->mobj_data["activation_id"] = $this->GetLastID();
      #print_r($lbool_result . "::" . $this->mobj_context->mobj_db->ErrorNo() . " - " . $this->mobj_context->mobj_db->ErrorMsg());
      return ($lbool_result);
    }
    
    function GetLastID()
    {
      return ($this->mobj_context->mobj_db->Insert_ID());
    }
    
    function DeleteByID($aint_id)
    {
      $this->mobj_context->mobj_db->SetFetchMode(ADODB_FETCH_ASSOC); 
      $this->mobj_context->mobj_db->Execute("delete from sl_users where user_id = ". $aint_id);

      return ($this->mobj_context->mobj_db->Affected_Rows() == 1);
    }
    
    function Activate($astr_activationcode)
    {
      $lbool_result = $this->mobj_context->mobj_db->AutoExecute(
        "sl_users",
        array("is_active"=>true),
        "UPDATE",
        "md5(user_id) = '".$astr_activationcode."'"
      ) && ($this->mobj_context->mobj_db->Affected_Rows() <> 0);
      return($lbool_result);
    }
    
    function DeActivate($astr_activationcode)
    {
      return 
      (
        $this->mobj_context->mobj_db->AutoExecute
        (
          "sl_users",
          array("is_active"=>false),
          "UPDATE",
          "user_id = $astr_activationcode"
        )
      );
    }
    
    function RetrieveByName($astr_name = "")
    {
      /*
       * Desc : retrieves the first record matching the firstname
       * returns : true on success and sets the marr_data with user info. / false on failure 
       */
      $lbool_result = false;
      
      $this->mobj_context->mobj_db->SetFetchMode(ADODB_FETCH_ASSOC); 
      $astr_name = mysql_real_escape_string($astr_name);
      $lobj_rs = $this->mobj_context->mobj_db->Execute("select * from sl_users where name = '".$astr_name."'");

      if($lobj_rs)
        $this->marr_data = $lobj_rs->fields;
        
      $lbool_result = (isset($this->marr_data) && !empty($this->marr_data));
      return ($lbool_result);
    }
    
    function RetrieveById($aint_id = "")
    {
      /*
       * Desc : retrieves the first record matching the firstname
       * returns : true on success and sets the marr_data with user info. / false on failure 
       */
      $lbool_result = false;
      
      $this->mobj_context->mobj_db->SetFetchMode(ADODB_FETCH_ASSOC); 
      $lobj_rs = $this->mobj_context->mobj_db->Execute("select * from sl_users where user_id = ". $aint_id);

      if($lobj_rs)
      {
        $this->marr_data = $lobj_rs->fields;
        $lbool_result = true;
      }
        
      return ($lbool_result);
    }

    function Data($astr_key = "")
    {
      if(isset($astr_key) && !empty($astr_key))
        return $this->marr_data[$astr_key];
      else
        return $this->marr_data;
    }
    
  }

?>