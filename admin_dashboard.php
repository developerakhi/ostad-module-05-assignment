<?php
    session_start();

    $user = $_SESSION["loggin"] ?? [];

    if (empty($user)) {
        header("Location: logout.php");
        exit;
    }

    if ($user["role"] != "admin") {
        header("Location: logout.php");
        exit;
    }
    $results = json_decode(file_get_contents('users.json'), true);
    
    // role update code

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $email = $_POST['email'];
        $role = $_POST['role'];

        if ( isset( $results ) ) {
            $results[$email]['role'] = $role;
            file_put_contents( 'users.json', json_encode( $results, JSON_PRETTY_PRINT ) );

            $success = "Role Updated Succses";
        }
    }
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Dashborad</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('include/header_files.php');?>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                <div class="card">
                    <div class="card-body">
                        <div style="margin:0 10px; padding: 0 10px; float:left;">
                            <a class="text-white float-right fs-18 font-weight-bold btn btn-success" href="./signup.php">Create an account</a>
                        </div>
                        <div style="margin:0 10px; padding: 0 10px; float:right;">
                            <a class="text-white float-right fs-18 font-weight-bold btn btn-danger" href="./logout.php">Log out</a>
                        </div>
                        <div class="text-success">
                            <?php echo $success ?? "" ?>
                        </div>
                    </div>
                </div>
				<div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Welcome to Admin Dashboard!
					</span>
				</div>
                
				<table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Email</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $count = 0;
                        foreach($results as $email=>$row):?>
                        <tr>
                            <th scope='row'><?php echo ++$count; ?></th>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                                    <select name="role" onchange="this.form.submit();">
                                        <option value=""></option>
                                        <option value="admin" <?= $row['role'] == 'admin'? 'selected':''; ?>>admin</option>
                                        <option value="manager" <?= $row['role'] == 'manager'? 'selected':''; ?>>manager</option>
                                        <option value="user" <?= $row['role'] == 'user'? 'selected':''; ?>>user</option>
                                    </select>
                                </form>
                            </td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $email; ?></td>
                            
                        </tr>
                        <?php 
                        endforeach;
                        ?>
                    </tbody>
                    </table>
			</div>
		</div>
	</div>
	

	<?php include('include/footer_files.php');?>
</body>
</html>