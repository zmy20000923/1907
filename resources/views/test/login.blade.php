<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
 </head>
 <body>
  <form action="{{Route('asd')}}" method="post" >
	@csrf
	<table>
	<tr>
		<td>账号</td>
		<td>
			<input type="text" name="name"  />
		</td>
	</tr>
	<tr>
		<td>密码</td>
		<td>
			<input type="pwd"  name="pwd"/>
		</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type="submit" class="but" />
		</td>
	</tr>
	</table>
  </form>
 </body>
</html>

