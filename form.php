<html>
<head>
<title>Register Form</title>
<link rel="stylesheet" type="text/css" href="style.css">

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script>
function userAction(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var userData = '';
    if (type == 'add') {
        userData = $("#addForm").find('.form').serialize()+'&action_type='+type+'&id='+id;
    }else if (type == 'edit'){
        userData = $("#editForm").find('.form').serialize()+'&action_type='+type;
    }else{
        userData = 'action_type='+type+'&id='+id;
    }
    $.ajax({
        type: 'POST',
        url: 'userAction.php',
        data: userData,
        success:function(msg){
            if(msg == 'ok'){
                alert('User data has been '+statusArr[type]+' successfully.');
                getUsers();
                $('.form')[0].reset();
                $('.formData').slideUp();
            }else{
                alert('Some problem occurred, please try again.');
            }
        }
    });
}

function editUser(id){
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: 'userAction.php',
        data: 'action_type=data&id='+id,
        success:function(data){
            $('#idEdit').val(data.id);
            $('#nameEdit').val(data.name);
            $('#emailEdit').val(data.email);
            $('#phoneEdit').val(data.phone);
			$('#addressEdit').val(data.address);
            $('#editForm').slideDown();
        }
    });
}

</script>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="panel panel-default users-content">
            <div class="panel-heading">Users <a href="javascript:void(0);" class="glyphicon glyphicon-plus" id="addLink" onclick="javascript:$('#addForm').slideToggle();">Add</a></div>
            <div class="panel-body none formData" id="addForm">
                <h2 id="actionLabel">Add User</h2>
                <form class="form" id="userForm" action = "userAction.php" method = "Post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email"/>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone"/>
                    </div>
					 <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" id="address"/>
                    </div>
                    <a href="javascript:void(0);" class="btn btn-warning" onclick="$('#addForm').slideUp();">Cancel</a>
                    <a href="javascript:void(0);" class="btn btn-success" onclick="userAction('add')">Add User</a>
                </form>
            </div>
            <div class="panel-body none formData" id="editForm">
                <h2 id="actionLabel">Edit User</h2>
                <form class="form" id="userForm">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" id="nameEdit"/>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" id="emailEdit"/>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" id="phoneEdit"/>
                    </div>
					<div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" id="addressEdit"/>
                    </div>
					
                    <input type="hidden" class="form-control" name="id" id="idEdit"/>
                    <a href="javascript:void(0);" class="btn btn-warning" onclick="$('#editForm').slideUp();">Cancel</a>
                    <a href="javascript:void(0);" class="btn btn-success" onclick="userAction('edit')">Update User</a>
                </form>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
						<th>Address</th>
                        <th>Action</th>
                    </tr>
					
		<!-- this is the view part of the site -->
					
                </thead>
			<?php 
		$conn = mysqli_connect("localhost","root","");
	mysqli_select_db($conn,"project");
			
		$sql="SELECT * FROM adduser";

		if ($result=mysqli_query($conn,$sql))
		  {
		  // Fetch one and one row
		  while ($row=mysqli_fetch_array($result))
			{			
		?>
		<tr>
			<td><?php echo $row['name']?></td>
			<td><?php echo $row['email']?></td>
			<td><?php echo $row['phone']?></td>
			<td><?php echo $row['address']?></td>
			<td>
                            <a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editUser('<?php echo $row['id']; ?>')"></a>
                            <a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?userAction('delete','<?php echo $row['id']; ?>'):false;"></a>
                        </td>
		</tr>
		<?php 
		    }
			  // Free result set
			  mysqli_free_result($result);
			}

			mysqli_close($conn);
		?>
				
             
			
			</table>
        </div>
    </div>
</div>

</body>
</html>