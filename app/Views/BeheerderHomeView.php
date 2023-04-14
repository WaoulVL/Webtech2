<?php

namespace App\Views;

use src\Http\Response;

class BeheerderHomeView
{
    public function render()
    {
        global $app;
        $head = $app->getContainer()->make('App\Template\head');
        $headHtml = $head->render('Home');

        ob_start();
        ?>
        <?php echo $headHtml; ?>

        <form method="post" action="/addOpleiding">
            <label for="opleiding">Opleiding</label>
            <input type="text" name="opleiding" id="opleiding">
            <label for="beschrijving">Description</label>
            <input type="text" name="beschrijving" id="beschrijving">
            <input type="submit" value="Add Opleiding">
        </form>

        <form method="post" action="/addCourse">
            <label for="opleiding">Opleiding</label>
            <select name="opleiding" id="opleiding">
                <?php
                $opleidingen = $app->getContainer()->make('App\Models\Opleidingen');
                $opleidingen = $opleidingen->findAll();
                foreach ($opleidingen as $opleiding) {
                    echo '<option value="' . $opleiding['OpleidingID'] . '">' . $opleiding['Naam'] . '</option>';
                }
                ?>
            </select>
            <label for="course">Course</label>
            <input type="text" name="course" id="course">
            <label for="beschrijving">Description</label>
            <input type="text" name="beschrijving" id="beschrijving">
            <input type="submit" value="Add Course">
        </form>

        <form method="post" action="/addVak">
            <label for="course">Course</label>
            <select name="course" id="course">
                <?php
                $courses = $app->getContainer()->make('App\Models\Courses');
                $courses = $courses->findAll();
                foreach ($courses as $course) {
                    echo '<option value="' . $course['CourseID'] . '">' . $course['Naam'] . '</option>';
                }
                ?>
            </select>
            <label for="vak">Vak</label>
            <input type="text" name="vak" id="vak">
            <label for="beschrijving">Description</label>
            <input type="text" name="beschrijving" id="beschrijving">
            <input type="submit" value="Add Vak">
        </form>

        <form method="post" action="/addTentamen">
            <label for="vak">Vak</label>
            <select name="vak" id="vak">
                <?php
                $vakken = $app->getContainer()->make('App\Models\Vakken');
                $vakken = $vakken->findAll();
                foreach ($vakken as $vak) {
                    echo '<option value="' . $vak['VakID'] . '">' . $vak['Naam'] . '</option>';
                }
                ?>
            </select>
            <label for="naam">Naam</label>
            <input type="text" name="naam" id="naam">
            <label for="datum">Datum</label>
            <input type="date" name="datum" id="datum">
            <label for="tijd">Tijd</label>
            <input type="time" name="tijd" id="tijd">
            <label for="locatie">Locatie</label>
            <input type="text" name="locatie" id="locatie">
            <label for="tijdsduur">Tijdsduur</label>
            <input type="text" name="tijdsduur" id="tijdsduur">
            <input type="submit" value="add Tentamen">
        </form>

        <form method="post" action="/addGebruiker">
            <label for="naam">Voornaam</label>
            <input type="text" name="naam" id="naam">
            <label for="achternaam">Achternaam</label>
            <input type="text" name="achternaam" id="achternaam">
            <label for="gebooortedatum">Geboortedatum</label>
            <input type="date" name="geboortedatum" id="geboortedatum">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <label for="telefoonnummer">Telefoonnummer</label>
            <input type="text" name="telefoonnummer" id="telefoonnummer">
            <label for="wachtwoord">Wachtwoord</label>
            <input type="password" name="wachtwoord" id="wachtwoord">
            <label for="rol">Rol</label>
            <select name="rol" id="rol">
                <option value="student">Student</option>
                <option value="docent">Docent</option>
                <option value="beheerder">Beheerder</option>
            </select>
            <input type="submit" value="Add Gebruiker">
        </form>

        <form method="post" action="/addDocent_vakken">
            <label for="docent">Docent</label>
            <select name="docent" id="docent">
                <?php
                $docenten = $app->getContainer()->make('App\Models\Gebruiker');
                $docenten = $docenten->findAllRol('docent');
                foreach ($docenten as $docent) {
                    echo '<option value="' . $docent['GebruikerID'] . '">' . $docent['Naam'] . ' ' . $docent['Achternaam'] . '</option>';
                }
                ?>
            </select>
            <label for="vak">Vak</label>
            <select name="vak" id="vak">
                <?php
                $vakken = $app->getContainer()->make('App\Models\Vakken');
                $vakken = $vakken->findAll();
                foreach ($vakken as $vak) {
                    echo '<option value="' . $vak['VakID'] . '">' . $vak['Naam'] . '</option>';
                }
                ?>
            </select>
            <input type="submit" value="Add Docent_vakken">
        </form>
        <form method="post" action="/addStudent_begeleider">
            <label for="student">Student</label>
            <select name="student" id="student">
                <?php
                $studenten = $app->getContainer()->make('App\Models\Gebruiker');
                $studenten = $studenten->findAllRol('student');
                foreach ($studenten as $student) {
                    echo '<option value="' . $student['GebruikerID'] . '">' .  $student['GebruikerID'] . ' | ' . $student['Naam'] . ' ' . $student['Achternaam'] . '</option>';
                }
                ?>
            </select>
            <label for="begeleider">Begeleider</label>
            <select name="begeleider" id="begeleider">
                <?php
                $docenten = $app->getContainer()->make('App\Models\Gebruiker');
                $docenten = $docenten->findAllRol('docent');
                foreach ($docenten as $docent) {
                    echo '<option value="' . $docent['GebruikerID'] . '">' . $docent['Naam'] . ' ' . $docent['Achternaam'] . '</option>';
                }
                ?>
            </select>
            <input type="submit" value="Add Student_begeleider">
        </form>
        <form id="logout" method="post" action="/logout">
            <input type="submit" value="Logout">
        </form>
        <?php
        return new Response(200, (string)ob_get_clean());
    }
}