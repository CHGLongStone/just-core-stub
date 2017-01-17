<?php 
if(!isset($_SERVER['HTTPS']) || 'on' != $_SERVER['HTTPS']){
	$API_PATH = 'https://'.$_SERVER['SERVER_NAME'].'/api/';
}

?>

<!DOCTYPE html>

<html lang="en">
<head>
 <TITLE>test</TITLE>
 <!-- 
 <link rel="stylesheet" href="../webix/codebase/webix.css" type="text/css"> 
 <script type="text/javascript" src="../webix/codebase/webix.js"></script>
 -->
 <link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css"> 
 <script type="text/javascript" src="http://cdn.webix.com/edge/webix.js"></script>
 
 <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
 <script type="text/javascript" >
	//var API_PATH = 'http://just-core-stub.com';
	var API_PATH = '<?php echo $API_PATH;?>';
	
	function doAjaxRequest2( ) {
		objData = $("#jsonString").val();
		//objData = jQuery.parseJSON(objData);
		requestURL = $("#requestURL").val();
		requestType = $("#requestType").val();
		 alert('requestType['+requestType+']');
		$.ajax({
		  type: requestType,
		  dataType: "json",
		  url: API_PATH,
		  data: objData,
		  cache: false
			})
		  .done(function( resultObj ) {
			//alert("doAjaxRequest2: "+resultObj.result.title);
			
			$( "#results" ).append( JSON.stringify(resultObj, null, 2)+"\r\n\r\n" );
		  });
	}

  function prettyPrint()
  {
   objData = $("#jsonString").val();
   objData = jQuery.parseJSON(objData);
   objJSON = JSON.stringify(objData, null, 2);
   $("#jsonString").html(objJSON);
  }
	function pageSingle(id){
		//alert(id);
		if (document.getElementById(id)){
				//alert('document.getElementById(id).style.display='+document.getElementById(id).style.display);
			(document.getElementById(id).style.display == 'none')? display = 'block': display = 'none' ;
			//alert('display'+display);
			document.getElementById(id).style.display = display;
			//alert('document.getElementById(page_id).style.display: '+document.getElementById(page_id).style.display);
		}
	}
 </script>
 <style>
  body { 
   font-size:14px; 
   line-height:1.3em;
   background-color:rgba(0,0,0,0.2);
   
  }
  .description { 
   font-size:14px;
  }
  .code { 
   font-size:10px;
  }
  .sectionHead { 
   font-weight:bold;
  }
  
 </style>
</head>
<body>

<?php
$DSN = 'JCORE';
$table = 'jcore_example';
$pk_field = 'id';


$request = array(
 "method" => "\SERVICE\CRUD\CRUD.update",
 "params" => array(
  "DSN" => $DSN,
  "table" => $table ,
  "pk_field" => $pk_field,
  "pk" => 1,
  "values" => array(
    $pk_field => "1",
    "short_name" => "vexus",
    "long_name" => "Vexus Consulting Group"
  ),
 ),
 "id" => "",
);


$request = array(
 "method" => "\SERVICE\CRUD\CRUD.retrieve",
 "params" => array(
  "DSN" => $DSN,
  "table" => $table,
  "pk_field" => $pk_field,
  "pk" => 1,
 ),
 "id" => "",
);
#echo __METHOD__.__LINE__.'<pre>'.var_export($request,true).'</pre>';
$request = json_encode($request);
#echo __METHOD__.__LINE__.'<pre>'.var_export($request,true).'</pre>';

