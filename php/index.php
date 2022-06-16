<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Model Generator</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Ubuntu', sans-serif;
            background-color: #EAEDF8;
            margin: 0;
        }

        .footer {
            padding: 100px;
            text-align: center;
            background-color: #343434;
            color: white;
            margin-top: 300px;
        }

        .footer a {
            text-decoration: dashed;
            color: white;
            font: bold;
        }

        .main {
            display: flex;
        }

        .menu {
            width: 20%;
            background-color: #696969;
            margin-right: 32px;
            height: 100vh;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: white;
            padding: 8px;
            display: flex;
            align-items: center;
        }

        .menu p {
            display: block;
            color: white;
            padding: 8px;

            display: flex;
            align-items: center;
        }

        .menu h1 {
            margin-left: 30px;
            font-size: 50px;
            font-weight: 900;
            color: white;
            padding: 8px;
            display: flex;
        }

        .menu img {
            margin-right: 8px;
        }

        .menu a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .logo {
            padding: 25px;

        }

        .content {
            width: 80%;
        }

        .content textarea {
            font-family: 'Ubuntu', sans-serif;
        }

        .canvas {
            display: block;
            background-color: lightblue;
            padding: 5px;
            border-color: white;
            border-width: 2px;
        }

        .canvasheader {
            color: white;
            padding: 5px;
            display: flex;
            background-color: lightblue;
            align-items: center;
            padding: 5px;
            border-color: white;
            border-width: 2px;

        }

        .canvasheaderelement {
            width: 33%;
        }

        .canvas5x2 {
            display: flex;
        }

        .canvas1x1 {
            padding: 5px;
            border-color: white;
            border-width: 4px;
            border-style: solid;
        }

        .canvas1x2 {

            padding: 5px;
            border-color: white;
            border-width: 5px;
            border-style: solid;
            display: block;
            width: 20%
        }

        .canvas25x1 {

            padding: 5px;
            border-color: white;
            border-width: 5px;
            border-style: solid;
            display: block;
            width: 50%;
        }
    </style>
</head>

