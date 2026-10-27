<html>
<head>
<title>Upload Form</title>
</head>
<body>
<form action="<?php echo base_url();?>upload_cont/" method="POST" enctype="multipart/form-data">

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>