<?php

	  class MyDB extends SQLite3 {
      function __construct() {
         $this->open('test.db');
      }
   }
   $db = new MyDB();
   if(!$db) {
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n";
   }

   $sql =<<<EOF
      CREATE TABLE USER
      (ID INT PRIMARY KEY     NOT NULL,
      USERNAME           TEXT    NOT NULL,
      PASSWORD        TEXT NOT NULL;
EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Table created successfully\n";
   }
  // $db->close();

    $sql =<<<EOF
      INSERT INTO USER (ID,USERNAME,PASSWORD)
      VALUES (1, 'username', 'password');
EOF;

   $ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } else {
      echo "Records created successfully\n";
   }

   $sql =<<<EOF
      SELECT password from USER WHERE USERNAME = 'username';
EOF;


	if($_POST['submit']){
		$un = $_POST['username'];
		$pw = $_POST['password'];

		$ret=$db->query($sql);
		//
		if($row=$ret->fetchArray(SQLITE3_ASSOC)){
		if ($row['password']==$pw) {
			header("location:home.html");
			exit();
		} else {
			# code...
			echo "<script>alert('Invalid password')</script>";
		}
	} else{
			echo "<script>alert('Invalid password')</script>";
	}
	}
   $db->close();
  


?>