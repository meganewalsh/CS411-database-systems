<!doctype html>
<html lang='en'>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        <script
              src="https://code.jquery.com/jquery-3.3.1.min.js"
              integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
              crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script src="js/home.js"></script>

        <title>[Placeholder] Home Page</title>
    </head>
    <body onload="setup()">
        <div class="container" id="main">
            <div class="container border border-primary rounded p-3 my-3" id="Heading">
                <h1>[Placeholder] Home Page</h1>
                <!-- Dropdown Menu for switching dropdown"> -->
		<select class="form-control" id="location_select" onchange="onLocationChange()">
		</select>
            </div>
            <div class="container border border-primary rounded p-3 mb-3" id="Currently Playing">
                <h1>Now Playing</h1>
                <div id="current-song">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    <h3>Never Gonna Give You Up</h3>
                    <h4>Rick Astley</h4>
                    <p class="test-left">
                        <a href="https://youtu.be/dQw4w9WgXcQ" target="_blank">https://youtu.be/dQw4w9WgXcQ</a>
                        <br />30 points
                        <br />Submitted by ---
                    </p>
                </div>
            </div>
            <div class="container border border-secondary rounded p-3 mb-3" id="songlist-container">
                <h1>Song Queue</h1>
                 <button class="btn btn-secondary" onclick="window.location='http://datasyndicate.web.illinois.edu/megan/song_request.html'">
                                    Add a Song
                </button>
                 <button class="btn btn-secondary" onclick="window.location='http://datasyndicate.web.illinois.edu/megan/song_delete.html'">
                                    Delete a Song
                </button>
                <button class="btn btn-secondary" onclick="window.location='http://datasyndicate.web.illinois.edu/megan/song_update.html'">
                                    Update a Song
                </button>
                <table class="table table-hover mt-2">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Points</th>
                            <th scope="col">Title</th>
                            <th scope="col">Artist</th>
                            <th scope="col">URL</th>
                            <th scope="col">Poster</th>
                        </tr>
                    </thead>
                    <tbody id="songlist-table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>