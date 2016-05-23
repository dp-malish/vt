<?php

class SQL_select
{

// Óñòàíîâèòü çíà÷åíèÿ ïî Âàøåìó ïîäêëþ÷åíèÿ äàííûõ
    private $db_host    = "localhost";   // server name
    private $db_user    = "root";       // user name
    private $db_pass    = "root";    // password
    private $db_dbname  = "vb";    // database name
    private $db_charset = "";           // optional character set (i.e. utf8)
    private $db_pcon    = false;        // use persistent connection
	
    private $mysql_link     = 0;        // mysql link resource
    private $sql            = "";       // mysql query
    private $result;                    // mysql query result


	
//+++++++++++++++++++++++++++++++++++++++++++	
    function __construct($pcon=false, $server="", $username="", $password="", $database="", $charset="") {

        if ($pcon)                 $this->db_pcon    = true;
        if (strlen($server)   > 0) $this->db_host    = $server;
        if (strlen($username) > 0) $this->db_user    = $username;
        if (strlen($password) > 0) $this->db_pass    = $password;
        if (strlen($database) > 0) $this->db_dbname  = $database;
        if (strlen($charset)  > 0) $this->db_charset = $charset;

        //
        if (strlen($this->db_host) > 0 && strlen($this->db_user) > 0)
        {
            $this->Open();
        }
    }
//+++++++++++++++++++++++++++++++++++++++++++	


 /** Ïîäêëþ÷èòüñÿ ê óêàçàííîìó ñåðâåðó MySQL */
    private function Open()
    {
        // Open persistent or normal connection
        if ($this->db_pcon) {
            $this->mysql_link = @mysql_pconnect($this->db_host, $this->db_user, $this->db_pass);
        } else {
            $this->mysql_link = @mysql_connect ($this->db_host, $this->db_user, $this->db_pass);
        }

        // Connect to mysql server failed?
        if (!$this->IsConnected()) {
          //  $this->SetError();              äîáàâèòü ïåðåàäðàñàöèþ!!!!!!!!!!!!!!!!!
		  
            return false;
			
        }
        else // Connected to mysql server
        {
            // Select a database (if specified)
            if (strlen($this->db_dbname) > 0) {
                if (strlen($this->db_charset) == 0) {
                    if (! $this->SelectDatabase($this->db_dbname)) {
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    if (! $this->SelectDatabase($this->db_dbname, $this->db_charset)) {
                        return false;
                    } else {
                        return true;
                    }
                }
            } else {
                return true;
            }
        }
    }

//+++++++++++++++++++++++++++++++++++

  /**
     * Executes the given SQL query and returns the result
     *
     * @param string $sql The query string
     * @return (boolean, string, object, array with objects) result
     */
    public function Query($sql) {
       // $this->ResetError();
	    mysql_query("SET NAMES utf8");
        $this->sql    = $sql;
        $this->result = @mysql_query($this->sql, $this->mysql_link);

        // start the analysis
        if (TRUE === $this->result) {   // simply result
            $return = TRUE;         // successfully (for example: INSERT INTO ...)
        }
        else if (FALSE === $this->result)
        {
        //    $this->SetError();
       /*     if($debug)
            {
                self::ShowDebugInfo("error=".$this->error_desc);
                self::ShowDebugInfo("number=".$this->error_number);
            }*/
            $return = FALSE;        // error occured (for example: syntax error)
        }
        else // complex result
        {
            switch (mysql_num_rows($this->result)){
                case 0:
                    $return = NULL; // return NULL rows
                    break;
                case 1: // return one row ...
                    if(1 != mysql_num_fields( $this->result))
                    $return = mysql_fetch_object($this->result);    // as object
                    else
                    {
                        $row    = mysql_fetch_row($this->result);       // or as single value
                        $return = $row[0];
                    }
                    break;
                default:
                    $return = array();
                    while( $obj = mysql_fetch_object($this->result)) array_push($return, $obj);
            }
        }
        return $return;
    }
//+++++++++++++++++++++++++++++++++++++++++++++
 public function QuerySelect($sql) {

		mysql_query("SET NAMES utf8");
		$this->sql    = $sql;
		$this->result = @mysql_query($this->sql, $this->mysql_link);
return $this->result;

// start the analysis
        if (TRUE === $this->result) {   // simply result
            echo $this->SetError();
			// successfully (for example: INSERT INTO ...)
        }
        else if (FALSE === $this->result) 
        {	echo  $this->SetError();

        }


 }
/** Îïðåäåëÿåò íàëè÷èå äåéñòâèòåëüíîãî ïîäêëþ÷åíèÿ ê áàçå äàííûõ ñóùåñòâóåò */
    public function IsConnected() {
        if (gettype($this->mysql_link) == "resource") {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Selects a different database and character set
     *
     * @param string $database Database name
     * @param string $charset (Optional) Character set (i.e. utf8)
     * @return boolean Returns TRUE on success or FALSE on error
     */
    public function SelectDatabase($database, $charset = "") {
        $return_value = true;
        if (! $charset) $charset = $this->db_charset;
      //  $this->ResetError();
        if (! (mysql_select_db($database))) {
       //     $this->SetError();
            $return_value = false;
        } else {
            if ((strlen($charset) > 0)) {
                if (! (mysql_query("SET CHARACTER SET '{$charset}'", $this->mysql_link))) {
                  //  $this->SetError();
                    $return_value = false;
                }
            }
        }
        return $return_value;
    }
	
//++++++++++++++++++++++++++++++++++++++++++++
   /** Destructor: Closes the connection to the database */
    public function __destruct() {
        $this->Close();
    }
    /** Close current MySQL connection */
    public function Close() {
        $success = $this->Release();
        if ($success) {
            $success = @mysql_close($this->mysql_link);
            if (! $success) {
                $this->SetError();
            } else {
                unset($this->sql);
                unset($this->result);
                unset($this->mysql_link);
            }
        }
        return $success;
    }

    /** Frees memory used by the query results and returns the function result */
    public function Release() {
        if (! $this->result) {
            //$success = true;
        } else {
            $success = @mysql_free_result($this->result);

               }
		return $success;
    }




//++++++++++++++++++++++++++++++++++++++++

 /** Ïîäêëþ÷èòüñÿ ê óêàçàííîìó ñåðâåðó MySQL */
    public function MyOpen($sql)
    {
            $this->mysql_link = @mysql_connect ($this->db_host, $this->db_user, $this->db_pass);
            mysql_select_db($this->db_dbname,$this->mysql_link);
			$this->sql    = $sql;
            $return= $this->result = @mysql_query($this->sql, $this->mysql_link);
            return $return;
    }

//+++++++++++++++++++++++++++++++++++
}

?>