<body>

    <div class="main">


        <div class="menu">
            <img class="logo" src="img/bmg_white.png" width="200px">
            <a href="index.php?page=start"><img src="img/home.svg">Start</a>
            <a href="index.php?page=create"><img src="img/add_business.svg">Geschäftsmodell erstellen</a>
            <a href="index.php?page=bm"><img src="img/business.svg">Meine Geschäftsmodelle</a>

            <?php
            $username="Administrator";
            if (empty($username)) {
                $loginpicture = "img/error.svg";
                $logintext = "nicht angemeldet!";
            } else {
                $loginpicture = "img/check.svg";
                $logintext = "angemeldet <em> (" . $username . ")</em>";
            }
            echo '<br /><a href="index.php?page=account"><img src=' . $loginpicture . '>' . $logintext . '</a>';

            ?>

        </div>

        <div class="content">
            <?php
            $data = [];

            $login = [];

            if (file_exists('login.bmg')) {
                $login = json_decode(file_get_contents('login.bmg', true), true); #true sucht im aktuellen Verzeichnis
            }

            if (isset($_POST['username']) && isset($_POST['password'])) {
                echo '<br />
    <div class="alert alert-success" role="alert">
    Erfolgreich angemeldet! Erstelle jetzt dein Geschäftsmodell!
</div>
    ';

                $username = $_POST['username'];
                $newLogin = [
                    'username' => $_POST['username'],
                    'pw' => $_POST['password'],
                ];
                array_push($login, $newLogin);
                file_put_contents('login.bmg', json_encode($login, JSON_PRETTY_PRINT));
            }

            if (file_exists('data.bmg')) {
                $data = json_decode(file_get_contents('data.bmg', true), true);
            }

            if (
                isset($_POST['bmname'])
                && isset($_POST['project'])
                && isset($_POST['businessmodel'])
                && isset($_POST['step1'])
                && isset($_POST['step2'])
                && isset($_POST['step3'])
                && isset($_POST['step4'])
                && isset($_POST['step5'])
                && isset($_POST['step6'])
                && isset($_POST['step7'])
                && isset($_POST['step8'])
                && isset($_POST['step9'])
            ) {
                echo
                '<br /><div class="alert alert-success" role="alert">
                Geschäftsmodell wurde abgesendet!
                </div>';
                $newBM = [
                    'bmname' => $_POST['bmname'],
                    'project' => $_POST['project'],
                    'businessmodel' => $_POST['businessmodel'],
                    'keypartners' => $_POST['step1'],
                    'keyactivities' => $_POST['step2'],
                    'keyresources' => $_POST['step3'],
                    'valueproposition' => $_POST['step4'],
                    'customerrelationships' => $_POST['step5'],
                    'channels' => $_POST['step6'],
                    'customersegments' => $_POST['step7'],
                    'coststructure' => $_POST['step8'],
                    'revenuestreams' => $_POST['step9'],
                ];
                array_push($data, $newBM);
                file_put_contents('data.bmg', json_encode($data, JSON_PRETTY_PRINT));
            }

            if (empty($_GET['page'])) {
                $_GET['page'] = 'start';
            }

            #Headlines
            echo '<br />';
            if ($_GET['page'] == 'start') {
                $headline = 'Willkommen beim Business Model Generator!';
            } else if ($_GET['page'] == 'create') {
                $headline = 'Eigenes Geschäftsmodell erstellen';
            } else if ($_GET['page'] == 'bm') {
                $headline = 'Meine Geschäftsmodelle';
            } else {
                $headline = 404;
            }

            echo '<h1>' . $headline . '</h1>';

            #Seiteninhalt
            if ($_GET['page'] == 'start') {
                echo '
                <p>Erstelle noch heute dein eigenes Geschäftsmodell mit dem Business Model Generator!</p>
                <br />
                <h3>Registrieren</h3>
                <form action="?page=create" method="POST">
        <div>
            <input type="text" placeholder="Benutzername" id="username" name="username" required>
        </div>

        <div>
            <input type="password" placeholder="Passwort" id="pass" name="password" minlength="8" required>
        </div>

        <p id="submission"><input type="submit" value="Registrieren"></p>
    </form>
    ';
            } else if ($_GET['page'] == 'create') {
                echo "
                
                <form action='?page=bm' method='POST'>

                <div>
                <labelfor='bmname>Name des Geschäftsmodells</label>
            </div>
            <div>
            <input type='text' id='bmname' name='bmname' size='101' required>
            </div>            
            <br />
            <label for='project'>In welcher Sparte wird sich dein Unternehmen platzieren?</label>
            <br />
            <select name='project' id='project'>
                <option value='Dienstleistung'>Dienstleistung</option>
                <option value='Offline Handel'>Offline Handel</option>
                <option value='E-Commerce'>E-Commerce</option>
            </select>
            <br />
            <br />
            <label for='businessmodel'>Welches Geschäftsmodell ist für dein Unternehmen passend?</label>
            <br />
            <select name='businessmodel' id='businessmodel'>
                <option value='Freemium'>Freemium</option>
                <option value='Freeware'>Freeware</option>
                <option value='Abo-Modell'>Abo-Modell</option>
            </select>


    <div>
        <p></p>
        <labelfor='keypartners>Key Partners</label>
    </div>
    <div>
        <textarea placeholder='Who are our Key Partners?
Who are our key suppliers?
Which Key Resources are we acquiring from partners?
Which Key Activities do partners perform?' name='step1' id='keypartners' rows='4' cols='100' required>
</textarea>
    </div>


    <div>
        <p></p>
        <label for='keyactivities'>Key Activites</label>
    </div>
    <div>
        <textarea placeholder='What Key Activities do our Value Propositions require?
Our Distribution Channels?
Customer Relationships?
Revenue streams?' name='step2' id='keyactivities' rows='4' cols='100' required>
</textarea>
    </div>


    <div>
        <p></p>
        <label for='keyresources'>Key Resources</label>
    </div>
    <div>
        <textarea placeholder='What Key Resources do our Value Propositions require?
Our Distribution Channels? Customer Relationships?
Revenue Streams?' name='step3' id='keyresources' rows='3' cols='100' required>
</textarea>
    </div>

    <div>
        <p></p>
        <label for='valuepropostitions'>Value Propositions</label>
    </div>
    <div>
        <textarea placeholder='What value do we deliver to the customer?
Which one of our customer’s problems are we helping to solve?
What bundles of products and services are we offering to each Customer Segment?
Which customer needs are we satisfying?' name='step4' id='valuepropostitions' rows='4' cols='100' required>
</textarea>
    </div>

    <div>
        <p></p>
        <label for='customerrelationships'>Customer Relationships</label>
    </div>
    <div>
        <textarea placeholder='What type of relationship does each of our Customer
Segments expect us to establish and maintain with them?
Which ones have we established?
How are they integrated with the rest of our business model?
How costly are they?' name='step5' id='valuepropostitions' rows='5' cols='100' required>
</textarea>
    </div>

    <div>
        <p></p>
        <label for='channels'>Channels</label>
    </div>
    <div>
        <textarea placeholder='Through which Channels do our Customer Segments want to be reached?
How are we reaching them now?
How are our Channels integrated?
Which ones work best?
Which ones are most cost-efficient?
How are we integrating them with customer routines?' name='step6' id='valuepropostitions' rows='6' cols='100' required>
</textarea>
    </div>

    <div>
        <p></p>
        <label for='customersegments'>Customer Segments</label>
    </div>
    <div>
        <textarea placeholder='For whom are we creating value?
Who are our most important customers?' name='step7' id='customersegments' rows='2' cols='100' required>
</textarea>
    </div>

    <div>
        <p></p>
        <label for='coststructure'>Cost Structure</label>
    </div>
    <div>
        <textarea placeholder='What are the most important costs inherent in our business model?
Which Key Resources are most expensive?
Which Key Activities are most expensive?' name='step8' id='coststructure' rows='3' cols='100' required>
</textarea>
    </div>

    <div>
        <p></p>
        <label for='revenuestreams'>Revenue Streams</label>
    </div>
    <div>
        <textarea placeholder='For what value are our customers really willing to pay?
For what do they currently pay?
How are they currently paying?
How would they prefer to pay?
How much does each Revenue Stream contribute to overall revenues?' name='step9' id='revenuestreams' rows='5' cols='100' required>
</textarea>
    </div>


    <button type='submit'>Geschäftsmodell absenden</button>
</form>

                
                ";
            } else if ($_GET['page'] == 'bm') {
                echo "
                <p>Hier siehst du bisher erstellte Geschäftsmodelle.</p>";

                foreach ($data as $row) {
                    #echo 'Keypartners: ' . $row['keypartners'] . '<br />';
                    echo "
                    <div class='canvas'>
                    <div class='canvasheader'>
                    <div class='canvasheaderelement'>
                    <img class='logo' src='img/bmg_white.png' width='200px'>
                    </div>
                    <div class='canvasheaderelement'>
                    <h1>". $row['bmname'] . "</h1>
                    </div>
                    <div class='canvasheaderelement'>
                    <h3>". $row['project'] . " als " . $row['businessmodel'] ."</h3>
                    </div>
                    </div>
                    <div class='canvas5x2'>
                        <div class='canvas1x2'>
                        <h3>Key Partners</h3>
                        " . $row['keypartners'] . "
                        </div>
                        <div class='canvas1x2'>
                            <div class='canvas1x1'>
                            <h3>Key Activities</h3>
                        " . $row['keyactivities'] . "
                            </div>
                            <div class='canvas1x1'>
                            <h3>Key Resources</h3>
                        " . $row['keyresources'] . "
                            </div>
                        </div>
                        <div class='canvas1x2'>
                        <h3>Value Proposition</h3>
                        " . $row['valueproposition'] . "
                            </div>
                        <div class='canvas1x2'>
                        <div class='canvas1x1'>
                        <h3>Customer Relationships</h3>
                        " . $row['customerrelationships'] . "
                            </div>
                            <div class='canvas1x1'>
                            <h3>Channels</h3>
                        " . $row['channels'] . "
                            </div>
                            </div>
                        <div class='canvas1x2'>
                        <h3>Customer Segments</h3>
                        " . $row['customersegments'] . "
                            </div>
                        </div>
                    <div class='canvas5x2'>
                    <div class='canvas25x1'>
                    <h3>Cost Structure</h3>
                        " . $row['coststructure'] . "
                            </div>
                    <div class='canvas25x1'>
                    <h3>Revenue Streams</h3>
                        " . $row['revenuestreams'] . "
                            </div>

                    </div>
                    </div>
                    </br />
                    ";
                }
            } else {
                echo "
                <p>Diese Seite existiert nicht!</p>
                ";
            }


            ?>
        </div>
    </div>

    <div class="footer">
        <p><a href="https://github.com/MauriceN/IU-SE-Fallstudie-BMG">2022 Business Model Generator</a></p>
        created by <b>dorian</b>, <b>maurice</b> & <b>mike</b>
    </div>
</body>

</html>
