<?PHP
class database
{

	private $link;
	private $res;
	private $host; 
	private $user; 
	private $pass;
	private $db; 
	// sets user, pass and host and connects
	public function setup($u, $p, $h, $db)
	{
		$this->user = $u;
		$this->pass = $p;
		$this->host = $h;
		$this->db = $db;
		if (isset ($this->link))
			$this->disconnect ();
		$this->connect();
	}
	// Changes the database in which all queries will
	//be performed
	public function pick_db($db)
	{
		$this->db = $db;
	}
	// destructor disconnects
	public function __destruct()
	{
		$this->disconnect ();
	}
	//Closes the connection to the DB
	public function disconnect()
	{
		if (isset ($this->link))
			mysqli_close($this->link);
		unset ($this->link);
	}
	// connects to the DB or disconnects/reconnects if
	//a connection already existed
	public function connect()
	{
		include ("include.php");
		$this->user = $MySQL_User;
		$this->pass = $MySQL_Passw;
		$this->host = $MySQL_Host;
		$this->db = $MySQL_DB;
			
		if (!isset ($this->link))
		{
			try {
				if (!$this->link=mysqli_connect ($this->host, $this->user, $this->pass))
					throw new Exception ("Cannot Connect to".$this->host);
			}
			catch (Exception $e)
			{
				echo $e->getMessage ();
				exit;
			}
		}
		else
		{
			$this->disconnect();
			$this->connect();
		}
	}

	// sends a SQL query
	public function send_sql($sql) 
	{
		if (!isset ($this->link))
			$this->connect();
		try {
			if (! $succ = mysqli_select_db($this->link, $this->db))
				throw new Exception ("Could not select the database ". $this->db);
			if (! $this->res = mysqli_query($this->link,$sql))
				throw new Exception("Could not send query");
			}
		 
		catch (Exception $e)
		{
			echo $e->getMessage()."<BR>";
			echo mysqli_error($this->link);
			exit;
		}
		return $this->res;
	}
	//Shows the contents of the $res as a table
	public function printout() 
	{
		if (isset ($this->res) && (mysqli_num_rows ($this->res) > 0))
		{
			mysql_data_seek($this->res, 0);
			$num=mysql_num_nelds ($this->res);
			echo "<table border=l>";
			echo "<tr>";
			for ($i=O;$i<$num;$i++) {
				echo "<th>";
				echo mysql_tield_name ($this->res, $i);
				echo "<Ith>";
			}
			echo "</tr>";
			while ($row = mysqli_fetch_row($this->res)) 
			{
				echo "<tr>";
				foreach ($row as $elem) 
				{
					echo "<td>$elem</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
		}
		else
			echo "There is nothing to print!<BR>";
	}
	// returns an array with the next row
	public function next_row()
	{
		if (isset ($this->res))
		{
			return mysqli_fetch_row($this->res);
		}
		echo "You need to make a query first!!!";
		return false;
	}
	// returns the last AUTO_INCREMENT data created
	public function insert_id()
	{
		if (isset ($this->link))
		{
			$id = mysqli_insert_id ($this->link);
			if ($id == 0)
				echo "You did not insert an element that cause
			an auto-increment ID to be created!<BR>";
			return $id;
		}
		echo "You are not connected to the database!";
		return false;
	}
	//Creates a new DB and selects it
	public function new_db($name)
	{
		if (!isset($this->link))
		$this->connect();
		$query = "CREATE DATABASE IF NOT EXISTS".$name;
		try 
		{
			if (mysqli_query($query, $this->link))
			{
				throw new Exception ("Cannot create database".$name);
			}
			$this->db = $name;
		} 
		catch (Exception $e)
		{
			echo $e->g€,tMessage (). "<BR>";
			echo mysqli_error($this->link);
			exit;
		}
	}
}
?>