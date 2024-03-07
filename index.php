<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: login.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Záznam jazdy</title>
    <link rel="icon" href="favicon.png" type="image/png" sizes="any">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>KNIHA JÁZD</h1>
        <p>Dobrovoľný hasičský zbor obce BOHUNICE</p>
        <form action="process_form.php" method="post">
            <div class="row">
                <div class="column">
                    <label for="name">Meno</label>
                    <select id="name" name="name" required>
                        <option value="">Vyber meno vodiča</option>
                        <option value="Branislav Barták">Branislav Barták</option>
                        <option value="Ľuboš Hajdúch">Ľuboš Hajdúch</option>
                        <option value="Peter Hajdúch">Peter Hajdúch</option>
                        <option value="Andrej Pastorek">Andrej Pastorek</option>
                        <option value="Michal Prekop">Michal Prekop</option>
                        <option value="Marek Rendek">Marek Rendek</option>
                        <option value="Peter Sidor">Peter Sidor</option>
                    </select>
                </div>
                <div class="column">
                    <label for="vehicle">Vozidlo</label>
                    <select id="vehicle" name="vehicle" required>
                        <option value="">Vyber vozidlo</option>
    <option value="Iveco Daily">Iveco Daily</option>
    <option value="Avia A31">Avia A31</option>
    <option value="CAN-AM Traxter">CAN-AM Traxter</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="persons">Posádka</label>
                    <select id="persons" name="persons" required>
                        <option value="">Vyber počet osôb</option>
                        <option value="1">1</option>
                        <option value="1+1">1+1</option>
                        <option value="1+2">1+2</option>
                        <option value="1+3">1+3</option>
                        <option value="1+4">1+4</option>
                        <option value="1+5">1+5</option>
                        <option value="1+6">1+6</option>
                        <option value="1+7">1+7</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="kmBefore">KM pred jazdou:</label>
                    <input type="number" id="kmBefore" name="kmBefore" inputmode="numeric" pattern="[0-9]*" required>
                </div>
                <div class="column">
                    <label for="kmAfter">KM po jazde:</label>
                    <input type="number" id="kmAfter" name="kmAfter" inputmode="numeric" pattern="[0-9]*" required>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="date">Dátum jazdy</label>
                    <input type="date" id="date" name="date" required>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="time1">Čas odjazdu:</label>
                    <input type="time" id="time1" name="time1" required>
                </div>
                <div class="column">
                    <label for="time2">Čas príjazdu:</label>
                    <input type="time" id="time2" name="time2" required>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="where">Cieľ jazdy</label>
                    <input type="text" id="where" placeholder="Napr.: Dubnica Shell pumpa" name="destination" required>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label>Účel jazdy:</label><br>
                    <div class="radio-list">
                        <label for="kondicna">
                            <input type="radio" id="kondicna" name="purpose" value="kondicna" required>
                            <span class="custom-radio"></span> <span>Kondičná jazda</span>
                        </label>
                        <br>
                        <label for="technicka">
                            <input type="radio" id="technicka" name="purpose" value="technicka" required>
                            <span class="custom-radio"></span> <span>Technická pomoc</span>
                        </label>
                        <br>
                        <label for="zasah">
                            <input type="radio" id="zasah" name="purpose" value="zasah" required>
                            <span class="custom-radio"></span> <span>Zásah/cvičenie</span>
                        </label>
                        <br>
                        <label for="other">
                            <input type="radio" id="other" name="purpose" value="other" required>
                            <span class="custom-radio"></span> <span>Ostatné</span>
                        </label>
                    </div>
                </div>
                <div class="column">
                    <textarea id="detail" placeholder="Napr. Tankovanie PHM" name="detail" rows="3"></textarea>
                </div>
            </div>
            <div class="row">
                <button type="submit" id="submitBtn" disabled>Odoslať</button>
            </div>
        </form>
        <div class="button-container">
        <a href="records.html" class="records-button">Zobraziť posledné záznamy</a>
        <a href="logout.php" class="logout-button">Odhlásenie</a>
    </div>
    </div>
  <!-- JS -->
    <script src="js/date-time.js"></script>
    <script src="js/fetch-data.js"></script>
    <script src="js/form-validation.js"></script>
    <script src="js/form-submission.js"></script>
</body>
</html>