<h1>Admin Home</h1>

<form action="{{ route('logout') }}" method="post">
  @csrf
  <input type="submit" value="Logout">
</form>