?>
<a href="javascript:void(0);" onclick="pageSingle('setup');">Setup</a>
<div id="setup" style="display: none;">
	in the script section at the top of this file you will need to modify 
	var API_PATH = 'http://just-core-stub.com';
	to the FQDN where you have installed this stub or add the entry to your hosts file
	with the correct IP
	#=============================
	127.0.0.1  just-core-stub.com
	#=============================
	
	The following *.local files need to be created from the example *global or *.php files in /CONFIG/AUTOLOAD/<br>
	<br>
	just-core.local.php<br>
	data.local.php<br>
	cache.local.php<br>
	log.local.php<br>
		
	<br>
	<br>
	Create the following table in your data store to use the examples below<br>
	<pre>
	SET FOREIGN_KEY_CHECKS=0;
	-- ----------------------------
	-- Table structure for jcore_example
	-- ----------------------------
	CREATE TABLE `jcore_example` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `shortname` varchar(30) DEFAULT NULL,
	  `longname` varchar(255) DEFAULT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	-- ----------------------------
	-- Records 
	-- ----------------------------
	INSERT INTO jcore_example
	  (id, shortname, longname)
	VALUES
	  (1, "a short name", "a longer name and description");
	</pre>

</div>
<br>
<span class="sectionHead">AJAX REQUEST:</span><br>
<br>
<span class="sectionHead">URL:</span> <input name="requestURL" id="requestURL"  type="text" value="./API/" ><br>
<span class="sectionHead">REQUEST TYPE:</span> <input name="requestType" id="requestType"  type="text" value="POST" ><br>
<input type="button" value="do request" onclick="doAjaxRequest2();">
<input type="button" value="Pretty Print Request" onclick="prettyPrint();"><br>

<textarea name="jsonString" id="jsonString" style="width:600px; height:150px;" ><?php echo $request; ?></textarea><br>
<span class="sectionHead">RESULTS:</span>
<input type="button" value="clear results" onclick="$(results).html('');"><br>
<textarea name="results" id="results" style="width:600px; height:150px;" >
</textarea>
<br>
<br>
<br>

<div class="description">

Class is called by namespace, slashes must be escaped to preserve JSON formatting<br>

"method" service class and method with a period separator <br>

"params" are the arguments passed to the service method, no arguments passed to constructor<br>

<span class="sectionHead">Data calls </span>
DSN => Data Source Name, configuration is stored in [install root]/CONFIG/AUTOLOAD/data.local.php <br>
see examples in [install root]/CONFIG/AUTOLOAD/data.php <br>
3 Other required args for a retrieve operation  <br>
<ul>
 <li>"table" the table name</li>
 <li>"pk_field" the primary key field name</li>
 <li>"pk" the primary key of the row you want </li>
</ul>
<span class="sectionHead">RETRIEVE</span><br>
<pre class="code">
{
    "method": "\\SERVICE\\CRUD\\CRUD.retrieve",
    "params": {
        "DSN": "<?php echo $DSN;?>",
        "table": <?php echo $table;?>,
        "pk_field": <?php echo $pk_field;?>,
        "pk": 1
    },
    "id": ""
}
</pre>

will return an array of records  <br>
<pre class="code">
{
  "result": [
    {
      "id": "1",
      "short_name": "vexus",
      "long_name": "Vexus Consulting Group"
    },
    {
      "id": "2",
      "short_name": "vexus2",
      "long_name": "Vexus2 Consulting Group"
    }
  ],
  "error": null,
  "id": "0.79750900 1424978023"
}
</pre>
<span class="sectionHead">UPDATE</span><br>
one other argument required for update operations  <br>
"values" an array of the column names and values you want to update  <br>
besides the primary key only the values being updated need to be supplied <br>
the update is applied as a differential  <br>

<pre class="code">
{
    "method": "\\SERVICE\\CRUD\\CRUD.update",
    "params": {
        "DSN": "<?php echo $DSN;?>",
        "table": "<?php echo $table;?>",
        "pk_field": "<?php echo $pk_field;?>",
        "pk": 1,
        "values": {
            "id": "1",
            "short_name": "vexus",
            "long_name": "Vexus Consulting Group"
        }
    },
    "id": ""
}
</pre>

will return an array of of the result   <br>
<pre class="code">
{
  "result": [
    {
      "AFFECTED_ROWS": 0,
      "INFO": "Rows matched: 1  Changed: 0  Warnings: 0"
    }
  ],
  "error": null,
  "id": "0.39666500 1424985892"
}
</pre>


</div>


</body>
