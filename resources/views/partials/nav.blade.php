<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Takeasy</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">

                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::user())
                        <li><a href="/questions/create">Ask new Question</a></li>
                        <li><a href="/profile">{!! Auth::user()->name; !!} {!! Auth::user()->family; !!}</a></li>
                        <li><a href="/logout">Log out</a></li>
                        <li>{!!Auth::user()->avatarImg(50, 50);!!}</li>
                    @else
                        <li><a href="/login">Log in</a></li>
                    @endif

                </ul>

            </div><!--/.nav-collapse -->
        </div>
    </nav>