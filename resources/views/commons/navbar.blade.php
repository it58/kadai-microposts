<header class="mb-4">
    <nav class="navbar navbar-epand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Microposts</a>

        <button tyoe="button" class="navbar-toggler" data-toggle=
        "collapse" data-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav mr-auto">
            <ul class="navbar-nav">
                <li>{!! link_to_route('signup.get', 'Signup', [], ['class' =>'nav-link']) !!}</li>
                <li><a href="#">Login</a></li>
            </ul>
        </div>
    </nav>
</header>